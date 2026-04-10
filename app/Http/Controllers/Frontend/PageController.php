<?php

namespace App\Http\Controllers\Frontend;

use App\Crm\CrmLeadStage;
use App\Crm\LeadSource;
use App\Http\Controllers\Controller;
use App\Mail\AgentRequestNotification;
use App\Mail\AgentWelcomeMail;
use App\Mail\PropertyInquiryAdminMail;
use App\Mail\PropertyInquiryAgentMail;
use App\Models\Admin;
use App\Models\Advertisement;
use App\Models\Agent;
use App\Models\GoogleReview;
use App\Models\Property;
use App\Models\PropertyInquiry;
use App\Services\TwilioMessagingService;
use App\Support\InertiaSerializers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class PageController extends Controller
{
    public function home()
    {
        $latestProperties = Property::where('status', 'approved')
            ->with('agent')
            ->latest()
            ->take(6)
            ->get();

        $reviews = GoogleReview::latest()->take(6)->get();
        $averageRating = round($reviews->avg('rating') ?? 0, 1);
        $totalReviews = $reviews->count();

        $about = \App\Models\AboutSection::first();
        $advertisements = Advertisement::where('is_active', true)->get();

        return Inertia::render('Home', [
            'latestProperties' => $latestProperties
                ->map(fn (Property $p) => InertiaSerializers::propertyCard($p))
                ->values()
                ->all(),
            'reviews' => InertiaSerializers::googleReviews($reviews),
            'averageRating' => $averageRating,
            'totalReviews' => $totalReviews,
            'about' => $about ? [
                'hero_title' => $about->hero_title,
                'hero_description' => strip_tags($about->hero_description),
                'hero_image' => $about->hero_image ? asset('storage/'.$about->hero_image) : null,
                'about_image' => $about->about_image ? asset('storage/'.$about->about_image) : null,
                'experience_years' => $about->experience_years,
                'properties_sold' => $about->properties_sold,
                'happy_clients' => $about->happy_clients,
            ] : null,
            'advertisements' => InertiaSerializers::advertisements($advertisements),
        ]);
    }

    public function agent_form()
    {
        return Inertia::render('AgentForm');
    }

    public function agent_store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:agents,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:6|confirmed',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $agent = new Agent;
        $agent->name = $request->name;
        $agent->email = $request->email;
        $agent->phone = $request->phone;
        $agent->password = Hash::make($request->password);
        $agent->status = false;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('agents', $filename, 'public');
            $agent->avatar = 'agents/'.$filename;
        }

        $agent->save();

        Mail::to($agent->email)->send(new AgentWelcomeMail([
            'name' => $agent->name,
            'email' => $agent->email,
        ]));

        $adminEmails = Admin::whereNotNull('email')->pluck('email')->toArray();
        if ($adminEmails !== []) {
            Mail::to($adminEmails)->send(new AgentRequestNotification([
                'name' => $agent->name,
                'email' => $agent->email,
                'phone' => $agent->phone,
            ]));
        }

        return redirect()->route('home')->with(
            'success',
            'Registration received. An administrator will activate your account; then you can sign in at the agent dashboard.'
        );
    }

    public function contactAgent(Request $request, Agent $agent, TwilioMessagingService $twilio)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:32',
            'message' => 'required|string|max:5000',
            'property_id' => 'required|exists:properties,id',
        ]);

        $property = Property::query()->findOrFail($data['property_id']);
        if ((int) $property->agent_id !== (int) $agent->id) {
            abort(403, 'This listing is not assigned to this agent.');
        }

        $inquiry = PropertyInquiry::create([
            'property_id' => $data['property_id'],
            'agent_id' => $agent->id,
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'lead_source' => LeadSource::WEBSITE,
            'message' => $data['message'],
            'is_read' => false,
            'crm_status' => CrmLeadStage::NEW,
        ]);

        $inquiry->load(['property', 'agent']);

        $twilio->notifyPropertyInquiry($inquiry);

        if (filled($agent->email)) {
            try {
                Mail::to($agent->email)->send(new PropertyInquiryAgentMail($inquiry));
            } catch (\Throwable $e) {
                report($e);
            }
        }

        $adminEmails = Admin::query()
            ->whereNotNull('email')
            ->where('email', '!=', '')
            ->pluck('email')
            ->map(fn (string $e): string => strtolower(trim($e)))
            ->filter(fn (string $e): bool => filter_var($e, FILTER_VALIDATE_EMAIL) !== false)
            ->unique()
            ->values()
            ->all();

        if ($adminEmails !== []) {
            try {
                Mail::to($adminEmails)->send(new PropertyInquiryAdminMail($inquiry));
            } catch (\Throwable $e) {
                report($e);
            }
        }

        return back()->with(
            'success',
            'Your message was sent. The agent has been notified by email — you can expect a reply at '.$data['email'].'.'
        );
    }
}

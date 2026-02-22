<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\AgentRequestNotification;
use App\Models\Admin;
use App\Models\Agent;
use App\Models\GoogleReview;
use App\Models\Property;
use App\Models\PropertyInquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    // Home Page
    public function home()
{
    // Latest approved properties
    $latestProperties = Property::where('status', 'approved')->latest()->take(6)->get();

    // Latest Google reviews
    $reviews = GoogleReview::latest()->take(6)->get();
    $averageRating = $reviews->avg('rating') ?? 0;
    $totalReviews  = $reviews->count();

    // Pass everything to home view
    return view('frontend.home', compact(
        'latestProperties',
        'reviews',
        'averageRating',
        'totalReviews'
    ));
}


    // Agent Registration Form
    public function agent_form()
    {
        return view('frontend.agent_form');
    }

    // Store Agent
    public function agent_store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:agents,email',
            'phone'    => 'required|string|max:20',
            'password' => 'required|string|min:6|confirmed',
            'avatar'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $agent = new Agent();
        $agent->name = $request->name;
        $agent->email = $request->email;
        $agent->phone = $request->phone;
        $agent->password = Hash::make($request->password);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('agents', $filename, 'public');
            $agent->avatar = 'agents/' . $filename;
        }

        $agent->save();

        // Notify Admins
        $adminEmails = Admin::whereNotNull('email')->pluck('email')->toArray();
        if (!empty($adminEmails)) {
            Mail::to($adminEmails)->send(new AgentRequestNotification([
                'name'  => $agent->name,
                'email' => $agent->email,
                'phone' => $agent->phone,
            ]));
        }

        return redirect()->route('home')->with('success', 'Agent registered successfully!');
    }

    public function contactAgent(Request $request, Agent $agent)
{
    $data = $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'required|email|max:255',
        'message' => 'required|string',
        'property_id' => 'required|exists:properties,id', // you need to pass property_id from the form
    ]);

    // Store the inquiry
    PropertyInquiry::create([
        'property_id' => $data['property_id'],
        'agent_id'    => $agent->id,
        'name'        => $data['name'],
        'email'       => $data['email'],
        'message'     => $data['message'],
        'is_read'     => false,
    ]);

    return back()->with('success', 'Message sent to agent successfully!');
}

    public function about()
    {
        return view('frontend.about');
    }

}

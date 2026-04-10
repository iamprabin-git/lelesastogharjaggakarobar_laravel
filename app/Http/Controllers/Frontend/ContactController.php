<?php

namespace App\Http\Controllers\Frontend;

use App\Filament\Resources\ContactSubmissions\ContactSubmissionResource;
use App\Http\Controllers\Controller;
use App\Mail\SiteContactFormMail;
use App\Models\Admin;
use App\Models\Company;
use App\Models\ContactSubmission;
use App\Services\TwilioMessagingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function index()
    {
        return Inertia::render('Contact');
    }

    public function submit(Request $request, TwilioMessagingService $twilio)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:32',
            'message' => 'required|string|max:5000',
        ]);

        $payload = [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => filled($data['phone'] ?? null) ? $data['phone'] : null,
            'message' => $data['message'],
        ];

        $submission = ContactSubmission::query()->create([
            'name' => $payload['name'],
            'email' => $payload['email'],
            'phone' => $payload['phone'],
            'message' => $payload['message'],
            'is_read' => false,
        ]);

        $twilio->notifyContactSubmission(
            $payload['name'],
            $payload['email'],
            $payload['phone'],
            $payload['message']
        );

        $adminViewUrl = ContactSubmissionResource::getUrl('edit', ['record' => $submission], true, 'admin');

        $recipients = Admin::query()
            ->whereNotNull('email')
            ->where('email', '!=', '')
            ->pluck('email')
            ->map(fn (string $e): string => strtolower(trim($e)))
            ->filter(fn (string $e): bool => filter_var($e, FILTER_VALIDATE_EMAIL) !== false)
            ->unique()
            ->values()
            ->all();

        $company = Company::query()->where('status', true)->first();

        if ($company && filled($company->email)) {
            $addr = strtolower(trim($company->email));
            if (filter_var($addr, FILTER_VALIDATE_EMAIL) && ! in_array($addr, $recipients, true)) {
                $recipients[] = $company->email;
            }
        }

        if ($recipients === []) {
            report(new \RuntimeException('Contact form: no admin/company email to notify; submission #'.$submission->id.' saved in database.'));

            return back()->with(
                'success',
                'Thanks for your message — we have received it. For a quick reply, please call or use the email shown on this page.'
            );
        }

        try {
            Mail::to($recipients)->send(new SiteContactFormMail($payload, $adminViewUrl));
            $submission->update(['email_sent_at' => now()]);
        } catch (\Throwable $e) {
            report($e);

            return back()->with(
                'success',
                'Thanks for your message — we have saved it. Our team will follow up soon. If it is urgent, please call the number on this page.'
            );
        }

        return back()->with(
            'success',
            'Thanks — your message was sent. We will reply to '.$data['email'].' when we can.'
        );
    }
}

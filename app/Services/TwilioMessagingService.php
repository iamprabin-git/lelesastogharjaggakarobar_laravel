<?php

namespace App\Services;

use App\Models\PropertyInquiry;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class TwilioMessagingService
{
    public function enabled(): bool
    {
        if (! config('services.twilio.enabled', true)) {
            return false;
        }

        $sid = config('services.twilio.account_sid');
        $token = config('services.twilio.auth_token');
        $fromService = filled(config('services.twilio.messaging_service_sid'));
        $fromNumber = filled(config('services.twilio.from'));

        return filled($sid) && filled($token) && ($fromService || $fromNumber);
    }

    /**
     * @param  list<string>  $rawNumbers
     */
    public function sendToNumbers(array $rawNumbers, string $body): void
    {
        if (! $this->enabled()) {
            return;
        }

        $sent = [];
        foreach ($rawNumbers as $raw) {
            $to = $this->normalizeToE164($raw);
            if ($to === null || isset($sent[$to])) {
                continue;
            }
            $sent[$to] = true;
            $this->sendSms($to, $body);
        }
    }

    public function notifyContactSubmission(string $name, string $email, ?string $phone, string $message): void
    {
        $numbers = $this->parseNotifyList(config('services.twilio.contact_notify_numbers'));
        if ($numbers === []) {
            return;
        }

        $snippet = mb_strlen($message) > 280 ? mb_substr($message, 0, 277).'…' : $message;
        $line = 'Site contact: '.$name.' / '.$email;
        if (filled($phone)) {
            $line .= ' / '.$phone;
        }
        $line .= ' — '.$snippet;

        $this->sendToNumbers($numbers, $line);
    }

    public function notifyPropertyInquiry(PropertyInquiry $inquiry): void
    {
        $inquiry->loadMissing(['property', 'agent']);

        $numbers = [];

        if ($inquiry->agent && filled($inquiry->agent->phone)) {
            $numbers[] = $inquiry->agent->phone;
        }

        foreach ($this->parseNotifyList(config('services.twilio.inquiry_notify_numbers')) as $n) {
            $numbers[] = $n;
        }

        if ($numbers === []) {
            return;
        }

        $title = $inquiry->property?->title ?? 'Listing';
        $snippet = mb_strlen($inquiry->message) > 200 ? mb_substr($inquiry->message, 0, 197).'…' : $inquiry->message;
        $body = 'Property inquiry: '.$title.' from '.$inquiry->name.' ('.$inquiry->email.') — '.$snippet;

        $this->sendToNumbers($numbers, $body);
    }

    public function normalizeToE164(?string $raw): ?string
    {
        if ($raw === null) {
            return null;
        }

        $raw = trim($raw);
        if ($raw === '') {
            return null;
        }

        if (str_starts_with($raw, '+')) {
            $digits = preg_replace('/\D/', '', substr($raw, 1)) ?? '';

            return $digits !== '' ? '+'.$digits : null;
        }

        $digits = preg_replace('/\D/', '', $raw) ?? '';
        if ($digits === '') {
            return null;
        }

        $digits = ltrim($digits, '0');
        if ($digits === '') {
            return null;
        }

        $cc = config('services.twilio.default_country_code');
        if (filled($cc) && ! str_starts_with($digits, (string) $cc)) {
            return '+'.$cc.$digits;
        }

        return '+'.$digits;
    }

    private function parseNotifyList(?string $env): array
    {
        if ($env === null || trim($env) === '') {
            return [];
        }

        return collect(explode(',', $env))
            ->map(fn (string $s): string => trim($s))
            ->filter()
            ->values()
            ->all();
    }

    private function sendSms(string $toE164, string $body): void
    {
        try {
            $client = new Client(
                (string) config('services.twilio.account_sid'),
                (string) config('services.twilio.auth_token')
            );

            $params = ['body' => $body];

            if (filled(config('services.twilio.messaging_service_sid'))) {
                $params['messagingServiceSid'] = config('services.twilio.messaging_service_sid');
            } else {
                $params['from'] = config('services.twilio.from');
            }

            $client->messages->create($toE164, $params);
        } catch (\Throwable $e) {
            report($e);
            Log::warning('Twilio SMS failed', [
                'to' => $toE164,
                'message' => $e->getMessage(),
            ]);
        }
    }
}

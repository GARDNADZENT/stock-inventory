<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class ResendService
{
    public function send(string $to, string $subject, string $html): void
    {
        $apiKey = config('services.resend.key');

        if (! $apiKey) {
            throw new RuntimeException('RESEND_API_KEY is not configured.');
        }

        $fromName = config('mail.from.name');
        $fromAddress = config('mail.from.address');

        $response = Http::withToken($apiKey)
            ->acceptJson()
            ->post('https://api.resend.com/emails', [
                'from' => "{$fromName} <{$fromAddress}>",
                'to' => [$to],
                'subject' => $subject,
                'html' => $html,
            ]);

        if ($response->failed()) {
            throw new RuntimeException($response->json('message') ?? 'Unable to send email via Resend.');
        }
    }
}

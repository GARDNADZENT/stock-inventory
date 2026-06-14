<?php

namespace App\Services;

use App\Models\LoginLink;
use App\Models\User;
use Illuminate\Support\Str;

class LoginLinkService
{
    public function __construct(private ResendService $resend) {}

    public function send(User $user): void
    {
        $plainToken = Str::random(64);

        LoginLink::query()->create([
            'user_id' => $user->id,
            'token' => hash('sha256', $plainToken),
            'expires_at' => now()->addMinutes(15),
        ]);

        $url = route('login.verify', ['token' => $plainToken]);

        $this->resend->send(
            $user->email,
            'Your Maasai Shop login link',
            view('emails.login-link', [
                'user' => $user,
                'url' => $url,
                'expiresMinutes' => 15,
            ])->render()
        );
    }

    public function verify(string $plainToken): ?User
    {
        $link = LoginLink::query()
            ->with('user')
            ->where('token', hash('sha256', $plainToken))
            ->first();

        if (! $link?->isValid()) {
            return null;
        }

        $link->update(['used_at' => now()]);

        return $link->user;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\EmailVerification;
use App\Models\User;
use App\Services\ResendService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;
use RuntimeException;

class RegisterController extends Controller
{
    public function create(): View
    {
        return view('register');
    }

    public function store(Request $request, ResendService $resend): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'sales',
        ]);

        $plainToken = Str::random(64);

        EmailVerification::query()->create([
            'user_id' => $user->id,
            'token' => hash('sha256', $plainToken),
            'expires_at' => now()->addMinutes(60),
        ]);

        $verificationUrl = route('verify-email', ['token' => $plainToken]);

        try {
            $resend->send(
                $user->email,
                'Verify your Maasai Shop account',
                view('emails.verify-email', [
                    'user' => $user,
                    'url' => $verificationUrl,
                    'expiresMinutes' => 60,
                ])->render()
            );
        } catch (RuntimeException $e) {
            report($e);
        }

        return redirect()
            ->route('register.sent')
            ->with('register_email', $user->email);
    }

    public function sent(Request $request): View|RedirectResponse
    {
        $email = $request->session()->get('register_email');

        if (! $email) {
            return redirect()->route('register');
        }

        return view('register-sent', ['email' => $email]);
    }

    public function verify(Request $request, string $token): RedirectResponse
    {
        $verification = EmailVerification::query()
            ->with('user')
            ->where('token', hash('sha256', $token))
            ->first();

        if (! $verification?->isValid()) {
            return redirect()
                ->route('login')
                ->withErrors(['email' => 'This verification link is invalid or has expired. Please register again.']);
        }

        $verification->update(['used_at' => now()]);

        $verification->user->update([
            'email_verified_at' => now(),
        ]);

        return redirect()
            ->route('login')
            ->with('success', 'Your email has been verified. You can now log in.');
    }

    public function resend(Request $request): RedirectResponse
    {
        $email = $request->session()->get('register_email');

        if (! $email) {
            return redirect()->route('register');
        }

        $user = User::query()->where('email', $email)->first();

        if (! $user) {
            return redirect()->route('register');
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('login')->with('success', 'Your email is already verified.');
        }

        $plainToken = Str::random(64);

        EmailVerification::query()->create([
            'user_id' => $user->id,
            'token' => hash('sha256', $plainToken),
            'expires_at' => now()->addMinutes(60),
        ]);

        $verificationUrl = route('verify-email', ['token' => $plainToken]);

        try {
            app(ResendService::class)->send(
                $user->email,
                'Verify your Maasai Shop account',
                view('emails.verify-email', [
                    'user' => $user,
                    'url' => $verificationUrl,
                    'expiresMinutes' => 60,
                ])->render()
            );
        } catch (RuntimeException $e) {
            report($e);
        }

        return back()->with('success', 'A new verification link has been sent to your email.');
    }
}

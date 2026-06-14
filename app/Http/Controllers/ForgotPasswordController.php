<?php

namespace App\Http\Controllers;

use App\Models\PasswordReset;
use App\Models\User;
use App\Services\ResendService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;
use RuntimeException;

class ForgotPasswordController extends Controller
{
    public function showForgotForm(): View
    {
        return view('forgot-password');
    }

    public function sendResetLink(Request $request, ResendService $resend): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::query()->where('email', $validated['email'])->first();

        if (! $user) {
            return back()
                ->withErrors(['email' => 'No account found with that email address.'])
                ->onlyInput('email');
        }

        $plainToken = Str::random(64);

        PasswordReset::query()->create([
            'email' => $user->email,
            'token' => hash('sha256', $plainToken),
            'expires_at' => now()->addMinutes(60),
        ]);

        $resetUrl = route('password.reset', ['token' => $plainToken]);

        try {
            $resend->send(
                $user->email,
                'Reset your Maasai Shop password',
                view('emails.reset-password', [
                    'user' => $user,
                    'url' => $resetUrl,
                    'expiresMinutes' => 60,
                ])->render()
            );
        } catch (RuntimeException $e) {
            report($e);

            return back()
                ->withErrors(['email' => 'We could not send the reset email. Please try again later.'])
                ->onlyInput('email');
        }

        return redirect()
            ->route('password.sent')
            ->with('reset_email', $user->email);
    }

    public function sent(Request $request): View|RedirectResponse
    {
        $email = $request->session()->get('reset_email');

        if (! $email) {
            return redirect()->route('password.forgot');
        }

        return view('forgot-password-sent', ['email' => $email]);
    }

    public function showResetForm(Request $request, string $token): View|RedirectResponse
    {
        $reset = PasswordReset::query()
            ->where('token', hash('sha256', $token))
            ->first();

        if (! $reset?->isValid()) {
            return redirect()
                ->route('password.forgot')
                ->withErrors(['email' => 'This reset link is invalid or has expired. Request a new one.']);
        }

        return view('reset-password', [
            'token' => $token,
            'email' => $reset->email,
        ]);
    }

    public function reset(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'token' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $reset = PasswordReset::query()
            ->where('token', hash('sha256', $validated['token']))
            ->where('email', $validated['email'])
            ->first();

        if (! $reset?->isValid()) {
            return redirect()
                ->route('password.forgot')
                ->withErrors(['email' => 'This reset link is invalid or has expired. Request a new one.']);
        }

        $user = User::query()->where('email', $validated['email'])->first();

        if (! $user) {
            return redirect()
                ->route('password.forgot')
                ->withErrors(['email' => 'No account found with that email address.']);
        }

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        $reset->update(['used_at' => now()]);

        return redirect()
            ->route('login')
            ->with('success', 'Your password has been reset. You can now log in.');
    }
}

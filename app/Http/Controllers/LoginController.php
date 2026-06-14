<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function show(Request $request): View|RedirectResponse
    {
        if ($request->session()->get('role') === 'sales') {
            return redirect()->route('sales.create');
        }

        if ($request->session()->get('role') === 'admin') {
            return redirect()->route('dashboard');
        }

        return view('login');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::query()->where('email', $validated['email'])->first();

        if (! $user || ! Hash::check($validated['password'], $user->password)) {
            return back()
                ->withErrors(['email' => 'These credentials do not match our records.'])
                ->onlyInput('email');
        }

        if (! $user->hasVerifiedEmail()) {
            return back()
                ->withErrors(['email' => 'Please verify your email address before logging in.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();
        $request->session()->put('role', $user->role);
        $request->session()->put('user_email', $user->email);
        $request->session()->put('user_name', $user->name);

        return $user->role === 'admin'
            ? redirect()->route('dashboard')->with('success', 'Welcome back.')
            : redirect()->route('sales.create')->with('success', 'Welcome back.');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->session()->forget(['role', 'user_email', 'user_name']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

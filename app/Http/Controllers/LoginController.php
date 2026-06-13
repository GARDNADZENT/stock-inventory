<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if ($credentials['username'] === 'sales1' && $credentials['password'] === 'sales') {
            $request->session()->regenerate();
            $request->session()->put('role', 'sales');

            return redirect()->route('sales.create');
        }

        if ($credentials['username'] === 'admin' && $credentials['password'] === 'admin') {
            $request->session()->regenerate();
            $request->session()->put('role', 'admin');

            return redirect()->route('dashboard');
        }

        return back()
            ->withErrors(['username' => 'Invalid username or password.'])
            ->onlyInput('username');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->session()->forget('role');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

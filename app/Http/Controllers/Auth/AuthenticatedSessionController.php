<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // First, authenticate user credentials
        $request->authenticate();

        $user = $request->user();

        if ($user->is_approved !== 1) {
        Auth::logout();

        $message = match ($user->is_approved) {
            0 => 'Your account is still pending approval.',
            -1 => 'Your account has been rejected.',
        };

        return back()->withErrors(['email' => $message]);
        }

        // If approved, regenerate session
        $request->session()->regenerate();

        // Redirect based on role
        if ($request->user()->role === 'super-admin') {
            return redirect('/superadmin/pending-users');  // Super-admin dashboard or pending user approvals page
        } elseif ($request->user()->role === 'admin') {
            return redirect('/admin/dashboard');
        } else {
            return redirect('/staff/dashboard');
        }
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers\UserActions;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->only([
            'authentication',
            'authenticate',
        ]); 
        $this->middleware('auth')->only([
            'verifyEmail',
            'emailVerificationNotice',
            'resendEmailVerificationNotification'
        ]);

        $this->middleware('signed')->only('verifyEmail');
        $this->middleware('throttle:6,1')->only('resendEmailVerificationNotification');
    }

    public function authentication() {
        return view('authentication.login');
    }

    public function registeration() {
        return view('users.register');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
    

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember_me'))) {
            $request->session()->regenerate();
            return redirect('/home', 302);
        }
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }

    public function emailVerificationNotice() {
        return view('authentication.verification-notice');
    }

    public function verifyEmail(EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/home');
    }

    public function resendEmailVerificationNotification(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('emailResent', 'verification link sent!');
    }
}
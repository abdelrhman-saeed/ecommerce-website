<?php

namespace App\Http\Controllers\UserActions;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthenticationController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->only([
            'authentication',
            'authenticate',
            'forgotPasswordPage',
            'forgotPassword',
            'passwordResetPage',
            'passwordReset'
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

            if (auth()->user()->hasVerifiedEmail()) {
                return redirect('/home', 302);
            }
            return redirect(route('verification.notice'));
        }
        
        return back()->withErrors([
            'unauthenticated' => 'Sorry, Your email is not found in our database'
        ]);
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
        $request->user()
                ->sendEmailVerificationNotification();
        return back()
                ->with('emailResent', 'verification link sent!');
    }

    public function forgotPasswordPage() {
        return view('users.forgot-password');
    }

    public function forgotPassword(Request $request) {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    public function passwordResetPage(string $token) {
        return view('users.password-reset', ['token' => $token]);
    }

    public function passwordReset(Request $request)
    {
        // dd($request->email);
        $request->validate([
            'token' => 'required',
            'email' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password)
            {
                $user->forceFill(['password' => Hash::make($password)])
                        ->setRememberToken(Str::random(60));
                
                $user->save();
                Event::dispatch(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
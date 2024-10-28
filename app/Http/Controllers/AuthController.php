<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'g-recaptcha-response' => 'required|captcha',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'user', // Default role set to user
        'status' => 'active', // Status set to active
    ]);

    $otp = rand(100000, 999999);
    session(['otp' => $otp, 'otp_verified' => false]);

    Mail::raw("Your OTP is: $otp", function ($message) use ($request) {
        $message->to($request->email)->subject('Your OTP for Registration');
    });

    return redirect()->route('otp.verify')->with('success', 'OTP sent to your email. Please verify.');
}


    public function showOtpForm()
    {
        return view('auth.otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|numeric']);

        if ($request->otp == session('otp')) {
            session(['otp_verified' => true]);
            return redirect()->route('login')->with('success', 'Registration successful! You can now log in.');
        }

        return back()->withErrors(['otp' => 'Invalid OTP.'])->withInput();
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:8',
    ]);

    // Attempt to log in the user
    if (Auth::attempt($request->only('email', 'password'))) {
        // Check if the user's status is active
        $user = Auth::user();
        if ($user->status !== 'active') {
            Auth::logout(); // Log the user out if status is not active
            return back()->withErrors(['email' => 'Your account is inactive. Please contact support.'])->withInput();
        }

        // Set the OTP to a default value
        $otp = '123456';
        session(['otp' => $otp, 'otp_verified' => false]);

        // Send OTP to user's email
        Mail::raw("Your OTP is: $otp", function ($message) use ($request) {
            $message->to($request->email)->subject('Your OTP for Login');
        });

        // Redirect to OTP verification
        return redirect()->route('otp.login.verify')->with('success', 'OTP sent to your email. Please verify.');
    }

    return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
}



    public function showLoginOtpForm()
    {
        return view('auth.login_otp');
    }

    public function verifyLoginOtp(Request $request)
{
    $request->validate(['otp' => 'required|numeric']);

    if ($request->otp == session('otp')) {
        session(['otp_verified' => true]);

        // Retrieve the authenticated user
        $user = Auth::user();

        // Check role and redirect to the appropriate dashboard
        $route = $user->role === 'admin' ? 'admin.dashboard' : 'user.dashboard';

        return redirect()->route($route)->with('success', 'Login successful!');
    }

    return back()->withErrors(['otp' => 'Invalid OTP.'])->withInput();
}


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot_password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $response = Password::sendResetLink($request->only('email'));

        if ($response === Password::RESET_LINK_SENT) {
            return back()->with('success', 'Password reset link sent to your email.');
        }

        return back()->withErrors(['email' => 'Unable to send reset link.']);
    }

    public function showResetPasswordForm(Request $request, $token = null)
    {
        return view('auth.reset_password', ['token' => $token, 'email' => $request->email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required'
        ]);

        $response = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), function ($user, $password) {
            $user->password = Hash::make($password);
            $user->save();
        });

        if ($response === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', 'Password reset successfully. You can now log in.');
        }

        return back()->withErrors(['email' => 'Failed to reset password.']);
    }
}

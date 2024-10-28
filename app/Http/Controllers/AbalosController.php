<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AbalosController extends Controller
{
    public function handleReCaptcha(Request $request)
    {
        // Validate the reCAPTCHA response
        $request->validate([
            'g-recaptcha-response' => 'required|captcha',
        ], [
            'g-recaptcha-response.required' => 'Please complete the reCAPTCHA.',
            'g-recaptcha-response.captcha' => 'reCAPTCHA verification failed. Please try again.',
        ]);

        // Handle successful verification (e.g., log in the user)
        return redirect()->route('login')->with('success', 'ReCAPTCHA verified successfully!');
    }
}

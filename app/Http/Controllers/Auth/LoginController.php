<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            
            // Redirect based on user type
            $user = Auth::user();
            switch ($user->user_type) {
                case 'admin':
                    return redirect()->intended('/admin/dashboard');
                case 'company':
                    return redirect()->intended('/company/dashboard');
                case 'driver':
                    // Check if driver specifically wants to go to jobs page
                    if ($request->has('redirect_to_jobs') && $request->redirect_to_jobs === 'true') {
                        return redirect()->route('driver.logistics-loads.index');
                    }
                    return redirect()->intended('/driver/dashboard');
                default:
                    return redirect()->intended('/dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}

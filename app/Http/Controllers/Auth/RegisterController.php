<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'user_type' => 'required|in:admin,company,driver',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'company_name' => 'required_if:user_type,company|nullable|string|max:255',
            'license_number' => 'required_if:user_type,driver|nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type,
            'phone' => $request->phone,
            'address' => $request->address,
            'company_name' => $request->user_type === 'company' ? $request->company_name : null,
            'license_number' => $request->user_type === 'driver' ? $request->license_number : null,
        ]);

        Auth::login($user);

        // Redirect based on user type
        switch ($user->user_type) {
            case 'admin':
                return redirect('/admin/dashboard');
            case 'company':
                return redirect('/company/dashboard');
            case 'driver':
                return redirect('/driver/dashboard');
            default:
                return redirect('/dashboard');
        }
    }
}

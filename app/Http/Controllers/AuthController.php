<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Register a new user
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6|confirmed',
        ]);

        try {
            // Create new user in MySQL
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password), // Hash the password
            ]);

            return redirect()->route('login')->with('success', 'Registration successful. You can now log in.');
        } catch (\Exception $e) {
            \Log::error("Registration Error: " . $e->getMessage());
            return back()->with('error', 'An error occurred during registration. Please try again.');
        }
    }

    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Login the user
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/')->with('success', 'Login successful.');
        }

        return back()->with('error', 'Invalid email or password.');
    }

    // Logout the user
    public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login')->with('success', 'You have been logged out.');
}

}

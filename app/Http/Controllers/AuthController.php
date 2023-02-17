<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signup()
    {
        return view('auth.signup');
    }

    public function signin()
    {
        return view('auth.signin');
    }

    public function register(Request $request)
    {
        // Validate user
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'confirmed'
        ]);

        // Store user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Sign user in
        auth()->attempt($request->only('email', 'password'));

        // Redirect
        return redirect()->route('home');
    }

    public function login(Request $request)
    {
        // Validate user
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        // Sign user in
        if (!auth()->attempt($request->only('email', 'password'))) {
            return back()->with('status', 'Invalid user or password');
        }

        // Redirect
        return redirect()->route('home');
    }
}

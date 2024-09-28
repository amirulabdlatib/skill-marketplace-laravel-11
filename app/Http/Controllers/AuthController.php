<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function getLoginPage()
    {
        return view('auth.login');
    }

    public function getRegisterPage()
    {
        return view('auth.register');
    }

    public function doRegister(Request $request)
    {
        $validated_data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email',
            'role' => 'required|in:talent,recruiter',
            'password' => 'required|confirmed|min:5|max:255',
        ]);

        $user = User::create($validated_data);
        Auth::login($user);

        $request->session()->regenerate();

        if ($user->role == 'recruiter') {
            return redirect()->route('recruiter.dashboard')->with('success','Successfully register');
        }

        return redirect()->route('talent.dashboard')->with('success','Successfully register');
    }

    public function doLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
    
        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();
            $user = Auth::user();
    
            if ($user->role == 'recruiter') {
                return redirect()->route('recruiter.dashboard')->with('success','Successfully login');
            }
            return redirect()->route('talent.dashboard')->with('success','Successfully login');
        }
    
        return back()->with('error','Invalid credentials!');
    }

    public function doLogout(Request $request)
    {
        Auth::logout();

        $request->session()->regenerate();

        return redirect()->route('landing')->with('success','Logout successfully');
    }
}

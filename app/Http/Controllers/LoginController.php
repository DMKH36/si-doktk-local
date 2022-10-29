<?php

namespace App\Http\Controllers;

use App\Models\Frontend;
use App\Models\FrontendContact;
use App\Models\FrontendService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if ($user = Auth::user()) {
            if($user->role == "admin" || $user->role == "kadep" || $user->role == "koor"){
                return redirect()->intended('/dashboard');
            }
            elseif($user->role == "mahasiswa" || $user->role == "alumni"){
                return redirect()->intended('/');
            }
        }

        $frontend = Frontend::where('id', '1')->first();
        $contact = FrontendContact::all();
        $service = FrontendService::all();
        return view('auth.login', compact('frontend', 'contact', 'service'));
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($credentials)) {
            $user = Auth::user();
            if($user->status == 0){
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->with('statusError', 'Akun anda belum diaktivasi oleh Admin!');
            }
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError', 'Login failed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

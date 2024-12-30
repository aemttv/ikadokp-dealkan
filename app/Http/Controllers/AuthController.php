<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function store()
    {
        return view('validasi.register');
    }

    function submitStore(Request $request)
    {
        $user = new User();

        $user->name = $request->fullname;
        $user->email = $request->email;
        $user->nohp = $request->nohp;
        $user->nowa = $request->noWA;
        $user->password = bcrypt($request->password);
        $user->modified_by = Auth::id();
        $user->save();

        return redirect()->route('login.view');
    }

    function loginView()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('validasi.login');
    }

    function profilView()
    {
        return view('user.login.profil');
    }

    function submitLogin(Request $request)
    {
        $data = $request->only('email', 'password');

        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect()->route('home');
        } else {
            return redirect()->back()->with('error', 'Email atau password salah.');
        }
    }

    function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function proses_login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Session::put('user', [
                'id' => $user->id,
                'name' => $user->name,
                'username' => $user->username,
            ]);

            return redirect()->route('home');
        }

        return redirect()->route('login')->with('error','Username atau password salah!');
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login');
    }
}


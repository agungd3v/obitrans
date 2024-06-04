<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
	public function loginPage() {
		return view("auth.login");
	}

	public function login(Request $request) {
		$credentials = $request->validate([
			'email' => ['required', 'string', 'email'],
			'password' => ['required', 'string'],
		]);

		if (Auth::attempt($credentials)) {
			$request->session()->regenerate();
			return redirect()->intended('user');
		};

		return back()->withErrors([
			'email' => 'The provided credentials do not match our records.',
		])->onlyInput('email');
	}

  public function logout() {
		auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/login');
	}
}

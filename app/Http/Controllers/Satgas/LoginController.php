<?php

namespace App\Http\Controllers\Satgas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
	public function showLoginForm()
	{
		if (auth()->viaRemember() || auth()->guard('satgas')->check()) {
			return redirect(route('satgas.home'));
		} else {
			return view('satgas.login');
		}
	}

	public function login(Request $request)
	{
		$request->validate([
			'username' => 'required',
			'password' => 'required'
		]);

		$auth = $request->only('username', 'password');
		$remember = false;

		if ($request->remember == 'true') $remember = true;

		if (auth()->guard('satgas')->attempt($auth, $remember)) {
			$msg = array(
				'status'	=> 'Success',
				'message'	=> 'Login Successful',
				'url' => route('satgas.home')
			);

			return response()->json($msg);
		} else {
			$msg = array(
				'status'	=> 'Error',
				'message'	=> 'Wrong Username or Password!'
			);

			return response()->json($msg);
		}
	}

	public function logout()
	{
		auth()->guard('satgas')->logout();

		return redirect(route('satgas.login'));
	}
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (auth()->viaRemember() || auth()->guard('admin')->check()) {
            return redirect(route('admin.home'));
        } else {
            return view('admin.login');
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $remember = false;
        $credentials = ['username' => $request->username, 'password' => $request->password,
            'roles' => 0, 'stat_adm' => 1];

        if ($request->remember == 'true') {
            $remember = true;
        }

        if (auth()->guard('admin')->attempt($credentials, $remember)) {
            $msg = array(
                'status' => 'Success',
                'message' => 'Login Successful',
                'url' => route('admin.home'),
            );

            return response()->json($msg);
        } else {
            $msg = array(
                'status' => 'Error',
                'message' => 'Wrong Username or Password!',
            );

            return response()->json($msg);
        }
    }

    public function logout()
    {
        auth()->guard('admin')->logout();

        return redirect(route('admin.login'));
    }
}

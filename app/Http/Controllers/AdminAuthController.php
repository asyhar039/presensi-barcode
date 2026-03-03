<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        // simple hard‑coded admin credentials as requested
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($request->username !== 'user' || $request->password !== 'user') {
            return back()->withErrors(['username' => 'Credentials tidak valid'])->withInput();
        }

        // create minimal session value to mark admin as logged in
        session(['admin_id' => 1]);
        return redirect('/admin/dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin_id');
        return redirect('/admin/login');
    }
}

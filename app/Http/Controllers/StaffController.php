<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StaffController extends Controller
{
    
    public function index()
    {
        return view('staff.home');
    }

    public function login()
    {
        return view('staff.login');
    }

    public function handleLogin(Request $req)
    {
        if(Auth::guard('staff')
               ->attempt($req->only(['email', 'password'])))
        {
            return redirect()
                ->route('staff.home');
        }

        return redirect()->back()->with('error', 'true');
    }

    public function logout()
    {
        Auth::guard('staff')
            ->logout();

        return redirect()
            ->route('staff.login');
    }
}

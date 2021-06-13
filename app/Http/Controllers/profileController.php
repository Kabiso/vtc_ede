<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class profileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        return view('profile.index', compact('user'));
    }

    public function edit(User $user)
    {
        return view('profile.edit', compact('user'));
    }

    public function update(User $user)
    {
        $data = request()->validate([

            'name' => ['required', 'string', 'max:255'],
            'contactNo' =>['required','digits:8' ],
            'gender'=> 'required|in:M,F' ,
            'address' => ['required', 'string','max:255']
        ]);

        auth()->user()->update($data);

        Return redirect("/")->with('message', 'Profile is Updated!');
    }
}

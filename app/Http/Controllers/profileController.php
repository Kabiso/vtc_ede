<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


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

    public function update(Request $request, User $user)
    {
        $data = request()->validate([

            'name' => ['required', 'string', 'max:255'],
            'contactNo' =>['required','digits:8' ],
            'gender'=> 'required|in:M,F' ,
            'address' => ['required', 'string','max:255']
        ]);

        $user = Auth::user();
        $user->custname = $request['name'];
        $user->contactNo = $request['contactNo'];
        $user->custGender = $request['gender'];
        $user->custAddress = $request['address'];
        $user->save();

        
        

        

        Return redirect("/")->with('message', 'Profile is Updated!');
    }
}

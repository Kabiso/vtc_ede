<?php

namespace App\Http\Controllers;

use App\jobtitles;
use App\staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class staffAcctController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('staff.viewAcct');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staff.createAcct');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();



        $rules = array(
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:staff'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'contactNo' => ['required', 'digits:8'],
            'gender' => 'required|in:M,F',
            'jobtitle' => ['required']
        );


        $job_id = jobtitles::where('title', $request['jobtitle'])->first()->id;
        $validator = Validator::make($input, $rules);


        $staff = new staff;
        $staff->stfName = $request['name'];
        $staff->email = $request['email'];
        $staff->password = Hash::make($request['password']);
        $staff->stfConactNo = $request['contactNo'];
        $staff->stfGender = $request['gender'];
        $staff->jobtitles_id = $job_id;
        $staff->save();


        return redirect("staff/staffacct")->with('message', 'Account is created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(staff $staff)
    {

        return view('staff.editAcct', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, staff $staff)
    {
        $data = request()->validate([

            'name' => ['required', 'string', 'max:255'],

            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'contactNo' => ['required', 'digits:8'],
            'gender' => 'required|in:M,F',
            'jobtitle' => ['required']
        ]);

        $job_id = jobtitles::where('title', $request['jobtitle'])->first()->id;


        $staff->stfName = $request['name'];
        $staff->password = Hash::make($request['password']);
        $staff->stfConactNo = $request['contactNo'];
        $staff->stfGender = $request['gender'];
        $staff->jobtitles_id = $job_id;
        $staff->save();



        return redirect('staff/staffacct')->with('message', 'Account is Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(staff $staff)
    {
        $staff->delete();

        return redirect('staff.staffacct')->with('message', 'Account is Deleted!');
    }
}

<?php

namespace App\Http\Controllers;

use App\jobtitles;
use App\staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;


class staffAcctController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('sysAdmin'))
        {
            $staffs = staff::where('jobtitles_id', '!=' , '1')->paginate(15);
            return view('staff.viewAcct')->with('staffs',$staffs);
        }else{
            return redirect('staff/')->with('alert','You are not allow to perfom such action!');
        }
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('sysAdmin'))
        {
            return view('staff.createAcct');
        }else{
            return redirect('staff/')->with('alert','You are not allow to perfom such action!');
        }
    }   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // Return user to 403 error page
         $this->authorize('sysAdmin');

        $input = $request->all();

        $data = request()->validate([

            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:staff'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'contactNo' => ['required', 'digits:8'],
            'gender' => 'required|in:M,F',
            'jobtitle' => ['required']
        ]);

        $job_id = jobtitles::where('title', $request['jobtitle'])->first()->id;
       


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
        if (Gate::allows('sysAdmin'))
        {
            return view('staff.editAcct', compact('staff'));
        }else{
            return redirect('staff/')->with('alert','You are not allow to perfom such action!');
        }
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
        $this->authorize('sysAdmin');

        $data = request()->validate([

            'name' => ['required', 'string', 'max:255'],
            'password' => ['sometimes','nullable','string', 'min:8', 'confirmed'],
            'contactNo' => ['required', 'digits:8'],
            'gender' => 'required|in:M,F',
            'jobtitle' => ['required']
        ]);

        $job_id = jobtitles::where('title', $request['jobtitle'])->first()->id;


        $staff->stfName = $request['name'];
        $request['password'] == '' ? '' : $staff->password = Hash::make($request['password']);
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
        $this->authorize('sysAdmin');

        $staff->delete();

        return redirect('staff/staffacct')->with('message', 'Account is Deleted!');
    }

   
} 
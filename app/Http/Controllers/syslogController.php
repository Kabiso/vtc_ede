<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\charges;
use App\syslog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Redirect;

class syslogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $syslog =syslog::all()->paginate(15);
        //    $charges = charges::where('chargeid', '!=' , '1')->paginate(15);
            return view('staff.viewsyslog')->with('syslog',$syslog);
  
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
            return view('staff.createcharges');
      
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

        $data = request()->validate([

            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
       //     'contactNo' => ['required', 'digits:8'],
            'gender' => 'required'
      
        ]);
   $check = charges::where('shiptype', $request['name'])->where('shiparea', $request['gender'])->where('shipweight', $request['email'])->get();
   //$checkid = charges::where('shiptype', $request['name'])->where('shiparea', $request['gender'])->where('shipweight', $request['email'])->first()->checkid;
   if(count($check)>0){
       //   return back()->withErrors('alert','You are not allow to perfom such action!');
          return Redirect::to('staff/charges/create')->withErrors('Duplicate input, Please check.')->withInput();
     }else{
       
      
        $charges = new charges;
        $charges->shiptype = $request['name'];
        $charges->shipweight  = $request['email'];
        $charges->shipfee =$request['password'];
     //   $charges->shipfee = $request['contactNo'];
        $charges->shiparea = $request['gender'];
      //  $charges->jobtitles_id = $job_id;
        $charges->save();
        $user_id = Auth::user()->id;
        $user_name1 = Auth::user()->custname;
        $user_name2 = Auth::user()->stfName;
        if(isset( $user_name1)){
    
           $user_name = $user_name1;
        }else{
          $user_name =$user_name2;
        }
    
                
                 
               
    
                syslog::create([
                    'userid' =>   $user_id,
                    'username' => $user_name ,
                    'oid' => $charges->chargeid,
                    'action' => "Shipment Fee  created, chargesController.store",
                    'actioncode' => '1',
                   
            
            
                ]);
    }
        return redirect("staff/charges")->with('message', 'Shipment Fee record is created!');
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
    public function edit(charges $charges)
    {
       
            return view('staff.editcharges', compact('charges'));
     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, charges $charges) 
    {
        $this->authorize('sysAdmin');

        $data = request()->validate([

            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'password' => ['sometimes','string'],
     //       'contactNo' => ['required'],
            'gender' => 'required',
 //           'jobtitle' => ['required']
        ]);

     //   $job_id = jobtitles::where('title', $request['jobtitle'])->first()->id;

   //  $check = charges::where('shiptype', $request['name'])->where('shiparea', $request['gender'])->where('shipweight', $request['email'])->get();

     //if(count($check)>0){
        //   return back()->withErrors('alert','You are not allow to perfom such action!');
    //       return Redirect::to('staff/charges/create')->withErrors('Duplicate input, Please check.')->withInput();
    //  }else{
         
     $charges->shiptype = $request['name'];
     $charges->shipweight  = $request['email'];
     $charges->shipfee =$request['password'];
  //   $charges->shipfee = $request['contactNo'];
     $charges->shiparea = $request['gender'];
   //  $charges->jobtitles_id = $job_id;
     $charges->save();
     $user_id = Auth::user()->id;
     $user_name1 = Auth::user()->custname;
     $user_name2 = Auth::user()->stfName;
     if(isset( $user_name1)){
 
        $user_name = $user_name1;
     }else{
       $user_name =$user_name2;
     }
 
             
              
            
 
             syslog::create([
                 'userid' =>   $user_id,
                 'username' => $user_name ,
                 'oid' => $charges->chargeid,
                 'action' => "Shipment Fee  edited, chargesController.update",
                 'actioncode' => '3',
                
         
         
             ]);
    //  }
        return redirect('staff/charges')->with('message', 'Shipment Fee record is Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(charges $charges)
    {
        $this->authorize('sysAdmin');

        $charges->delete();

        $user_id = Auth::user()->id;
        $user_name1 = Auth::user()->custname;
        $user_name2 = Auth::user()->stfName;
        if(isset( $user_name1)){
    
           $user_name = $user_name1;
        }else{
          $user_name =$user_name2;
        }
    
                
                 
               
    
                syslog::create([
                    'userid' =>   $user_id,
                    'username' => $user_name ,
                    'oid' => $charges->chargeid,
                    'action' => "Shipment Fee  Deleted, chargesController.destroy",
                    'actioncode' => '4',
                   
            
            
                ]);






        return redirect('staff/charges')->with('message', 'Shipmet Fee record is Deleted!');
    }

   
} 
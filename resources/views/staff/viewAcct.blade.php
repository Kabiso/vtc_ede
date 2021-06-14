@extends('layouts.staffhead')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            @if (session('message'))
            <div class="alert alert-success mb-2">
             {{ session()->get('message') }}
            </div>  
            @endif
            
            <div class="card">
                <div class="card-header text-white font-weight-bold sloginbar">{{ __('View Staff Account') }}</div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Name</th>
                              <th scope="col">Email</th>
                              <th scope="col">Gender</th>
                              <th scope="col">Job Title</th>
                              <th scope="col">Contact Number</th>
                              <th scope="col" class="pl-3">Edit</th>
                              <th scope="col">Delete</th>
                            </tr>
                          </thead>

                          <tbody>
                            @foreach(App\staff:: all() as $staff)
                            <tr>
                                <td>{{$staff->id}}</td>
                                <td>{{$staff->stfName}}</td>
                                <td>{{$staff->email}}</td>
                                <td>{{$staff->stfGender}}</td>
                                <td>{{App\jobtitles::find($staff->jobtitles_id)->title}}</td>
                                <td>{{$staff->stfConactNo}}</td>
                                <td><button class="btn btn-success" onclick="window.location='/staff/staffacct/{{ $staff->id }}/edit'"  >Edit</button></td>
                                <td>
                                    <form action="/staff/staffacct/{{ $staff->id }}" method="POST" onsubmit="return confirm('Confirm to delete? ')">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                          </tbody>

                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

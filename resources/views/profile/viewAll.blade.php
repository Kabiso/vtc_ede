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
                <div class="card-header text-white font-weight-bold sloginbar">{{ __('View Customer Account') }}</div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Name</th>
                              <th scope="col">Email</th>
                              <th scope="col">Gender</th>
                              <th scope="col">Contact Number</th>
                              <th scope="col">Credit</th>
                              <th scope="col">Credit Limit</th>
                              <th scope="col" class="pl-3">View</th>
                              <th scope="col" class="pl-3">Edit</th>
                              <th scope="col">Delete</th>
                            </tr>
                          </thead>

                          <tbody>
                            @foreach(App\user:: all() as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->custname}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->custGender}}</td>
                                <td>{{$user->contactNo}}</td>
                                <td>{{$user->credit}}</td>
                                <td>{{$user->creditLimit}}</td>
                                <td><button class="btn btn-success" onclick="window.location='/staff/profile/{{ $user->id }}'"  >View</button></td>
                                <td><button class="btn btn-success" onclick="window.location='/staff/profile/{{ $user->id }}/edit'"  >Edit</button></td>
                                <td>
                                    <form action="" method="POST" onsubmit="return confirm('Confirm to delete? ')">
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

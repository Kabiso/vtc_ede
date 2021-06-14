@extends('layouts.staffhead')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white font-weight-bold sloginbar">{{ __('Edit Staff') }}</div>

                <div class="card-body">
                    <form method="POST" action="/staff/staffacct/{{$staff->id}}">
                        @csrf
                        @method('patch') 
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $staff->stfName ?? old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="form-check form-check-inline pl-3">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="M"   {{$staff->stfGender == 'M' ?  'checked': '' }} >
                                <label class="form-check-label" for="male">Male</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="F"   {{$staff->stfGender == 'F' ?  'checked': '' }}>
                                <label class="form-check-label" for="female">Female</label>
                              </div>
                        </div>



                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" disabled class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $staff->email ?? old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                       

                        <div class="form-group row">
                            <label for="contactNo" class="col-md-4 col-form-label text-md-right">{{ __('Contact Number') }}</label>

                            <div class="col-md-6">
                                <input id="contactNo" type="tel" class="form-control @error('contactNo') is-invalid @enderror" name="contactNo" value=" {{ $staff->stfConactNo ?? old('contactNo') }} " required autocomplete="contactNo">

                                @error('contactNo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jobtitle" class="col-md-4 col-form-label text-md-right">{{ __('Job Title') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" id="jobtitle" name="jobtitle" required>
                                    <option value="">Please choose</option>
                                    <option vaule="System Admin" {{ $staff->jobtitles_id == '1' ? 'selected' : '' }}>System Admin</option>
                                    <option vaule="Operations Manager" {{ $staff->jobtitles_id == '2' ? 'selected' : '' }}>Operations Manager</option>
                                    <option vaule="Operations Supervisor" {{ $staff->jobtitles_id == '6' ? 'selected' : '' }}>Operations Supervisor</option>
                                    <option vaule="Account Executive" {{ $staff->jobtitles_id == '4' ? 'selected' : '' }}>Account Executive</option>
                                    <option vaule="Booking Clerk" {{ $staff->jobtitles_id == '5' ? 'selected' : '' }}>Booking Clerk</option>
                                    <option vaule="Shipment Clerk" {{ $staff->jobtitles_id == '6' ? 'selected' : '' }}>Shipment Clerk</option>
                                    <option value="Van Driver" {{ $staff->jobtitles_id == '7' ? 'selected' : '' }}>Van Driver</option>
                                  </select>
                                @error('jobtitle')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Edit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

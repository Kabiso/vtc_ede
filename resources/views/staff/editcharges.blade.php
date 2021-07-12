@extends('layouts.staffhead')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white font-weight-bold sloginbar">{{ __('Edit Fee') }}</div>

                <div class="card-body">
                    <form method="POST" action="/staff/charges/{{$charges->chargeid}}">
                        @csrf
                        @method('patch') 
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Shipment Type') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $charges->shiptype ?? old('name') }}" >

                             </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Shipment Area') }}</label>

                            <div class="form-check form-check-inline pl-3">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="ALL"   {{$charges->shiparea == 'ALL' ?  'checked': '' }} >
                                <label class="form-check-label" for="male">ALL</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="AUSTRALIA"   {{$charges->shiparea == 'AUSTRALIA' ?  'checked': '' }}>
                                <label class="form-check-label" for="female">AUSTRALIA</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="JAPAN"   {{$charges->shiparea == 'JAPAN' ?  'checked': '' }}>
                                <label class="form-check-label" for="female">JAPAN</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="CHINA"   {{$charges->shiparea == 'CHINA' ?  'checked': '' }}>
                                <label class="form-check-label" for="female">CHINA</label>
                              </div>
                        </div>



                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('shipweight') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="number"  class="form-control" name="email" value="{{ $charges->shipweight ?? old('email') }}" >

                              
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('shipfee') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="number" class="form-control" name="password"value="{{ $charges->shipfee ?? old('password') }}" >

                               
                            </div>
                        </div>

                <!--        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  >
                            </div>
                        </div>
                       

                        <div class="form-group row">
                            <label for="contactNo" class="col-md-4 col-form-label text-md-right">{{ __('Contact Number') }}</label>

                            <div class="col-md-6">
                                <input id="contactNo" type="tel" class="form-control @error('contactNo') is-invalid @enderror" name="contactNo" value=" {{ $staff->stfConactNo ?? old('contactNo') }} " >

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
                                    @foreach(App\charges:: all() as $charges)

                                    <option vaule="{{ $charges->title }}" {{ $charges->jobtitles_id == $charges->id ? 'selected' : '' }}>{{ $charges->title }}</option>
                                   
                                    @endforeach
                                  </select>
                                @error('jobtitle')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>-->
                        

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

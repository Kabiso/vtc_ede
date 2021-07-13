@extends('layouts.staffhead')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white font-weight-bold sloginbar">{{ __('Create charges') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('charges.store') }}">
                        @csrf

               <!--         <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Shipment type') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

                            
                            </div>
                        </div>-->

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Shipment Type') }}</label>

                        <div class="col-md-6">
                                <select class="form-control" id="name" name="name" required>
                                    <option value="">Please choose</option>
                                    
                                    @foreach(App\charges::latest()->get()->unique('shiptype') as $charge)
                                    <option vaule="{{ $charge->shiptype }}">{{ $charge->shiptype }}</option>
                                    @endforeach  
                                  </select>
                             
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Shipment Area') }}</label>
                        <div class="col-md-6">
                                <select class="form-control" id="gender" name="gender" required>
                                    <option value="">Please choose</option>
                                    
                                    @foreach(App\charges::latest()->get()->unique('shiparea') as $charge)
                                    <option vaule="{{ $charge->shiparea }}">{{ $charge->shiparea}}</option>
                                    @endforeach  
                                  </select>
                             
                            </div>
                        </div>

                   <!--     <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Shipment Area') }}</label>

                            <div class="form-check form-check-inline pl-3">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="ALL">
                                <label class="form-check-label" for="male">ALL Area</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="AUSTRALIA">
                                <label class="form-check-label" for="female">AUSTRALIA</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="JAPAN">
                                <label class="form-check-label" for="female">JAPAN</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="CHINA">
                                <label class="form-check-label" for="female">CHINA</label>
                              </div>
                              
                        </div>-->



                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Shipment Weight') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="number" class="form-control" name="email" value="{{ old('email') }}" >

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Shipment Fee') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="number" class="form-control" name="password" >

                               
                            </div>
                        </div>

                        

               <!--        <div class="form-group row">
                            <label for="jobtitle" class="col-md-4 col-form-label text-md-right">{{ __('Shipment Type') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" id="jobtitle" name="jobtitle" required>
                                    <option value="">Please choose</option>
                                    
                                    @foreach(App\charges::latest()->get()->unique('shiptype') as $charge)
                                    <option vaule="{{ $charge->shiptype }}">{{ $charge->shiptype }}</option>
                                    @endforeach  
                                  </select>
                             
                            </div>
                        </div>-->
                        

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
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

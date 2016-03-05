@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading bojaLek"><strong>Enter your information</strong></div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label bojaLek"   >Name</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter your name">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label bojaLek" >Last Name</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" placeholder="Enter your lastname">

                                    @if ($errors->has('lastname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label bojaLek " >E-Mail Address</label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter your e-mail adress">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('adress') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label bojaLek" >Address</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="adress" value="{{ old('adress') }}" placeholder="Enter your address">

                                    @if ($errors->has('adress'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('adress') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('tel_number') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label bojaLek" >Mobile Phone</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="tel_number" value="{{ old('tel_number') }}" placeholder="Enter your mobile phone">

                                    @if ($errors->has('tel_number'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('tel_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label bojaLek" >Select your pharmacy</label>

                                <div class="col-md-6">

                                    @if ( !$data->count() )
                                        You have no pharmacies
                                    @else
                                        <select name="pharmacies" class="pull-right form-control">
                                            @foreach( $data as $pharmacy )
                                                <option value="{{$pharmacy->id}}">{{ $pharmacy->name }}</option>
                                            @endforeach
                                        </select>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('img_url') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label bojaLek" >Image URL:</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="img_url" value="{{ old('img_url') }}" placeholder="Enter image(profile photo) url">

                                    @if ($errors->has('img_url'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('img_url') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label bojaLek" >Password</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password" placeholder="Enter password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label bojaLek" >Confirm Password</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Enter your password again">

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn  btn-success pull-right">
                                        <i class="fa fa-btn fa-user"></i>Sign Up
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

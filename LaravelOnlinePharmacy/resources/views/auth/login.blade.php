@extends('app')

@section('content')

    <body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 ">
                <div class="panel panel-default ">
                    <div class="panel-heading "><strong>Log In</strong></div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label bojaLek">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter your e-mail adress">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label bojaLek">Password</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password" placeholder="Enter password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-btn fa-sign-in"></i>Log In
                                    </button>

                                    <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <body>
@endsection
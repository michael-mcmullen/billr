@extends('layouts.blank')

@section('page-title')
    Login
@stop

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-6">

                <h1 class="page-header">
                    Forgot Password for Billr
                </h1>

                @include('layouts.partials.messages')

                <form method="POST" action="{{ URL::to('password/email') }}">
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-success btn-lg btn-block" value="Send Password Reset Link">
                    </div>

                </form>

            </div>
            
            <div class="col-md-6">

                <h1 class="page-header">
                    Remember your password?
                </h1>

                <div class="row">
                    <div class="col-md-12">
                        <p>
                            Passwords can be tough. Once in awhile we remember them at the strangest time.
                        </p>
                        <p>
                            If you have remembered your password, you can log in by using the button below.
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ URL::to('auth/login') }}" class="btn btn-primary btn-block">Login</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

@stop
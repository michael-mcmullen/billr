@extends('layouts.blank')

@section('page-title')
    Login
@stop

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-6">

                <h1 class="page-header">
                    Login to Billr
                </h1>

                @include('layouts.partials.messages')

                <form method="POST" action="{{ URL::to('auth/login') }}">
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="remember">Remember Me</label>
                        <input type="checkbox" id="remember" name="remember">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg">Login to your account</button>
                        <a href="{{ URL::to('/auth/register') }}" class="btn btn-default">Register New Account</a>
                    </div>

                </form>

            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Forgot Password?
                    </div>
                    <div class="panel-body">
                        <p>
                            No worries, you can get a new password by clicking the button below.
                        </p>
                        <a href="{{ URL::to('auth/forgot') }}" class="btn btn-primary">Forgot Password</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@extends('layouts.master')

@section('page-title')
    Login
@stop

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <h1 class="page-header">
                    Log in to MyBillr
                </h1>

                @include('layouts.partials.messages')

                <div id="login">
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
                            <button type="submit" class="btn btn-success">Login to your account</button>
                            <a href="{{ URL::to('/auth/register') }}" class="btn btn-default">Register New Account</a>
                            <div class="pull-right">
                                <a href="{{ URL::to('password/email') }}" class="btn btn-link"><i class="fa fa-question-circle"></i> Forgot Password ?</a>
                            </div>
                        </div>

                    </form>
                </div> <!-- login -->

            </div>
        </div>
    </div>

@stop
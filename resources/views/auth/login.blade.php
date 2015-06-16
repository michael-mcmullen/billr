@extends('layouts.blank')

@section('page-title')
    Login
@stop

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>
                Login
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <form method="POST" action="{{ URL::to('auth/login') }}">
                {!! csrf_field() !!}

                <div>
                    Email
                    <input type="email" name="email" value="{{ old('email') }}">
                </div>

                <div>
                    Password
                    <input type="password" name="password" id="password">
                </div>

                <div>
                    <input type="checkbox" name="remember"> Remember Me
                </div>

                <div>
                    <button type="submit">Login</button>
                </div>

                <div>
                    <a href="{{ URL::to('/auth/register') }}">Register Account</a>
                </div>

            </form>

        </div>
    </div>
</div>


@stop
@extends('layouts.blank')

@section('page-title')
    Register
@stop

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>
                Register
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{ URL::to('auth/register') }}">
                {!! csrf_field() !!}

                <div class="col-md-6">
                    Name
                    <input type="text" name="name" value="{{ old('name') }}">
                </div>

                <div>
                    Email
                    <input type="email" name="email" value="{{ old('email') }}">
                </div>

                <div>
                    Password
                    <input type="password" name="password">
                </div>

                <div class="col-md-6">
                    Confirm Password
                    <input type="password" name="password_confirmation">
                </div>

                <div>
                    <button type="submit">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>


@stop
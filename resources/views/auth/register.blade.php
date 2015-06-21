@extends('layouts.blank')

@section('page-title')
    Register
@stop

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-6">
                <h1 class="page-header">
                    Register new account
                </h1>

                <form method="POST" action="{{ URL::to('auth/register') }}">
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="confirm">Confirm Password</label>
                        <input type="password" id="confirm" name="password_confirmation" class="form-control">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg">Register</button>
                        <a href="{{ URL::to('/auth/login') }}" class="btn btn-default">I already have an account</a>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <h1 class="page-header">
                    Why Sign Up
                </h1>
                <p>
                    Just because ok
                </p>
            </div>
        </div>
    </div>

@stop
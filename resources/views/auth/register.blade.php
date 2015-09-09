@extends('layouts.master')

@section('page-title')
    Create new Acccount
@stop

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1 class="page-header">
                    Create a MyBillr Account
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
                        <button type="submit" class="btn btn-success">Register</button>
                        <div class="pull-right">
                            <a href="{{ URL::to('/auth/login') }}" class="btn btn-link">I already have an account</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop
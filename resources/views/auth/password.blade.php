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
                        <button type="submit" class="btn btn-success btn-lg">Send Password Reset Link</button>
                        <a href="{{ URL::to('/auth/login') }}" class="btn btn-default">Login</a>
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
                        <a href="{{ URL::to('password/email') }}" class="btn btn-primary">Forgot Password</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
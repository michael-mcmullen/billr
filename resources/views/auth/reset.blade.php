@extends('layouts.master')

@section('page-title')
    Reset your Password
@stop

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <h1 class="page-header">
                    Reset your Password
                </h1>

                @include('layouts.partials.messages')

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ URL::to('password/reset') }}">
                    {!! csrf_field() !!}
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Password Confirmation</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Reset Password</button>
                        <div class="pull-right">
                            <a href="{{ URL::to('/auth/login') }}" class="btn btn-link">Back to Login</a>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>

@stop
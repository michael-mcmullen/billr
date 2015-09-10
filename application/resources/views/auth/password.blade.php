@extends('layouts.master')

@section('page-title')
    Forgot Password
@stop

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <h1 class="page-header">
                    Forgot Password for MyBillr
                </h1>

                @include('layouts.partials.messages')

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ URL::to('password/email') }}">
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Send Password Reset Link">
                        <div class="pull-right">
                            <a href="{{ URL::to('auth/login') }}" class="btn btn-link"><i class="fa fa-lock"></i> Login</a>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>

@stop
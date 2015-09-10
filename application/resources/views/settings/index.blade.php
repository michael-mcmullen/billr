@extends('layouts.master')

@section('javascript')
@stop

@section('content')
<div class="container">
  <div class="row">

    <div class="col-md-12">
        <h1 class="page-header">
            Settings
        </h1>

            @include('layouts.partials.messages')

        {!! Form::open(['route' => 'settings.update']) !!}

            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="123-456-7890" value="{{ old('phone_number', Auth::user()->phone_number) }}">
            </div>

            <div class="form-group">
                <label for="phone_provider">Provider</label>
                {!! Form::select('phone_provider', $providers, old('phone_provider', Auth::user()->phone_provider), ['class' => 'form-control select', 'id' => 'phone_provider']) !!}
            </div>

            <div class="form-group">
                <label for="notification_type">
                    Notification Type
                </label>
                {!! Form::select('notification_type', $notifications, old('notification_type', Auth::user()->notification_type), ['class' => 'form-control select', 'id' => 'notification_type']) !!}
                <div class="clearfix">&nbsp;</div>
                <div class="alert alert-info alert-no-close">
                    If you are choosing SMS you will need to provide your phone number and provider
                </p>
            </div>

            <div class="form-group">
                <label for="notification_days">Days before receiving a Notification</label>
                <input type="text" class="form-control" id="notification_days" name="notification_days" placeholder="123-456-7890" value="{{ old('notification_days', Auth::user()->notification_days) }}">
            </div>

            <div class="form-group">
                @if(Auth::user()->canSMS())
                    <div class="pull-right">
                        <a href="{{ URL::route('settings.testSMS') }}" class="btn btn-primary"><i class="fa fa-mobile"></i> Send SMS Test</a>
                    </div>
                @else
                    <div class="pull-right">
                        <a href="{{ URL::route('settings.testEmail') }}" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send Email Test</a>
                    </div>
                @endif

                <input type="submit" class="btn btn-success" value="Save Settings">
                <a href="{{ URL::route('home') }}" class="btn btn-danger">Cancel</a>
            </div>

        {!! Form::close() !!}

    </div>

  </div>
</div>

@stop
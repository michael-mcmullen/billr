@extends('layouts.master')

@section('javascript')
    <script>
        $(function(){
            $("#company_name").focus();
        });
    </script>
@stop

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">

            {!! Form::open(['route' => 'company.insert', 'autocomplete' => 'off']) !!}

                <div class="panel panel-default">
                    <div class="panel-heading">
                        New Company
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="company_name">Company Name</label>
                            <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Example Co" value="{{ old('company_name') }}">
                        </div>
                        <div class="form-group">
                            <label for="account_number">Account Number</label>
                            <input type="text" class="form-control" id="account_number" name="account_number" placeholder="1234-56748-94241" value="{{ old('account_number') }}">
                        </div>
                    </div>
                    <div class="panel-footer">
                        <input type="submit" class="btn btn-fresh text-uppercase" value="Save Company" onclick="switchElement(this, 'ajax-loading');">
                        <div id="ajax-loading" class="ajax-wait">
                            <img src="{{ asset('assets/images/spinner.gif') }}"> Please Wait ...
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}

            @include('layouts.partials.messages')

        </div>
        <div class="col-md-6">
            <p>
                put something nice in here to help the user
            </p>
        </div>
    </div>
</div>

@stop
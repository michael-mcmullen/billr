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

            <div class="page-header">
                <h1>
                    Add Bill <small>add a bill to track</small>
                </h1>
            </div>

            {!! Form::open(['route' => 'bill.insert', 'autocomplete' => 'off']) !!}


            <div class="panel panel-default">
                <div class="panel-heading">
                    New Bill
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="company_id">Company</label>
                        {!! Form::select('company_id', Auth::user()->companies()->where('active', true)->get()->lists('name', 'id'), old('company_id'), ['class' => 'form-control', 'id' => 'company_id']) !!}
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <div class="input-group">
                            <div class="input-group-addon">$</div>
                            <input type="text" class="form-control" name="amount" id="amount" placeholder="1999.99" value="{{ old('amount') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="due_date">Due Date</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            <input type="text" class="form-control" id="due_date" name="due_date" placeholder="2016-06-16" value="{{ old('due_date') }}">
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <input type="submit" class="btn btn-fresh" value="Save Bill" onclick="switchElement(this, 'ajax-loading');">
                    <a href="{{ URL::route('bill') }}" class="btn btn-hot" onclick="switchElement(this, 'ajax-loading');">Cancel</a>
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
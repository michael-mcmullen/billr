@extends('layouts.master')

@section('javascript')
    <script>
        $(function(){
            $("#due_date").datepicker({
                format: "yyyy-mm-dd",
                todayBtn: "linked",
                autoclose: true
            });
            $("#received").datepicker({
                format: "yyyy-mm-dd",
                todayBtn: "linked",
                autoclose: true
            });
            $("#paid_date").datepicker({
                format: "yyyy-mm-dd",
                todayBtn: "linked",
                autoclose: true
            });
        });

        function copyAmount() {
            $("#paid_amount").val($("#amount").val());
        }
    </script>
@stop

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="page-header">
                <h3>
                    Add Bill <small>add a bill to track</small>
                </h3>
            </div>

            {!! Form::open(['route' => 'bill.insert', 'autocomplete' => 'off']) !!}


            <div class="panel panel-default">
                <div class="panel-heading">
                    New Bill
                </div>
                <div class="panel-body">

                    <!-- COMPANY -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="company_id">Company</label>
                                {!! Form::select('company_id', Auth::user()->companies()->where('active', true)->get()->lists('name', 'id'), old('company_id', $company_id), ['class' => 'form-control select', 'id' => 'company_id']) !!}
                            </div>
                        </div>
                    </div>

                    <!-- AMOUNT -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="text" class="form-control" name="amount" id="amount" placeholder="1999.99" value="{{ old('amount') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- RECEIVED ON / DUE -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="received">Receive On</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="text" class="form-control" id="received" name="received" value="{{ old('received', date('Y-m-d')) }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="due_date">Due Date</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="text" class="form-control" id="due_date" name="due_date" value="{{ old('due_date', date('Y-m-d')) }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- BILL PAID -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="paid">Is Bill Paid?</label>
                                {!! Form::select('paid', [0 => 'No', 1 => 'Yes'], old('paid', 0), ['class' => 'form-control', 'id' => 'paid']) !!}
                            </div>
                        </div>
                    </div>

                    <!-- PAID DATE -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="paid_date">Paid Date</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="text" class="form-control" name="paid_date" id="paid_date" value="{{ old('paid_date') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PAID AMOUNT / REFERENCE -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="paid_amount">Paid Amount</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="text" class="form-control" name="paid_amount" id="paid_amount" placeholder="1999.99" value="{{ old('paid_amount') }}">
                                    <span class="input-group-btn">
                                        <a href="#" class="btn btn-inline btn-primary" onclick="copyAmount(); return false;">Copy Amount</a>
                                     </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="reference_number">Reference</label>
                                <input type="text" class="form-control" name="reference_number" id="reference_number" placeholder="15489" value="{{ old('reference_number') }}">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="panel-footer">
                    <input type="submit" class="btn btn-success text-uppercase btn-lg" value="Save Bill" onclick="switchElement(this, 'ajax-loading');">
                <a href="{{ URL::route('bill') }}" class="btn btn-danger" onclick="switchElement(this, 'ajax-loading');">Cancel</a>
                    <div id="ajax-loading" class="ajax-wait">
                        <img src="{{ asset('assets/images/spinner.gif') }}"> Please Wait ...
                    </div>
                </div>
            </div>

            {!! Form::close() !!}

            @include('layouts.partials.messages')

        </div>
    </div>
</div>

@stop
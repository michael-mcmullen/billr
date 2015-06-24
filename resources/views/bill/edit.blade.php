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

        function deleteBill(id) {
            swal({
                    title: "Are you sure?",
                    text: "Are your sure you want to delete this bill?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it",
                    cancelButtonText: "No, cancel",
                    closeOnConfirm: false,
                    closeOnCancel: true
                },
                function(isConfirm){
                    if (isConfirm) {
                        swal("Deleting", "Please wait while your bill is deleted", "success");
                        window.location.href = $("#bill-delete-" + id).val();
                    }
                }
            );
        }
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

            {!! Form::open(['route' => ['bill.update', $bill['id']], 'autocomplete' => 'off']) !!}


            <div class="panel panel-default">
                <div class="panel-heading">
                    New Bill
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="company_id">Company</label>
                        {!! Form::select('company_id', Auth::user()->companies()->where('active', true)->get()->lists('name', 'id'), old('company_id', $bill['company_id']), ['class' => 'form-control select', 'id' => 'company_id']) !!}
                    </div>
                    {{-- /end COMPANY --}}
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <div class="input-group">
                            <div class="input-group-addon">$</div>
                            <input type="text" class="form-control" name="amount" id="amount" placeholder="1999.99" value="{{ old('amount', $bill['amount']) }}">
                        </div>
                    </div>
                    {{-- /end AMOUNT --}}
                    <div class="form-group">
                        <label for="received">Receive On</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            <input type="text" class="form-control" id="received" name="received" value="{{ old('received', date('Y-m-d', strtotime($bill['received']))) }}">
                        </div>
                    </div>
                    {{-- /end RECEIVED ON --}}
                    <div class="form-group">
                        <label for="due_date">Due Date</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            <input type="text" class="form-control" id="due_date" name="due_date" value="{{ old('due_date', date('Y-m-d', strtotime($bill['due']))) }}">
                        </div>
                    </div>
                    {{-- /end PAID --}}
                    <div class="form-group">
                        <label for="paid">Paid Amount</label>
                        {!! Form::select('paid', [0 => 'No', 1 => 'Yes'], old('paid', $bill['paid']), ['class' => 'form-control', 'id' => 'paid']) !!}
                    </div>
                    {{-- /end PAID AMOUNT --}}
                    <div class="form-group">
                        <label for="paid_amount">Paid Amount</label>
                        <div class="input-group">
                            <div class="input-group-addon">$</div>
                            <input type="text" class="form-control" name="paid_amount" id="paid_amount" placeholder="1999.99" value="{{ old('paid_amount', $bill['paid_amount']) }}">
                        </div>
                    </div>
                    {{-- /end PAID DATE --}}
                    <div class="form-group">
                        <label for="paid_date">Paid Date</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            <input type="text" class="form-control" name="paid_date" id="paid_date" value="{{ old('paid_date', ($bill['paid_date'] != '-0001-11-30 00:00:00' ? date('Y-m-d', strtotime($bill['paid_date'])) : '')) }}">
                        </div>
                    </div>
                    {{-- /end REFERENCE --}}
                    <div class="form-group">
                        <label for="reference_number">Reference</label>
                        <input type="text" class="form-control" name="reference_number" id="reference_number" placeholder="15489" value="{{ old('reference_number', $bill['reference_number']) }}">
                    </div>

                </div>

                <div class="panel-footer">
                    <input type="submit" class="btn btn-fresh btn-lg" value="Save Bill" onclick="switchElement(this, 'ajax-loading');">
                    <a href="{{ URL::route('bill') }}" class="btn btn-hot" onclick="switchElement(this, 'ajax-loading');">Cancel</a>

                    <div class="pull-right">
                        <a href="{{ URL::route('bill.delete', $bill['id']) }}" class="btn btn-sky" onclick="deleteBill('{{ $bill['id'] }}'); return false;"><i class="fa fa-trash-o"></i> Delete Bill</a>
                        <input type="hidden" id="bill-delete-{{ $bill['id']}}" value="{{ URL::route('bill.delete', $bill['id']) }}">
                    </div>

                    <div id="ajax-loading" class="ajax-wait">
                        <img src="{{ asset('assets/images/spinner.gif') }}"> Please Wait ...
                    </div>
                </div>
            </div>

            {!! Form::close() !!}

        </div>
        <div class="col-md-6">
            <div class="page-header">
                <h1>
                    Adding a bill
                </h1>
            </div>

            @include('layouts.partials.messages')

            <p>
                adding a bill information ...
            </p>
        </div>
    </div>
</div>

@stop
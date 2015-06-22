@extends('layouts.master')

@section('javascript')
    <script>
        $(function(){
            $("#paid_date").datepicker({
                format: "yyyy-mm-dd",
                todayBtn: "linked",
                autoclose: true
            });
        });

        function copyAmount(amount) {
            $("#paid_amount").val(amount);
        }
    </script>
@stop

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">

            <div class="page-header">
                <h1>
                    Pay Bill <small>complete the form below to pay your bill</small>
                </h1>
            </div>

            {!! Form::open(['route' => ['bill.paid', $bill['id']], 'autocomplete' => 'off']) !!}


            <div class="panel panel-default">
                <div class="panel-heading">
                    Pay Bill
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="company_id">Company</label>
                        <div class="input-group">
                            {{ $bill->company['name'] }}
                        </div>
                    </div>
                    {{-- /end COMPANY --}}
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <div class="input-group">
                            ${{ number_format($bill->amount, 2) }}
                        </div>
                    </div>
                    {{-- /end AMOUNT --}}
                    <div class="form-group">
                        <label for="received">Receive On</label>
                        <div class="input-group">
                            {{ date('F d, Y', strtotime($bill->received)) }}
                        </div>
                    </div>
                    {{-- /end RECEIVED ON --}}
                    <div class="form-group">
                        <label for="due_date">Due Date</label>
                        <div class="input-group">
                            {{ date('F d, Y', strtotime($bill->due)) }}
                        </div>
                    </div>
                    {{-- /end PAID --}}
                    <div class="form-group">
                        <label for="paid">Paid</label>
                        {!! Form::select('paid', [1 => 'Yes'], old('paid', 1), ['class' => 'form-control', 'id' => 'paid']) !!}
                    </div>
                    {{-- /end PAID AMOUNT --}}
                    <div class="form-group">
                        <label for="paid_amount">Paid Amount</label>
                        <div class="input-group">
                            <div class="input-group-addon">$</div>
                            <input type="text" class="form-control" name="paid_amount" id="paid_amount" placeholder="1999.99" value="{{ old('paid_amount') }}">
                             <span class="input-group-btn">
                                <a href="#" class="btn btn-inline btn-fresh" onclick="copyAmount('{{ $bill['amount'] }}'); return false;">Full Amount</a>
                             </span>
                        </div>
                    </div>
                    {{-- /end PAID DATE --}}
                    <div class="form-group">
                        <label for="paid_date">Paid Date</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            <input type="text" class="form-control" name="paid_date" id="paid_date" value="{{ old('paid_date', date('Y-m-d')) }}">
                        </div>
                    </div>
                    {{-- /end REFERENCE --}}
                    <div class="form-group">
                        <label for="reference_number">Reference</label>
                        <input type="text" class="form-control" name="reference_number" id="reference_number" placeholder="15489" value="{{ old('reference_number') }}">
                    </div>

                </div>

                <div class="panel-footer">
                    <input type="submit" class="btn btn-fresh btn-lg" value="Mark Bill as Paid" onclick="switchElement(this, 'ajax-loading');">
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
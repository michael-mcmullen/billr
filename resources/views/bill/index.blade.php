@extends('layouts.master')

@section('javascript')
@stop

@section('content')

<!-- Overdue Bills -->
<div class="container">
    <div class="row">

        @include('layouts.partials.messages')

        <div class="col-md-12">
            <div class="page-header">
                <div class="btn-group pull-right">
                    <a href="{{ URL::route('bill.add') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Bill</a>
                </div>
                <h1 class="text-danger">
                    <i class="fa fa-exclamation-circle text-danger"></i> Over Due Bills
                </h1>
            </div>
        </div>
    </div>

    @foreach($overdueBills as $bill)
        @include('bill.partials.widget-bill', ['id' => $bill['id'], 'due' => $bill->due, 'company' => $bill->company['name'], 'amount' => $bill->amount, 'nickname' => $bill->company->nickname])
    @endforeach
</div>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1>
                    Bills Due in 30 Days
                </h1>
            </div>
        </div>
    </div>

    @foreach($nextBills as $bill)
        @include('bill.partials.widget-bill', ['id' => $bill['id'], 'due' => $bill->due, 'company' => $bill->company['name'], 'amount' => $bill->amount, 'nickname' => $bill->company->nickname])
    @endforeach

</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1>
                    Upcoming Bills
                </h1>
            </div>
        </div>
    </div>

    @foreach($futureBills as $bill)
        @include('bill.partials.widget-bill', ['id' => $bill['id'], 'due' => $bill->due, 'company' => $bill->company['name'], 'amount' => $bill->amount, 'nickname' => $bill->company->nickname])
    @endforeach

</div>

@stop
@extends('layouts.master')

@section('javascript')
@stop

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="page-header">
                <h3>
                    <div class="pull-right">
                        <a href="{{ URL::route('bill.add', $company['id']) }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Bill</a>
                    </div>
                    Viewing {{ $company['name'] }} <small>Nickname: {{ $company['nickname'] }}</small>
                </h3>
            </div>

            @include('layouts.partials.messages')

            <!-- Active Bills -->
            <div class="panel panel-default">
                <div class="panel-heading">
                        Unpaid Bills
                </div>
                <table class="table table-hover table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th width="50%">
                                Amount
                            </th>
                            <th width="10%">
                                Received On
                            </th>
                            <th width="10%">
                                Due On
                            </th>
                            <th width="30%">
                                Actions
                            </th>
                        </tr>
                    </tbody>
                    <tbody>
                        @foreach($company->bills()->where('active', true)->where('paid', false)->orderBy('due')->get() as $bill)
                            <tr>
                                <td>
                                    ${{ number_format($bill['amount'], 2) }}
                                </td>
                                <td class="text-right">
                                    {{ date('F d, Y', strtotime($bill['received'])) }}
                                </td>
                                <td class="text-right">
                                    {{ date('F d, Y', strtotime($bill['due'])) }}
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm btn-group-justified">
                                        <a href="{{ URL::route('bill.edit', $bill['id']) }}" class="btn btn-info"><i class="fa fa-edit"></i> Edit Bill</a>
                                        <a href="{{ URL::route('bill.pay', $bill['id']) }}" class="btn btn-success"><i class="fa fa-check"></i> Paid Bill</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Inactive Bills -->
            <div class="panel panel-default">
                <div class="panel-heading">
                        Paid Bills
                </div>
                <table class="table table-hover table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th width="25%">
                                Amount
                            </th>
                            <th width="25%">
                                Paid
                            </th>
                            <th width="20%">
                                Paid On
                            </th>
                            <th width="20%">
                                Due On
                            </th>
                            <th width="10%">

                            </th>
                        </tr>
                    </tbody>
                    <tbody>
                        @foreach($company->bills()->where('active', true)->where('paid', true)->orderBy('due')->get() as $bill)
                            <tr>
                                <td>
                                    ${{ number_format($bill['amount'], 2) }}
                                </td>
                                <td>
                                    ${{ number_format($bill['paid_amount'], 2) }}
                                    @if(($bill['paid_amount'] - $bill['amount']) > 0)
                                        <span class="label label-success"><i class="fa fa-plus"></i> ${{ number_format(($bill['paid_amount'] - $bill['amount']), 2) }}</span>
                                    @else
                                        @if(($bill['paid_amount'] - $bill['amount']) < 0)
                                            <span class="label label-danger"><i class="fa fa-minus"></i> ${{ number_format(abs($bill['paid_amount'] - $bill['amount']), 2) }}</span>
                                        @endif
                                    @endif
                                </td>
                                <td class="text-right">
                                    {{ date('F d, Y', strtotime($bill['paid_date'])) }}
                                </td>
                                <td class="text-right">
                                    {{ date('F d, Y', strtotime($bill['due'])) }}
                                </td>
                                <td>
                                    <div class="hidden-xs">
                                        <a href="{{ URL::route('bill.edit', $bill->id) }}" class="btn btn-primary btn-xs btn-block"><i class="fa fa-pencil"></i> View</a>
                                    </div>
                                    <div class="visible-xs">
                                        <a href="{{ URL::route('bill.edit', $bill->id) }}" class="btn btn-primary btn-xs btn-block"><i class="fa fa-pencil"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

@stop
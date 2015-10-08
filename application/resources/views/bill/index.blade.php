@extends('layouts.master')

@section('javascript')
@stop

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="btn-group pull-right">
                            <a href="{{ URL::route('bill.add') }}" class="btn btn-primary" onclick="switchElement(this, 'ajax-loading');"><i class="fa fa-plus"></i> Add New Bill</a>
                            <div id="ajax-loading" class="ajax-wait">
                                <img src="{{ asset('assets/images/spinner.gif') }}"> Please Wait ...
                            </div>
                        </div>
                        <h4>
                            Bill Listing
                        </h4>
                    </div>
                    <table class="table table-hover table-bordered table-striped">
                        <tbody>
                            <tr>
                                <td width="5%">
                                &nbsp;
                                </td>
                                <th width="45%">
                                    Company
                                </th>
                                <th width="20%">
                                    Due
                                </th>
                                <th width="10%">
                                    Amount
                                </th>
                                <th width="20%">
                                    Actions
                                </th>
                            </tr>
                        </tbody>
                        <tbody>
                            @foreach($overdueBills as $bill)
                                <tr>
                                    <td class="text-center">
                                        <i class="fa fa-exclamation text-danger fa-lg"></i>
                                    </td>
                                    <td>
                                        {{ $bill->company->name }} {{ ($bill->company->nickname) ? '('. $bill->company->nickname .')' : ''  }}
                                    </td>
                                    <td class="text-right">
                                        {{ $bill->due->diffForHumans() }}
                                    </td>
                                    <td class="text-right">
                                        ${{ number_format($bill->amount, 2) }}
                                    </td>
                                    <td>
                                        <div class="hidden-xs">
                                            <a href="{{ URL::route('bill.edit', $bill->id) }}" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</a>
                                            <a href="{{ URL::route('bill.pay', $bill->id) }}" class="btn btn-success"><i class="fa fa-check"></i> Pay</a>
                                        </div>
                                        <div class="visible-xs">
                                            <a href="{{ URL::route('bill.edit', $bill->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ URL::route('bill.pay', $bill->id) }}" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @foreach($nextBills as $bill)
                                <tr>
                                    <td class="text-center">
                                        <i class="fa fa-exclamation-triangle text-warning fa-lg"></i>
                                    </td>
                                    <td>
                                        {{ $bill->company->name }} {{ ($bill->company->nickname) ? '('. $bill->company->nickname .')' : ''  }}
                                    </td>
                                    <td class="text-right">
                                        {{ $bill->due->diffForHumans() }}
                                    </td>
                                    <td class="text-right">
                                        ${{ number_format($bill->amount, 2) }}
                                    </td>
                                    <td>
                                        <div class="hidden-xs">
                                            <a href="{{ URL::route('bill.edit', $bill->id) }}" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</a>
                                            <a href="{{ URL::route('bill.pay', $bill->id) }}" class="btn btn-success"><i class="fa fa-check"></i> Pay</a>
                                        </div>
                                        <div class="visible-xs">
                                            <a href="{{ URL::route('bill.edit', $bill->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ URL::route('bill.pay', $bill->id) }}" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @foreach($futureBills as $bill)
                                <tr>
                                    <td class="text-center">
                                    </td>
                                    <td>
                                        {{ $bill->company->name }} {{ ($bill->company->nickname) ? '('. $bill->company->nickname .')' : ''  }}
                                    </td>
                                    <td class="text-right">
                                        {{ $bill->due->diffForHumans() }}
                                    </td>
                                    <td class="text-right">
                                        ${{ number_format($bill->amount, 2) }}
                                    </td>
                                    <td>
                                        <div class="hidden-xs">
                                            <a href="{{ URL::route('bill.edit', $bill->id) }}" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</a>
                                            <a href="{{ URL::route('bill.pay', $bill->id) }}" class="btn btn-success"><i class="fa fa-check"></i> Pay</a>
                                        </div>
                                        <div class="visible-xs">
                                            <a href="{{ URL::route('bill.edit', $bill->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ URL::route('bill.pay', $bill->id) }}" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-right">
                                    Total Amount
                                </td>
                                <td class="text-right text-success">
                                    $ <strong>{{ number_format($totalPayableBills, 2, '.', ',') }}</strong>
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
    </div>

@stop
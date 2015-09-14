@extends('layouts.master')

@section('javascript')
@stop

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="page-header">
                <h3>
                    Companies <small>a listing of all the companies that you have added</small>
                </h3>
            </div>

            @include('layouts.partials.messages')

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="pull-right">
                        @if(Auth::user()->canCreateCompany())
                            <a href="{{ URL::route('company.add') }}" class="btn btn-primary" onclick="switchElement(this, 'ajax-loading');"><i class="fa fa-plus"></i> Add New Company</a>
                        @else
                            <a href="{{ URL::route('subscription.subscribe') }}" class="btn btn-primary"><i class="fa fa-credit-card"></i> Subscribe</a>
                        @endif

                        <div id="ajax-loading" class="ajax-wait">
                            <img src="{{ asset('assets/images/spinner.gif') }}"> Please Wait ...
                        </div>
                    </div>
                    <h4>
                        Company Listing
                    </h4>
                </div>
                <table class="table table-hover table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th width="40%">
                                Name
                            </th>
                            <th width="10%">
                                Current
                            </th>
                            <th width="10%">
                                Last Paid
                            </th>
                            <th width="10%">
                                Total Bills
                            </th>
                            <th width="10%">
                                Total Amount
                            </th>
                            <th width="30%">
                                Actions
                            </th>
                        </tr>
                    </tbody>
                    <tbody>
                        @foreach(Auth::user()->companies()->where('active', true)->get() as $company)
                            <tr>
                                <td>
                                    <a href="{{ URL::route('company.view', $company['id']) }}">{{ $company['name'] }}</a>
                                </td>
                                <td class="text-right">
                                    {{ number_format($company->bills()->where('active', true)->where('paid', false)->count(), 0) }}
                                    (${{ number_format($company->bills()->where('active', true)->where('paid', false)->sum('amount'), 2) }})
                                </td>
                                <td class="text-right">
                                    @if($company->bills()->where('active', true)->where('paid', true)->count() > 0)
                                        {{ $company->bills()->where('active', true)->where('paid', true)->get()->last()->paid_date->format('F d, Y') }}
                                    @endif
                                </td>
                                <td class="text-right">
                                    {{ number_format($company->bills()->where('active', true)->count(), 0) }}
                                </td>
                                <td class="text-right">
                                    ${{ number_format($company->bills()->where('active', true)->sum('amount'), 2) }}
                                </td>
                                <td>
                                    <div class="hidden-xs">
                                        <a href="{{ URL::route('bill.add', $company['id']) }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add</a>
                                        <a href="{{ URL::route('company.edit', $company['id']) }}" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
                                    </div>
                                    <div class="visible-xs">
                                        <a href="{{ URL::route('bill.add', $company['id']) }}" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                                        <a href="{{ URL::route('company.edit', $company['id']) }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
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
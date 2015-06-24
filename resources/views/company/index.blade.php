@extends('layouts.master')

@section('javascript')
@stop

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="page-header">
                <h1>
                    Companies <small>a listing of all the companies that you have added</small>
                </h1>
            </div>

            @include('layouts.partials.messages')

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="btn-group pull-right">
                        <a href="{{ URL::route('company.add') }}" class="btn btn-success" onclick="switchElement(this, 'ajax-loading');"><i class="fa fa-plus"></i> Add New Company</a>
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
                            <th width="50%">
                                Name
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
                                    {{ number_format($company->bills()->where('active', true)->count(), 0) }}
                                </td>
                                <td class="text-right">
                                    ${{ number_format($company->bills()->where('active', true)->sum('amount'), 2) }}
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm btn-group-justified">
                                        <a href="{{ URL::route('bill.add', $company['id']) }}" class="btn btn-sunny"><i class="fa fa-plus"></i> Add Bill</a>
                                        <a href="{{ URL::route('company.delete', $company['id']) }}" class="btn btn-hot"><i class="fa fa-trash-o"></i> Delete</a>
                                        <a href="{{ URL::route('company.edit', $company['id']) }}" class="btn btn-fresh"><i class="fa fa-edit"></i> Edit</a>
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
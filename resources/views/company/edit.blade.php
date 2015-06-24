@extends('layouts.master')

@section('javascript')
    <script>
        $(function(){
            $("#company_name").focus();
        });

        function deleteCompany(id) {
            swal({
                    title: "Are you sure?",
                    text: "Are your sure you want to delete this company?",
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
                        swal("Deleting", "Please wait while your company is deleted", "success");
                        window.location.href = $("#company-delete-" + id).val();
                    }
                }
            );
        }
    </script>
@stop

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8">

            <div class="page-header">
                <h1>
                    Edit Company <small>edit the information about a company</small>
                </h1>
            </div>

            {!! Form::open(['route' => 'company.update', 'autocomplete' => 'off']) !!}
                <input type="hidden" name="id" value="{{ $company['id'] }}">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Edit Company
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="company_name">Company Name</label>
                            <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Example Co" value="{{ old('company_name', $company['name']) }}">
                        </div>
                        <div class="form-group">
                            <label for="account_number">Account Number</label>
                            <input type="text" class="form-control" id="account_number" name="account_number" placeholder="1234-56748-94241" value="{{ old('account_number', $company['account_number']) }}">
                        </div>
                    </div>
                    <div class="panel-footer">
                        <input type="submit" class="btn btn-fresh text-uppercase" value="Save Company" onclick="switchElement(this, 'ajax-loading');">
                        <a href="{{ URL::route('company') }}" class="btn btn-hot" onclick="switchElement(this, 'ajax-loading');">Cancel</a>

                        <div class="pull-right">
                        <a href="{{ URL::route('company.delete', $company['id']) }}" class="btn btn-sky" onclick="deleteCompany('{{ $company['id'] }}'); return false;"><i class="fa fa-trash-o"></i> Delete Company</a>
                        <input type="hidden" id="company-delete-{{ $company['id']}}" value="{{ URL::route('company.delete', $company['id']) }}">
                    </div>
                        <div id="ajax-loading" class="ajax-wait">
                            <img src="{{ asset('assets/images/spinner.gif') }}"> Please Wait ...
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}

            @include('layouts.partials.messages')

        </div>
        <div class="col-md-4">
            <p>
                put something nice in here to help the user
            </p>
        </div>
    </div>
</div>

@stop
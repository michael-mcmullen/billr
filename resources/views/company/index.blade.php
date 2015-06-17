@extends('layouts.master')

@section('javascript')
@stop

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">

            @include('layouts.partials.messages')

            <table class="table table-hover table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            Name
                        </th>
                        <th>
                            Total Bills
                        </th>
                        <th>
                            Total Amount
                        </th>
                        <th>
                            Actions
                        </th>
                    </tr>
                </tbody>
                <tbody>
                    @foreach(Auth::user()->companies as $company)
                        <tr>
                            <td>
                                {{ $company['name'] }}
                            </td>
                            <td>
                                ?
                            </td>
                            <td>
                                ?
                            </td>
                            <td>
                                Action!
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

@stop
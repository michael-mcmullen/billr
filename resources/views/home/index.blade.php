@extends('layouts.master')

@section('javascript')
    <script>
        // test data for now
        var line_data = {
            labels: ["January 2015", "February 2015", "March 2015", "April 2015", "May 2015", "June 2015", "July 2015", "August 2015", "September 2015", "October 2015", "November 2015", "December 2015"],
            datasets: [
                {
                    label: "Spending",
                    fillColor: "#66c796",
                    strokeColor: "#fff",
                    data: [315.48, 107.13, 245.18, 648.51, 157.59, 159.57, 864.52, 486.54, 198.65, 485.65, 186.54, 868.15]
                }
            ]
        }


        // LINE CHART WIDGET
            var ctx2 = document.getElementById("myLineChart").getContext("2d");
        ctx2.canvas.height = 50;
            var myLineChart = new Chart(ctx2).Bar(line_data,
                    {
                        responsive:true,
                        scaleShowGridLines : true,
                        scaleGridLineColor : "#000",
                        scaleShowLabels: false,
                        showScale: false,
                        datasetStroke : false,
                        tooltipTemplate: "$<%= value %><%if (label){%> - <%=label%><%}%>"
                    });
    </script>
@stop

@section('content')

<div class="container">
  <div class="row">

    <div class="col-md-3">
      <div class="hero-widget well well-sm">
        <div class="icon">
          <i class="glyphicon glyphicon-exclamation-sign text-danger"></i>
        </div>
        <div class="text">
          <var><a href="#">{{ $unpaid['count'] }}</a></var>
          <label class="text-muted">unpaid bills (${{ number_format($unpaid['total'], 2) }})</label>
        </div>
        <div class="options">
          <a href="{{ URL::route('bill.add') }}" class="btn btn-default btn-lg"><i class="glyphicon glyphicon-plus"></i> Add Bill</a>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="hero-widget well well-sm">
        <div class="icon">
          <i class="glyphicon glyphicon-briefcase"></i>
        </div>
        <div class="text">
          <var><a href="{{ URL::route('company') }}">{{ Auth::user()->companies()->where('active', true)->count() }}</a></var>
          <label class="text-muted">companies</label>
        </div>
        <div class="options">
          <a href="{{ URL::route('company.add') }}" class="btn btn-default btn-lg"><i class="glyphicon glyphicon-plus"></i> Add Company</a>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="hero-widget well well-sm">
        <div class="icon">
          <i class="glyphicon glyphicon-briefcase"></i>
        </div>
        <div class="text">
          <var>${{ number_format($thisMonth['total'], 2) }}</var>
          <label class="text-muted">spent this month</label>
        </div>
        <div class="options">
          <a href="javascript:;" class="btn btn-default btn-lg"><i class="glyphicon glyphicon-search"></i> View</a>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="hero-widget well well-sm">
        <div class="icon">
          <i class="glyphicon glyphicon-briefcase"></i>
        </div>
        <div class="text">
          <var>$0.xx</var>
          <label class="text-muted">spent last month</label>
        </div>
        <div class="options">
          <a href="javascript:;" class="btn btn-default btn-lg"><i class="glyphicon glyphicon-search"></i> View</a>
        </div>
      </div>
    </div>

  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div id="line-chart-widget" class="panel">
        <div class="panel-heading">
          <h4 class="text-uppercase"><strong>Spending Overview (Monthly)</strong></h4>
        </div>
        <div class="panel-body">
          <canvas id="myLineChart"></canvas>
        </div>

      </div>
    </div>
  </div>
</div>


<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="well well-sm">
        <div class="row">
          <div class="col-sm-3 text-center">
            <div class="date">
              <div class="month">June</div>
              <div class="day">16, 2015</div>
            </div>
          </div>
          <div class="col-sm-9 bill-content">
            <p class="company">
              My Not So Awesome Company
            </p>
            <p class="amount">
              Transaction: $<span class="dollar">1,453.24</span>
            </p>
            <p class="account">
              Account: 1548-98745-35-4824
            </p>
          </div>
          <div class="col-sm-12">
            <a href="#" class="btn btn-fresh text-uppercase btn-block"><span class="fa fa-check"></span> Mark this bill as paid</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@stop
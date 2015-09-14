@extends('layouts.master')

@section('page-title')
    Create new Acccount
@stop

@section('javascript')
    <script src="https://js.stripe.com/v2/"></script>

    <script>
        $(function(){
            var StripeBilling = {
                init: function(){
                    this.form = $("#payment-form");
                    this.submitButton = this.form.find('input[type=submit]');
                    this.submitButtonValue = this.submitButton.val();
                    var stripeKey = $('meta[name="stripe-key"]').attr('content');
                    Stripe.setPublishableKey(stripeKey);
                    this.bindEvents();
                },
                bindEvents: function(){
                    this.form.on('submit', $.proxy(this.sendToken, this));
                },
                sendToken: function(event){
                    this.submitButton.val('One Moment ...').prop('disabled', true);
                    Stripe.createToken(this.form, $.proxy(this.stripeResponsehandler, this));
                    event.preventDefault();
                },
                stripeResponsehandler: function(status, response){
                    if(response.error)
                    {
                        $("#creditcard-error").removeClass("ajax-hidden");
                        $("#creditcard-error").html(response.error.message)
                        //alert(response.error.message);
                        return this.submitButton.val(this.submitButtonValue).prop('disabled', false);
                    }
                    $('<input>', {
                        type: 'hidden',
                        name: 'stripe-token',
                        value: response.id
                    }).appendTo(this.form);
                    this.form[0].submit();
                }
            };

            StripeBilling.init();
        });
    </script>
@stop

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">
                    Create a MyBillr Account
                </h1>
            </div>
        </div>

        <form id="payment-form" method="POST" action="{{ URL::route('subscription.create') }}" autocomplete="off">
            {!! csrf_field() !!}

            @if($errors)
                @if($errors->count() > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong>
                        <ul>
                            @foreach($errors->all() as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            @endif

            <div class="row">
                <div class="col-md-6">
                    <h3 class="page-header">
                        Account Information
                    </h3>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="confirm">Confirm Password</label>
                        <input type="password" id="confirm" name="password_confirmation" class="form-control">
                    </div>
                </div> <!-- col-md-6 -->
                <div class="col-md-6">
                    <h3 class="page-header">
                        Credit Card Information
                    </h3>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="ajax-hidden" id="creditcard-error">
                                <p class="creditcard-error"></p>
                            </div>
                        </div>
                    </div>

                    <div class="creditcard">

                        <div class="form-group">
                            <label for="cardNumber">CARD NUMBER</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="cardNumber" placeholder="Valid Card Number" required autofocus data-stripe="number" maxlength="16" />
                                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                            </div>
                        </div> <!-- form-group -->

                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <label for="expMonth">EXPIRATION DATE</label>
                                <div class="form-group">
                                    <div class="col-xs-6 col-lg-6">
                                        <input type="text" class="form-control" id="expMonth" placeholder="MM" required data-stripe="exp_month" />
                                    </div>
                                    <div class="col-xs-6 col-lg-6">
                                        <input type="text" class="form-control" id="expYear" placeholder="YY" required data-stripe="exp_year" />
                                    </div>
                                </div>
                            </div> <!-- col-xs-12 col-md-12 -->
                        </div> <!-- row -->

                        <div class="form-group">
                            <label for="cvCode">CV CODE</label>
                            <input type="password" class="form-control" id="cvCode" placeholder="CV" required data-stripe="cvc" />
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success btn-block">Subscribe</button>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{ URL::to('/auth/login') }}" class="btn btn-link">I already have an account</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div> <!-- row -->

        </form>

    </div>

@stop
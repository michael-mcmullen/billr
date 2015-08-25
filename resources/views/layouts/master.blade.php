<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>
            MyBillr
        </title>


        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <link rel="stylesheet" href="{{ asset('theme/bootflat/css/bootflat.min.css') }}">

        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/css/bootstrap-datepicker.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/sweetalert/1.0.1/sweetalert.min.css">
        <link rel="stylesheet" href="{{ asset('assets/css/theme.css') }}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <div id="wrapper">
            @include('layouts.partials.navigation.top')

            @yield('content')

        </div>

        <div class="footer">
            <div class="container">
                <div class="clearfix">
                    <div class="footer-logo"><a href="{{ URL::route('home') }}">MyBillr</a></div>
                        <dl class="footer-nav visible-md visible-lg">
                            <dt class="nav-title">Links</dt>
                            <dd class="nav-item"><a href="{{ URL::route('home') }}">Home</a></dd>
                            <dd class="nav-item"><a href="{{ URL::route('bill') }}">Bills</a></dd>
                            <dd class="nav-item"><a href="{{ URL::route('company') }}">Companies</a></dd>
                        </dl>
                        <dl class="footer-nav">
                            <dt class="nav-title">Support</dt>
                            <dd class="nav-item"><a href="mailto:support@mybillr.com">support@mybillr.com</a></dd>
                        </dl>
                    </div>

                    <div class="footer-copyright text-center">Copyright &copy; 2015 <a href="http://www.tutelagesystems.com">Tutelage Systems</a></div>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="//www.chartjs.org/assets/Chart.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/js/bootstrap-datepicker.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/sweetalert/1.0.1/sweetalert.min.js"></script>
        <script src="{{ asset('assets/js/ajax.js') }}"></script>

        <script src="{{ asset('theme/bootflat/js/icheck.min.js') }}"></script>
        <script src="{{ asset('theme/bootflat/js/jquery.fs.selecter.min.js') }}"></script>
        <script src="{{ asset('theme/bootflat/js/jquery.fs.stepper.min.js') }}"></script>

        <script>
            $(function(){
                $(".alert").each(function(idx, element){
                    if(! $(this).hasClass('alert-no-close')) {
                        $(this).delay(5000).slideUp('slow');
                    }
                });

                $(".select").select2();
            });
        </script>

        @yield('javascript')

    </body>
</html>
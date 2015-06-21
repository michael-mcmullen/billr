<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>
            Billr - @yield('page-title')
        </title>

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="//fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
        <link href="{{ asset('assets/css/theme.css') }}" rel="stylesheet">
    </head>
    <body>

        <div id="wrapper">

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header">
                            <h1>
                                Billr - Bill Management Software
                            </h1>
                        </div>
                    </div>
                </div>
            </div>

            @yield('content')
        </div>

        <!-- jQuery -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

        @yield('scripts')

    </body>
</html>
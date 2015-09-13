<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>
            MyBillr
        </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <!-- Overwrite anything that is done in bootstrap -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
    <body>

        <header>
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse-nav" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="#featured" class="navbar-brand"><h1>MyBillr <span class="subhead">Bill Reminders</span></h1></a>
                    </div> <!-- navbar-header -->
                    <div class="collapse navbar-collapse" id="collapse-nav">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="active">
                                <a href="#carousel-featured">Home</a>
                            </li>
                            <li>
                                <a href="#features">Features</a>
                            </li>
                            <li>
                                <a href="#pricing">Pricing</a>
                            </li>
                            <li>
                                <a href="#tour">Tour</a>
                            </li>
                            <li class="login-button">
                                <a href="https://app.mybillr.com/auth/login">Login</a>
                            </li>
                        </ul>
                    </div> <!-- collapse-nav -->
                </div> <!-- container -->
            </nav>

            @yield('carousel')
        </header>

        <div class="main">
            @yield('content')
        </div>

        <footer>
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        Copyright &copy; 2015 <a href="http://www.tutelagesystems.com">Tutelage Systems</a>
                    </div> <!-- col-sm-12 -->
                </div> <!-- row -->
            </div>
        </footer>


        <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="{{ asset('scripts/myscript.js') }}"></script>

    </body>
</html>
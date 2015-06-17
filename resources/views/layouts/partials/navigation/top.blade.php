<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ URL::route('home') }}"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
      <ul class="nav navbar-nav">
        <li><a href="{{ URL::route('home') }}">Home</a></li>
        <li class="dropdown">
            <a href="{{ URL::route('bill') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Bills <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="{{ URL::route('company.add') }}"><i class="fa fa-plus"></i> Add</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="{{ URL::route('company') }}"><i class="fa fa-briefcase"></i> Listing</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="{{ URL::route('company') }}"><i class="fa fa-exclamation-circle text-danger"></i> Unpaid</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="{{ URL::route('company') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Companies <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="{{ URL::route('company.add') }}"><i class="fa fa-plus"></i> Add</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="{{ URL::route('company') }}"><i class="fa fa-briefcase"></i> Listing</a></li>
            </ul>
        </li>
        <li><a href="#">Reports</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><i class="fa fa-warning"></i> 0 Notifications</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account <span class="caret"></span></a>

          <ul class="dropdown-menu" role="menu">
            <li><a href="{{ URL::to('auth/login') }}"><i class="fa fa-user"></i> Profile</a></li>
            <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
            <li class="divider"></li>
            <li><a href="{{ URL::to('auth/logout') }}"><i class="fa fa-unlock"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
</nav>
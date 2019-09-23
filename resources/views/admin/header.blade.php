
<header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>ACC</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>ACC.One</b>CMS</span>
    </a>
        <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs">{{$session[0]['Name']}}</span>
            </a>
            <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                <i class="fa fa-user-circle fa-5x" style="margin-top:10%; color:white;"></i>
                <p>
                    {{$session[0]['LoginSession']}}
                    <small>{{$session[0]['Email']}}</small>
                </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                <div style="text-align:center;">
                    <a href="{{ asset('logout') }}" class="btn btn-danger btn-flat">Sign out</a>
                </div>
                </li>
            </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
        </ul>
        </div>
    </nav>
</header>
    
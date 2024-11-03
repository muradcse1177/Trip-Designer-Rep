<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-landmark"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <div class="media">
                        <div class="media-body">
                            <b><p class="text-sm text-muted"><i class="far fa-money-bill-alt mr-1"></i>Balance: {{ number_format((float)(@$agent_info->agency_amount), 2, '.', '')}} BDT</p></b>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <div class="media">
                        <div class="media-body">
                            <p class="text-sm text-muted"><i class="far fa-money-bill-alt mr-1"></i>Authorised: {{ number_format((float)(@$agent_info->auth_amount), 2, '.', '')}} BDT</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
            </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-divider"></div>
                <a href="{{url('companyInfo')}}" class="dropdown-item">
                    <i class="fas fa-user-circle mr-2"></i>Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{url('logout')}}" class="dropdown-item">
                    <i class="fas fa-power-off mr-2"></i>Logout
                </a>
            </div>
        </li>
    </ul>
</nav>

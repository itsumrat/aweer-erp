<div class="dashboard-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="header-right">
                            <a href="#">
                                <i class="fas fa-bell" aria-hidden="true"></i><span class="badge badge-danger">01</span>
                            </a>
                            <div class="navbar-profile">
                                <div class="dropdown">
                                    <img class="avatar" src='{{ asset("public/assets/img/logo-alt.png") }}' alt="logo">
                                    <div class="dropdown-content">
                                        <ul>
                                            <li><a href="profile.php"><i class="fas fa-cogs"></i> Profile</a></li>
                                            <li>
                                        <a  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
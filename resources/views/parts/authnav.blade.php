<header class="d-flex align-items-center pl-5 pr-5 pt-3" id="myHeader">
    <div>
        <a href="#" id="sidebarCollapse" class="mr-3 sidebarTogglerButton">
            <img src="{{asset('vendor/crudgen/images/menu.svg')}}" alt="menu" height="20">
        </a>
    </div>
    <div class="ml-auto">
        <ul class="navbar-nav">
            <li class="nav-item dropdown no-arrow show">
                <a class="nav-link" href="#" id="userDropdown" role="button" data-toggle="dropdown">
                    <img width="40" height="40" class="img rounded-circle" src="{{auth()->user()->avatar ? asset('images/'.auth()->user()->avatar) : asset('vendor/crudgen/images/avatar.png')}}">
                </a>
                <!-- Dropdown - User Information -->
                @if(config('crud.mode') == 'mpa')
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ route('profile') }}">
                            <i class="fa fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        {{--<a class="dropdown-item" href="#">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Settings
                        </a>--}}
                        <a class="dropdown-item" href="{{ route('password') }}">
                            <i class="fa fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                            Ubah Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item btn-logout" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                @endif
            </li>
        </ul>
    </div>
</header>

<aside>
    <nav id="sidebar" class="shadow bg-sidebar">
        <div class="d-lg-flex align-items-center justify-content-center">
            <h4 class="text-logo text-center p-4">{{config('app.name')}}</h4>
        </div>
        <ul class="list-unstyled components mb-5">
            <li class="{{ (request()->is('home*')) ? 'active' : '' }}">
                <a href="{{route('home')}}">Home</a>
            </li>

            @if(auth()->user()->role=='super-admin')
                <li>
                    <a href="#system" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">System</a>
                    <ul class="collapse list-unstyled" id="system">
                        <li class="{{ (request()->is('usermanagement*')) ? 'active' : '' }}">
                            <a href="{{route('usermanagement.index')}}">User Management</a>
                        </li>
                        <li class="{{ (request()->is('myprofile*')) ? 'active' : '' }}">
                            <a href="{{route('profile')}}">Profile</a>
                        </li>
                        <li class="{{ (request()->is('password*')) ? 'active' : '' }}">
                            <a href="{{route('password')}}">Ubah Password</a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>

        <div class="sidebar-footer d-flex align-items-center justify-content-center">
            <button class="btn btn-logout btn-primary p-3" id="btn-logout">
                <span class="fa fa-lock"></span> Logout
            </button>
        </div>
    </nav>
</aside>

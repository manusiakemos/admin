<aside>
    <nav id="sidebar" class="shadow bg-sidebar">
        <div class="d-flex align-items-center justify-content-center">
            <h4 class="text-logo text-center p-4">{{config('app.name')}}</h4>
        </div>
        <div class="d-flex align-items-center justify-content-center mb-4">
            <img src="{{ asset('vendor/crudgen/images/avatar.png') }}" alt="avatar" class="rounded-circle" width="50"
                 height="50">
        </div>

        <div class="justify-content-center pb-5">
            <h6 class="text-center">{{auth()->user()->name}}</h6>
        </div>

        <ul id="toc" class="list-unstyled">
            <li class="{{ request()->is('home*') ? 'mm-active active' : '' }}">
                <a href="{{route('home')}}"><span class="fa fa-line-chart"></span> <span class="ml-1">Dashboard</span></a>
            </li>
            <li class="{{session('menu_type') == 'master' ? 'mm-active' : ''}}">
                <a href="#" class="has-arrow" aria-expanded="{{session('menu_type') == 'referensi' ? 'true' : 'false'}}">
                    <span class="fa fa-book"></span> <span class="ml-1">System</span>
                </a>
                <ul class="list-unstyled">
                    <li></li>

                    <li class="{{ (request()->is('usermanagement*')) ? 'mm-active active' : '' }}">
                        <a href="{{route('usermanagement.index')}}">
                            User Management
                        </a>
                    </li>

                </ul>
            </li>
        </ul>

        <div class="sidebar-footer d-flex align-items-center justify-content-center">
            <button class="btn btn-logout btn-primary p-3" id="btn-logout">
                <span class="fa fa-lock"></span> <span class="text-dark">Logout</span>
            </button>
        </div>
    </nav>
</aside>

@push("script")
    <script>
       $(document).ready(function (){
           $("#toc").metisMenu();
       });
    </script>
@endpush

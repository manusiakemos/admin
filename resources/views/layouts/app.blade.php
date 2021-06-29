<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/crudgen/libs/alertifyjs/css/alertify.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('vendor/crudgen/libs/alertifyjs/css/themes/default.min.css') }}"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/metismenu/dist/metisMenu.min.css">
    <link href="{{ asset('vendor/crudgen/css/app.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.14/vue.min.js"></script>
    <script src="https://unpkg.com/metismenu"></script>
    <!-- Scripts -->
    @stack("style")
</head>
<body>
@auth
    <a href="#" id="mobileMenuCloser" class="sidebarTogglerButton d-none" style="position: absolute; right:30px; top: 30px">
        <img src="{{asset('vendor/crudgen/images/cross.svg')}}" alt="menu" height="20">
    </a>
    <div class="wrapper d-flex">
       @if(config('crud.mode') == 'mpa')
            @include("vendor.admin.parts.sidebar")
        @endif
        <div class="main-wrapper">
            @if(config('crud.mode') == 'mpa')
                @include("vendor.admin.parts.authnav")
            @endif
            <main class="py-3">
                @yield('content')
            </main>
        </div>
    </div>
@else
    <main>
        @yield('content')
    </main>
@endauth

<script src="{{ asset('vendor/crudgen/libs/alertifyjs/alertify.min.js') }}"></script>

@auth
    <script>
        $(document).ajaxComplete(function (event, jqxhr, settings) {
            $.LoadingOverlay("hide");
        });
    </script>

    <form action="{{route('logout')}}" method="POST" id="formLogout">
        @csrf
    </form>
@endauth

@if(auth()->check())
    <script>
        window.axiosInstance = axios.create({
            baseURL: '{{url('/')}}',
            timeout: 1000,
            headers: {'Authorization': 'Bearer {{ auth()->user()->api_token }}'}
        });
    </script>
@endif

@stack("script")

@auth
    <script>
        var fullHeight = function () {
            $('.js-fullheight').css('height', $(window).height());
            $(window).resize(function () {
                $('.js-fullheight').css('height', $(window).height());
            });
        };

        fullHeight();

        $('.sidebarTogglerButton').on('click', function () {
            $('#sidebar').toggleClass('active');
            $("#mobileMenuCloser").toggleClass('d-block d-sm-none');
            $(".main-wrapper").toggleClass('zindex');
        });

        $(".btn-logout").on("click", function () {
            $("#formLogout").submit();
        })
    </script>
@endauth
</body>
</html>

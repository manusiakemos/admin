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
    <link rel="stylesheet" href="{{ asset('vendor/crudgen/alertifyjs/css/themes/default.min.css') }}"/>
    <link href="{{ asset('vendor/crudgen/css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('vendor/crudgen/js/app.js') }}"></script>
    @stack("style")
</head>
<body>
@auth
    <a href="#" id="mobileMenuCloser" class="sidebarTogglerButton d-none" style="position: absolute; right:30px; top: 30px">
        <img src="{{asset('images/cross.svg')}}" alt="menu" height="20">
    </a>
    <div class="wrapper d-flex">
       @if(config('crud.mode') == 'mpa')
            @include("parts.sidebar")
        @endif
        <div class="main-wrapper">
            @if(config('crud.mode') == 'mpa')
                @include("parts.authnav")
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

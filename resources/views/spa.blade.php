<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css"
          integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw=="
          crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('libs/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/spa.css')}}">
</head>
<body>
<div id="spa">
    <router-view></router-view>
</div>
@if(config('app.env') == 'local')
    <script src="{{ mix('js/spa.js') }}"></script>
@else
    <script src="{{ asset('js/spa.js') }}"></script>
@endif
</body>
</html>

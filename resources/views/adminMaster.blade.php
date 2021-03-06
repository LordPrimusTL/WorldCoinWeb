<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{$title}} | World Coin</title>
    <!-- custom-theme -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="world coin" />

    <link rel="stylesheet" href="{{asset('css/admin/bootstrap.min.css')}}">
    <link href="{{asset('css/font-awesome.css')}}" rel="stylesheet">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{asset('css/admin/style.default.css')}}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{asset('css/admin/custom.css')}}">
    <script src="{{asset('js/admin/jquery-1.11.1.min.js')}}"></script>
</head>
<body>
    <div class="page charts-page">
        @include('Partials._adminNavbar')
        <div class="page-content d-flex align-items-stretch">
            @include('Partials._adminSideBar')
            @yield('body')
        </div>
    </div>
</body>
</html>




<!DOCTYPE html>
<html lang="pt">
<head>
    @include('layouts.head_meta')
    <!-- vendor css -->
    <link href="{{asset('lib/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('lib/typicons.font/typicons.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('extra/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('extra/css/jquery.multiselect.css') }}">
    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('extra/css/style.css') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('extra/css/bootstrap.min.css') }}">
    <!-- azia CSS -->
    <link rel="stylesheet" href="{{asset('css/azia.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>

<div class="az-header">
    <div class="container">
        <!--header-left -->
    @include('layouts.header_menu_left')
    <!--header-left -->
        <!--header-menu -->
    @include('layouts.header_menu')
    <!--header-menu -->
        <!--header-right -->
    @include('layouts.header_menu_right')
    <!--header-right -->
    </div><!-- container -->
</div><!--header -->

<div class="az-content az-content-dashboard">
    <div class="container">
        @yield('conteudo')
    </div>

</div><!--content -->

<script src="{{ asset('extra/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('extra/js/popper.min.js') }}"></script>
<script src="{{ asset('lib/chart.js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('extra/js/jquery.multiselect.js') }}"></script>
<script src="{{ asset('extra/js/main.js') }}"></script>
<script src="{{ asset('extra/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/azia.js')}}"></script>
</body>

</html>

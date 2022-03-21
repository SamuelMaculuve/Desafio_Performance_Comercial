<!DOCTYPE html>
<html lang="pt">
<head>
    @include('layouts.head_meta')
    <!-- vendor css -->
    <link href="{{asset('lib/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('lib/typicons.font/typicons.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/azia.css')}}">

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

<script src="{{ asset('lib/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('lib/ionicons/ionicons.js')}}"></script>
<script src="{{ asset('js/azia.js')}}"></script>
</body>

</html>

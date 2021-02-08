<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/logo.png') }}">

    {{-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries --}}
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @hasrole("Admin")
        @yield('linked_fonts')
        @include('partials.admin.stylesheet')
        @yield('linked_css')
    @else
        @yield('linked_fonts')
        @include('partials.user.stylesheet')
        @yield('linked_css')
    @endrole
</head>
<body class="skin-blue fixed-layout">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">{{ config('app.name', 'Laravel') }}</p>
        </div>
    </div>

    @hasrole("Admin")
        <div id="main-wrapper">
            @include('partials.admin.topbar')
            @include('partials.admin.menubar')
            <div class="page-wrapper">
                <div class="container-fluid">
                    @yield('content')
                    @include('partials.admin.r-sidebar')
                </div>
            </div>
            @include('partials.admin.footerbar')
        </div>
        @include('partials.admin.javascript')
    @else
        <div id="main-wrapper">
            @include('partials.user.topbar')
            @include('partials.user.menubar')
            <div class="page-wrapper">
                <div class="container-fluid">
                    @yield('content')
                    @include('partials.user.r-sidebar')
                </div>
            </div>
            @include('partials.user.footerbar')
        </div>
        @include('partials.user.javascript')
    @endrole
</body>

</html>

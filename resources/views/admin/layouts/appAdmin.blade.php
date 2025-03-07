
<!doctype html>
<html lang="tr_TR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <link rel="icon" href="{{ asset('panel/assets/images/favicon.ico') }}" type="image/x-icon">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('panel/assets/images/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('panel/assets/images/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('panel/assets/images/favicon-32x32.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('panel/assets/images/apple-touch-icon.png') }}">
    <link rel="stylesheet" href="{{ asset('panel/assets/css/style.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('styles')
</head>
<body data-bvite="theme-CeruleanBlue" class="layout-border svgstroke-a layout-default @yield('right')">
<main class="container-fluid px-0">
    <div class="px-md-4 px-2 pt-2 pb-2 brand" data-bs-theme="none">
        <div>
            <div class="d-flex align-items-center pt-1" style="justify-self: center;">
                <button class="btn d-inline-flex d-xl-none border-0 p-0 pe-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_Navbar">
                    <svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M4 6l16 0"></path>
                        <path d="M4 12l16 0"></path>
                        <path d="M4 18l16 0"></path>
                    </svg>
                </button>
                <a href="" class="brand-icon text-decoration-none d-flex align-items-center" title="">
                    <img src="{{ asset('panel/assets/DBB-logo.png') }}" alt="">
                </a>
            </div>
        </div>
    </div>
    <!-- start: page header -->
    @include('admin.layouts.header')
    <!-- start: page menu link -->
    @include('admin.layouts.asideLeft')
    <!-- start: page icon link -->
    @include('admin.layouts.asideRight')
    <!-- start: page header area -->

    <!-- start: page body area -->
    @yield('content')
    @include('admin.layouts.footer')
</main>
<script src="{{ asset('panel/assets/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('panel/assets/js/main.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.all.min.js"></script>
<script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
@stack('scripts')
</body>
</html>

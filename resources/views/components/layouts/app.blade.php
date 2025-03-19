<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="" />
    <meta name="author" content="Gis Soft Technology" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Visit Denizli</title>
    <link rel="shortcut icon" href="{{ asset('front/assets/images/favicon.ico') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="{{ asset('front/assets/css/font-awesome/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/flaticon/flaticon.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/bootstrap/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/owl-carousel/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/magnific-popup/magnific-popup.css') }}" />
    @stack('styles')
    <link rel="stylesheet" href="{{ asset('front/assets/css/style.css') }}" />
    @livewireStyles
</head>

<body>

<!--=================================
header -->
@livewire('partials.header')
<!--=================================
 header -->

{{ $slot }}

<!--=================================
footer-->
@livewire('partials.footer')
<div id="back-to-top" class="back-to-top">
    <a href="#"> <i class="fas fa-angle-up"></i></a>
</div>
<script src="{{ asset('front/assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('front/assets/js/popper/popper.min.js') }}"></script>
<script src="{{ asset('front/assets/js/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('front/assets/js/owl-carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('front/assets/js/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
@stack('scripts')
<script src="{{ asset('front/assets/js/custom.js') }}"></script>
@livewireScripts
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="{{ $seoKeywords ?? 'Denizli travel, Denizli tourism, visit Denizli, Denizli attractions' }}">
    <meta name="description" content="{{ $seoDescription ?? 'Discover the best attractions in Denizli, Turkey. Plan your trip with our comprehensive guide to Denizli tourism.' }}">
    <meta name="author" content="Gis Soft Technology">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $seoTitle ?? 'Visit Denizli - Your Guide to Denizli Tourism' }}</title>
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $seoTitle ?? 'Visit Denizli - Your Guide to Denizli Tourism' }}">
    <meta property="og:description" content="{{ $seoDescription ?? 'Discover the best attractions in Denizli, Turkey' }}">
    <meta property="og:image" content="{{ $seoImage ?? asset('front/assets/images/denizli-social-preview.jpg') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $seoTitle ?? 'Visit Denizli - Your Guide to Denizli Tourism' }}">
    <meta property="twitter:description" content="{{ $seoDescription ?? 'Discover the best attractions in Denizli, Turkey' }}">
    <meta property="twitter:image" content="{{ $seoImage ?? asset('front/assets/images/denizli-social-preview.jpg') }}">
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
@livewire('partials.header')

{{ $slot }}

@livewire('partials.footer')

<div id="back-to-top" class="back-to-top">
    <a href="#"><i class="fas fa-angle-up"></i></a>
</div>

<script src="{{ asset('front/assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('front/assets/js/popper/popper.min.js') }}"></script>
<script src="{{ asset('front/assets/js/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('front/assets/js/owl-carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('front/assets/js/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
@stack('scripts')
<script src="{{ asset('front/assets/js/custom.js') }}"></script>
@livewireScripts
<script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "Visit Denizli",
      "url": "{{ url('/') }}",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "{{ url('/search') }}?q={search_term_string}",
    "query-input": "required name=search_term_string"
  }
}
</script>
</body>
</html>

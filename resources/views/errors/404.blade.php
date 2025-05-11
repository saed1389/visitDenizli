<x-layouts.app>
    <section class="page-title bg-holder bg-overlay-black-50" style="background: url({{ asset('front/assets/images/bg/hata.jpg') }});">
        <div class="container">
            <div class="row justify-content-center position-relative">
                <div class="col-lg-6 text-center">
                    <h1 class="text-white">{{ __('pages.Error') }} 404</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">{{ __('header.home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('pages.Error') }} 404</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="space-ptb pt-11">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 mb-lg-0 mb-5">
                    <img class="img-fluid" src="{{ asset('front/assets/images/error-404/01.svg') }}" alt="">
                </div>
                <div class="col-lg-6 col-md-6 mt-4 mt-sm-0 text-center">
                    <div id="notfound">
                        <div class="notfound">
                            <img class="img-fluid" src="{{ asset('front/assets/images/error-404/404.svg') }}" alt="">
                            <div class="notfound-404 mt-4">
                                <h2>{{ __('pages.Oops - no one seems to be home.') }}</h2>
                            </div>
                            <p class="mt-3 mb-4">{{ __('pages.The page you are looking for might have been removed had its name changed or is temporarily unavailable.') }}</p>
                            <a class="btn btn-primary" href="/">{{ __('header.home') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>

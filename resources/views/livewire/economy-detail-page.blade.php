<div>
    <section class="page-title bg-holder bg-overlay-black-50" style="background: url({{ asset($place->banner_image) }});">
        <div class="container">
            <div class="row justify-content-center position-relative">
                <div class="col-lg-6 text-center">
                    <h1 class="text-white">{{ $place->name_en ? app()->getLocale() == 'tr' ? $place->name : $place->name_en : $place->name }}</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">{{ __('header.home') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ $menu }}">@if($type == 'industries') {{ __('pages.Local Economy and Industries') }} @elseif($type == 'investment') {{ __('pages.Investment Opportunities') }} @endif</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $place->name_en ? app()->getLocale() == 'tr' ? $place->name : $place->name_en : $place->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="space-ptb">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="blog-sidebar sidebar">
                        <div class="widget">
                            <div class="widget-title bg-primary">
                                <h6 class="mb-0 text-white"><i class="fa fa-share-alt"></i> {{ __('pages.Subscribe & Follow') }}</h6>
                            </div>
                            <div class="widget-content">
                                <div class="social">
                                    <ul class="list-unstyled">
                                        @if($setting->site_fb)
                                            <li class="facebook">
                                                <a href="{{ $setting->site_fb }}" target="_blank"> <i class="fab fa-facebook-f me-3"></i>Facebook</a>
                                                <a class="follow ms-auto" href="{{ $setting->site_fb }}" target="_blank">{{ __('pages.Like') }} </a>
                                            </li>
                                        @endif
                                        @if($setting->site_twitter)
                                            <li class="twitter">
                                                <a href="{{ $setting->site_twitter }}" target="_blank"> <i class="fab fa-twitter me-3"></i>twitter</a>
                                                <a class="follow ms-auto" href="{{ $setting->site_twitter }}">{{ __('pages.followers') }} </a>
                                            </li>
                                        @endif
                                        @if($setting->site_instagram)
                                            <li class="instagram">
                                                <a href="{{ $setting->site_instagram }}" target="_blank"> <i class="fab fa-instagram me-3"></i>instagram</a>
                                                <a class="follow ms-auto" href="{{ $setting->site_instagram }}" target="_blank">{{ __('pages.followers') }} </a>
                                            </li>
                                        @endif
                                        @if($setting->site_youtube)
                                            <li class="youtube">
                                                <a href="{{ $setting->site_youtube }}" target="_blank"> <i class="fab fa-youtube me-3"></i>youtube</a>
                                                <a class="follow ms-auto" href="{{ $setting->site_youtube }}" target="_blank">{{ __('pages.Subscribers') }} </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 mt-lg-0 mt-5">
                    <div class="blog-detail">
                        <div class="blog-post-02 mb-0">
                            <div class="blog-post-title mt-0">
                                <h2>{{ $place->name_en ? app()->getLocale() == 'tr' ? $place->name : $place->name_en : $place->name }}</h2>
                            </div>
                            <div class="blog-post-footer border-0 justify-content-start">
                                <div class="blog-post-time ms-0">
                                    <i class="far fa-clock"></i>{{ date('d/m/Y', strtotime($place->created_at)) }}
                                </div>
                            </div>
                            <div class="blog-post-image">
                                <img class="img-fluid mb-4" src="{{ asset($place->image) }}" alt="">
                            </div>
                            <div class="blog-post-content border-0">
                                <div class="blog-post-description">
                                    <p class="mb-0">{!! $place->description_en ? app()->getLocale() == 'tr' ? $place->description : $place->description_en : $place->description !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

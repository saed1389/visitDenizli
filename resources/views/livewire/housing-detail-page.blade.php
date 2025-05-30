<div>
    <section class="page-title bg-holder bg-overlay-black-50" style="background: url({{ asset($place->banner_image) }});">
        <div class="container">
            <div class="row justify-content-center position-relative">
                <div class="col-lg-6 text-center">
                    <h1 class="text-white banner-shadow">{{ $place->name_en ? app()->getLocale() == 'tr' ? $place->name : $place->name_en : $place->name }}</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">{{ __('header.home') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ $menu }}">@if($type == 'housing') {{ __('pages.housing') }} @elseif($type == 'tradition') {{ __('pages.tradition') }} @elseif($type == 'handicraft') {{ __('pages.handicraft') }} @elseif($type == 'culinary') {{ __('pages.culinary') }} @endif</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ app()->getLocale() == 'tr' ? $place->name : $place->name_en }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="space-ptb bg-light pt-11">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-9">
                    <h2>{{ app()->getLocale() == 'tr' ? $place->name : $place->name_en }} <i class="fas fa-check-circle text-success ps-3"></i></h2>
                    <a class="listing-loaction text-dark mb-3 d-block" href="{{ route('counties.detail', ['placeSlug' => $place->county->slug]) }}"> <i class="fas fa-map-marker-alt pe-2 text-primary"></i> {{ $place->county->name }}</a>

                    <ul class="list-unstyled listing-detail-meta mb-0 mt-4">
                        @if($place->website)
                            <li><a href="{{ $place->website }}" target="_blank"><i class="fas fa-link"></i> {{ __('pages.website') }}</a></li>
                        @endif
                            @if($place->phone)
                                <li><a href="tel:{{ $place->phone }}"><i class="fas fa-phone-volume"></i> {{ __('pages.call now') }}</a></li>
                            @endif
                            @if($place->facebook)
                                <li><a href="{{ $place->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i> Facebook</a></li>
                            @endif
                    </ul>
                </div>
                <div class="col-md-3 text-md-end mt-3 mt-md-0">
                    <a class="btn btn-success" href="#"> <i class="far fa-check-circle pe-2"></i> {{ app()->getLocale() == 'tr' ? $place->category->name : $place->category->name_en }}</a>
                </div>
            </div>

            @php
                $images = json_decode($place->images, true);
            @endphp
            <div class="row">
                <div class="col-lg-8">
                    <div class="listing-detail-page">
                        <div class="listing-detail-box mb-3">
                            <div class="slider-slick">
                                <div class="slider slider-for">
                                    @foreach($images  as $image)
                                        <img class="img-fluid" src="{{ asset($image) }}" alt="">
                                    @endforeach
                                </div>
                                <div class="slider slider-nav d-none d-sm-block">
                                    @foreach($images  as $image)
                                        <img class="img-fluid" src="{{ asset($image) }}" alt="">
                                    @endforeach
                                </div>
                            </div>
                            <div class="mt-sm-4 mt-0">
                                <div class="detail-title">
                                    <h5>{{ app()->getLocale() == 'tr' ? $place->name : $place->name_en }}</h5>
                                </div>
                                <p>{!! app()->getLocale() == 'tr' ? $place->description : $place->description_en !!}</p>
                            </div>
                        </div>

                        <div class="listing-detail-box mb-3">
                            <div class="detail-title">
                                <h5>{{ __('pages.Location') }} </h5>
                            </div>
                            <iframe style="width: 100%; height: 300px;" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDyjzOXYYKij55LO2ISbl6mLSUD8YuLLUg&q={{ $place->latitude }},{{ $place->longitude }}" allowfullscreen loading="lazy" ></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar mb-0">
                        @if ($place->latitude && $place->longitude)
                            <div class="widget">
                                <div class="widget-title bg-primary">
                                    <h6 class="text-white mb-0"> <i class="fas fa-map-marker-alt"></i> {{ __('pages.Location') }} </h6>
                                </div>
                                <div class="widget-content">
                                    <iframe style="width: 100%; height: 300px;" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDyjzOXYYKij55LO2ISbl6mLSUD8YuLLUg&q={{ $place->latitude }},{{ $place->longitude }}" allowfullscreen loading="lazy"></iframe>
                                </div>
                            </div>
                        @endif
                        @if($relatedPlaces->count() > 0)
                            <div class="widget">
                                <div class="widget-title bg-primary">
                                    <h6 class="text-white mb-0"> <i class="fas fa-list-ul"></i> {{ __('pages.Related places') }}</h6>
                                </div>
                                <div class="widget-content">
                                    @foreach($relatedPlaces as $relatedPlace)
                                        <div class="recent-list-item d-flex mb-3">
                                            <img class="img-fluid w-25" src="{{ asset($relatedPlace->image) }}" alt="{{ $relatedPlace->name }}">
                                            <div class="recent-list-item-info ms-3">
                                                <a class="address text-dark mb-2 d-block" href="{{ route('tourism.detail', ['categorySlug' => $categorySlug, 'placeSlug' => $relatedPlace->slug]) }}">
                                                    {{ app()->getLocale() == 'tr' ? $relatedPlace->name : $relatedPlace->name_en }}
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('front/assets/css/slick/slick-theme.css') }}" />
        <link rel="stylesheet" href="{{ asset('front/assets/css/range-slider/ion.rangeSlider.css') }}" />
    @endpush
    @push('scripts')
        <script src="{{ asset('front/assets/js/range-slider/ion.rangeSlider.min.js') }}"></script>
        <script src="{{ asset('front/assets/js/slick/slick.min.js') }}"></script>
    @endpush
</div>

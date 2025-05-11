<div>
    <section class="page-title bg-holder bg-overlay-black-50" style="background: url({{ asset($place->banner_image) }});">
        <div class="container">
            <div class="row justify-content-center position-relative">
                <div class="col-lg-6 text-center">
                    <h1 class="text-white banner-shadow">{{ app()->getLocale() == 'tr' ? $place->name : $place->name_en }}</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">{{ __('header.home') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ $menu }}">@if($type == 'festival') {{ __('pages.festival') }} @elseif($type == 'tradition') {{ __('pages.tradition') }} @elseif($type == 'handicraft') {{ __('pages.handicraft') }} @elseif($type == 'culinary') {{ __('pages.culinary') }} @endif</a></li>
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
                    <h2>{{ app()->getLocale() == 'tr' ? $place->name : $place->name_en }} </h2>
                    @if($place->county_id)
                        <a class="listing-loaction text-dark mb-3 d-block" href="{{ route('counties.detail', ['placeSlug' => $place->county->slug]) }}"> <i class="fas fa-map-marker-alt pe-2 text-primary"></i> {{ $place->county->name }}</a>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="listing-detail-page">
                        <div class="listing-detail-box mb-3">
                            <div class="listing-detail-page text-center">
                                <div class="listing-detail-box mb-3">
                                    <img class="img-fluid w-50" src="{{ asset($place->image) }}" alt="">
                                </div>
                            </div>
                            <div class="mt-sm-4 mt-0">
                                <div class="detail-title">
                                    <h5>{{ app()->getLocale() == 'tr' ? $place->name : $place->name_en }} </h5>
                                </div>
                                {!! app()->getLocale() == 'tr' ? $place->description : $place->description_en !!}
                            </div>
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
                                                <a class="address text-dark mb-2 d-block" href="{{ route('culture.detail', ['categorySlug' => $categorySlug, 'placeSlug' => $relatedPlace->slug]) }}">
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
</div>

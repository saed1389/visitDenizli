<div>
    <section class="page-title bg-holder bg-overlay-black-50" style="background: url({{ asset($place->banner_image) }});">
        <div class="container">
            <div class="row justify-content-center position-relative">
                <div class="col-lg-6 text-center">
                    <h1 class="text-white">{{ app()->getLocale() == 'tr' ? $place->name : $place->name_en }}</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">{{ __('header.home') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ $menu }}">@if($type == 'event') {{ __('pages.Upcoming Events') }} @elseif($type == 'news') {{ __('pages.Latest News') }} @endif</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ app()->getLocale() == 'tr' ? $place->name : $place->name_en }}</li>
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
                                    @if($type == 'event')
                                        <h6 class="mb-0 text-white"><i class="fab fa-blogger-b"></i> {{ __('pages.Recent Events') }}</h6>
                                    @else
                                        <h6 class="mb-0 text-white"><i class="fab fa-blogger-b"></i> {{ __('pages.Recent News') }}</h6>
                                    @endif
                                </div>
                                <div class="widget-content">
                                    @foreach($relatedPlaces as $item)
                                        <div class="d-flex mb-3 align-items-top">
                                            <div class="avatar avatar-xl h-auto">
                                                <img class="img-fluid" src="{{ asset($item->image) }}" alt="{{ app()->getLocale() == 'tr' ? $item->name : $item->name_en }}">
                                            </div>
                                            <div class="ms-3">
                                                <a class="text-dark" href="{{ route('news.detail', ['categorySlug' => $slug, 'placeSlug' => $item->slug]) }}"> {{ app()->getLocale() == 'tr' ? $item->name : $item->name_en }} </a>
                                                <a class="d-flex font-sm text-dark" href="javascript: void (0)">{{ date('d/m/Y', strtotime($item->created_at)) }}</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <div class="widget">
                            <div class="widget-title bg-primary">
                                <h6 class="mb-0 text-white"><i class="far fa-envelope"></i> {{ __('pages.Subscribe & Follow') }}</h6>
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
                                <h2>{{ app()->getLocale() == 'tr' ? $place->name : $place->name_en }}</h2>
                            </div>
                            @if($type == 'event')
                                <div class="blog-post-category">
                                    <span class="text-white">{{ __('home.start on') }}: {{ \Carbon\Carbon::createFromFormat('d.m.Y H:i', $place->start_date)->format('d ') . trans('date.months.' . \Carbon\Carbon::createFromFormat('d.m.Y H:i', $place->start_date)->format('F')) . \Carbon\Carbon::createFromFormat('d.m.Y H:i', $place->start_date)->format(' Y') }},</span>
                                </div>
                                <div class="blog-post-category bg-danger">
                                    <span class="text-white" >{{ __('home.end on') }}: {{ \Carbon\Carbon::createFromFormat('d.m.Y H:i', $place->end_date)->format('d ') . trans('date.months.' . \Carbon\Carbon::createFromFormat('d.m.Y H:i', $place->end_date)->format('F')) . \Carbon\Carbon::createFromFormat('d.m.Y H:i', $place->end_date)->format(' Y') }}</span>
                                </div>
                            @endif

                            <div class="blog-post-footer border-0 justify-content-start">
                                <div class="blog-post-time ms-0">
                                     <i class="far fa-clock"></i>{{ date('d/m/Y', strtotime($place->created_at)) }}
                                </div>
                                <div class="blog-post-author">
                                    <span><a href="{{ route('counties.detail', ['placeSlug' => $place->county->slug]) }}"> <i class="fa fa-location-arrow"></i> {{ $place->county->name }}</a> </span>
                                </div>

                            </div>
                            <div class="blog-post-image">
                                <img class="img-fluid mb-4" src="{{ asset($place->image) }}" alt="">
                            </div>
                            <div class="blog-post-content border-0">
                                <div class="blog-post-description">
                                    <p class="mb-0">{!! app()->getLocale() == 'tr' ? $place->description : $place->description_en  !!}</p>
                                </div>
                                @if($relatedPlaces->count() > 0)
                                    <hr>
                                    <div class="mt-4">
                                        <h5 class="mb-4">@if($type == 'event') {{ __('pages.Related Events') }} @else {{ __('pages.Related News') }} @endif</h5>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="owl-carousel " data-nav-dots="true" data-items="2" data-md-items="2" data-sm-items="1" data-xs-items="1" data-xx-items="1" data-space="15">
                                                    @foreach($relatedPlaces as $item)
                                                        <div class="item">
                                                            <div class="blog-post bg-overlay-half-bottom bg-holder" style="background-image: url({{ asset($item->image) }});">
                                                                <div class="blog-post-info">
                                                                    @if($item->start_date)
                                                                        <div class="blog-post-category mb-0">
                                                                            <span class="text-white">{{ __('home.start on') }}: {{ \Carbon\Carbon::createFromFormat('d.m.Y H:i', $item->start_date)->format('d ') . trans('date.months.' . \Carbon\Carbon::createFromFormat('d.m.Y H:i', $item->start_date)->format('F')) . \Carbon\Carbon::createFromFormat('d.m.Y H:i', $item->start_date)->format(' Y') }},</span>
                                                                        </div>
                                                                        <div class="blog-post-category bg-danger mb-0">
                                                                            <span class="text-white" >{{ __('home.end on') }}: {{ \Carbon\Carbon::createFromFormat('d.m.Y H:i', $item->end_date)->format('d ') . trans('date.months.' . \Carbon\Carbon::createFromFormat('d.m.Y H:i', $item->end_date)->format('F')) . \Carbon\Carbon::createFromFormat('d.m.Y H:i', $item->end_date)->format(' Y') }}</span>
                                                                        </div>
                                                                    @endif

                                                                    <h5 class="blog-post-title"><a href="{{ route('news.detail', ['categorySlug' => $slug, 'placeSlug' => $item->slug]) }}"> {{ app()->getLocale() == 'tr' ? $item->name : $item->name_en }} </a></h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div>
    <style>
        .autocomplete-dropdown {
            position: absolute;
            background: white;
            border: 1px solid #ddd;
            width: 100%;
            z-index: 1000;
            max-height: 200px;
            overflow-y: auto;
        }

        .autocomplete-dropdown ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .autocomplete-dropdown li {
            padding: 8px 12px;
            cursor: pointer;
        }

        .autocomplete-dropdown li:hover {
            background-color: #f0f0f0;
        }
    </style>
    <section class="banner bg-holder bg-overlay-black-50" style="background-image: url({{ asset($setting->slider) }});">
        <div class="container">
            <div class="row justify-content-center position-relative">
                <div class="col-lg-10 text-center">
                    <h1 class="text-white text-shadow">{{ __('home.slider title') }}</h1>
                    <p class="text-white banner-sub-title text-shadow">{{ __('home.slider description') }}</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    @livewire('partials.search')
                </div>
            </div>
        </div>
    </section>

    <section class="py-4 border-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 mb-lg-0 mb-2">
                    <div class="d-flex align-items-center">
                        <h6>{{ __('home.Or browse the highlights') }}</h6>
                        <i class="h1 flaticon-next text-primary ms-2"></i>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="owl-carousel" data-nav-dots="false" data-nav-arrow="false" data-items="6" data-md-items="5" data-sm-items="4" data-xs-items="2" data-xx-items="1" data-space="20" data-autoheight="false">
                        @foreach($categories as $category)
                            <div class="item">
                                <a class="category-item bg-holder bg-overlay-black-50 text-center" style="background-image: url('/{{ $category->image }}'); height: 75px" href="{{ route('housing.by.category', $category->slug) }}">
                                    <span class="mb-0 text-white position-relative text-shadow">
                                        {{ app()->getLocale() == 'tr' ? $category->name : $category->name_en }}
                                    </span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="space-ptb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2><a href="{{ route('counties.listing') }}">{{ __('home.Fine location in these cities') }}</a></h2>
                        <div class="sub-title text-end"> <span> {{ __('home.Remind yourself the only thing stopping you is yourself.') }}</span></div>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($cities as $city)
                    @php
                        if ($loop->iteration % 6 == 1) {
                            $columnClass = 'col-md-6 col-lg-4';
                            $marginClass = '';
                        } elseif ($loop->iteration % 6 == 2) {
                            $columnClass = 'col-md-6 col-lg-3';
                            $marginClass = '';
                        } elseif ($loop->iteration % 6 == 3) {
                            $columnClass = 'col-md-6 col-lg-5';
                            $marginClass = '';
                        } elseif ($loop->iteration % 6 == 4) {
                            $columnClass = 'col-md-6 col-lg-5';
                            $marginClass = '';
                        } elseif ($loop->iteration % 6 == 5) {
                            $columnClass = 'col-md-6 col-lg-4';
                            $marginClass = '';
                        } else {
                            $columnClass = 'col-md-6 col-lg-3';
                            $marginClass = '';
                        }
                    @endphp
                    <div class="{{ $columnClass }} {{ $marginClass }} mt-4">
                        <a href="{{ route('counties.detail', ['placeSlug' => $city->slug]) }}">
                            <div class="location-item bg-holder bg-overlay-black-50 text-center" style="background-image: url({{ $city->image }});"></div>
                        </a>
                        <a class="text-center" href="{{ route('counties.detail', ['placeSlug' => $city->slug]) }}"><h6 class="mt-2">{{ $city->name }}</h6></a>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <a href="{{ route('counties.listing') }}" class="w-50 btn btn-secondary mt-3"><h6 class="mt-2"> {{ __('home.Counties List') }} </h6></a>
                </div>
            </div>
        </div>
    </section>
    <section class="space-pb popup-gallery">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Blog</h2>
                        <div class="sub-title text-end"> <span> {{ __('home.Make a list of your achievements toward your long-term goal') }}</span></div>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($blogs as $blog)
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <div class="listing-item">
                            <div class="listing-image bg-overlay-half-bottom">
                                <img class="img-fluid" src="{{ $blog->image }}" alt="">
                            </div>
                            <div class="listing-details">
                                <div class="listing-details-inner">
                                    <div class="listing-title">
                                        <h6><a href="{{ route('blog.detail', $blog->slug) }}">{{ app()->getLocale() == 'tr' ? $blog->name : $blog->name_en }}</a></h6>
                                    </div>
                                    <div class="listing-info">
                                        <p class="mb-0">{!! app()->getLocale() == 'tr' ? \Illuminate\Support\Str::limit($blog->description, 50, '...') : \Illuminate\Support\Str::limit($blog->description_en, 50, '...') !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="space-pb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>{{ __('home.about us') }}</h2>
                        <div class="sub-title text-end"> <span> {{ __('home.about us description') }}</span></div>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="accordion mb-3" id="accordion">
                        <div class="card">
                            <div class="accordion-icon card-header" id="headingOne">
                                <h6 class="mb-0">
                                    <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <span>01</span> {{ __('home.What is VisitDenizli?') }}
                                    </button>
                                </h6>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordion">
                                <div class="card-body">
                                    <p>{!! __('home.what is VisitDenizli description') !!}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="accordion-icon card-header" id="headingTwo">
                                <h6 class="mb-0">
                                    <button class="btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <span>02</span> {{ __('home.What Can You Find on VisitDenizli?') }}
                                    </button>
                                </h6>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordion">
                                <div class="card-body">
                                    <p>
                                        {!! __('home.What Can You Find on description') !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="accordion-icon card-header" id="headingthree">
                                <h6 class="mb-0">
                                    <button class="btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsethree" aria-expanded="false" aria-controls="collapsethree">
                                        <span>03</span> {{ __('home.Why is VisitDenizli Important?') }}
                                    </button>
                                </h6>
                            </div>
                            <div id="collapsethree" class="collapse" aria-labelledby="headingthree" data-bs-parent="#accordion">
                                <div class="card-body">
                                    <p>{!! __('home.why is visitDenizli important description') !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1 text-center">
                    <img class="img-fluid" src="{{ asset('front/assets/images/about/hakkimizda.png') }}" alt="">
                </div>
            </div>
        </div>
    </section>

    <section class="space-pb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>{{ __('home.News & Events') }}</h2>
                        <div class="sub-title text-end"> <span> {{ __('home.Reflect and experiment until you find the right combination') }}</span></div>
                    </div>
                </div>
            </div>
            <div class="row">
                @if($event)
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <div class="blog-post bg-overlay-half-bottom bg-holder h-100" style="background-image: url({{ asset($event->image) }});">
                            <div class="blog-post-info">
                                <div class="blog-post-category">
                                    <a href="javascript: void (0)">{{ __('home.start on') }}: {{ \Carbon\Carbon::createFromFormat('d.m.Y H:i', $event->start_date)->format('d ') . trans('date.months.' . \Carbon\Carbon::createFromFormat('d.m.Y H:i', $event->start_date)->format('F')) . \Carbon\Carbon::createFromFormat('d.m.Y H:i', $event->start_date)->format(' Y') }},</a>
                                </div>
                                <div class="blog-post-category bg-danger">
                                    <a href="javascript: void (0)">{{ __('home.end on') }}: {{ \Carbon\Carbon::createFromFormat('d.m.Y H:i', $event->end_date)->format('d ') . trans('date.months.' . \Carbon\Carbon::createFromFormat('d.m.Y H:i', $event->end_date)->format('F')) . \Carbon\Carbon::createFromFormat('d.m.Y H:i', $event->end_date)->format(' Y') }}</a>
                                </div>
                                <h5 class="blog-post-title"><a href="{{ route('news.detail', ['categorySlug' => 'yaklasan-etkinlikler', 'placeSlug' => $event->slug]) }}"> {{ app()->getLocale() == 'tr' ? $event->name : $event->name_en }} </a></h5>
                                <h6 class="blog-post-title" style="font-size: 14px;"><a href="{{ route('counties.detail', ['placeSlug' => $event->county->slug]) }}">{{ __('home.county') }}: {{ $event->county->name }}</a> </h6>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-lg-6">
                    @foreach($news as $item)
                        <div class="blog-post bg-overlay-half-bottom bg-holder {{ $loop->first ? 'mb-4' : '' }} " style="background-image: url({{ asset($item->image) }});">
                            <div class="blog-post-info">
                                <h5 class="blog-post-title"><a href="{{ route('news.detail', ['categorySlug' => 'guncel-haberler', 'placeSlug' => $event->slug]) }}"> {{ app()->getLocale() == 'tr' ? $item->name : $item->name_en }}</a></h5>
                                <h6 class="blog-post-title" style="font-size: 14px;"><a href="{{ route('counties.detail', ['placeSlug' => $item->county->slug]) }}">{{ __('home.county') }}: {{ $item->county->name }}</a> </h6>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="space-pb">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-4 mb-lg-0 text-center">
                    <img class="img-fluid" src="{{ asset('front/assets/images/app.png') }}" alt="">
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <div class="section-title">
                        <h2>{{ __('home.Download the app') }}</h2>
                        <div class="sub-title text-end"> <span> {{ __('home.One of the main areas that I work on with my clients.') }}</span></div>
                    </div>

                    <p class="font-sm">{!! __('home.app description') !!}</p>
                    <div class="d-block d-sm-flex mt-md-5 mt-4">
                        <a class="btn btn-dark btn-sm btn-app me-0 me-sm-2 mb-2 mb-sm-0" href="#">
                            <i class="fab fa-apple"></i>
                            <div class="btn-text text-start">
                                <small>{{ __('home.Download on the') }} </small>
                                <span class="mb-0 text-white d-block">App store</span>
                            </div>
                        </a>
                        <a class="btn btn-dark btn-sm btn-app mb-2 mb-sm-0" href="#">
                            <i class="fab fa-google-play"></i>
                            <div class="btn-text text-start">
                                <small>{{ __('home.Get in on') }} </small>
                                <span class="mb-0 text-white d-block">google play</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=================================
    Mobile app -->
</div>
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function showDropdown() {
                if (window.Livewire) {
                    Livewire.emit('showDropdown');
                }
            }

            function hideDropdown() {
                setTimeout(() => {
                    if (window.Livewire) {
                        Livewire.emit('hideDropdown');
                    }
                }, 100);
            }
        });
    </script>
@endpush

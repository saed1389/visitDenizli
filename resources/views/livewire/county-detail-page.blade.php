<div>
    <section class="page-title bg-holder bg-overlay-black-50" style="background: url({{ asset($county->banner_image) }});">
        <div class="container">
            <div class="row justify-content-center position-relative">
                <div class="col-lg-6 text-center">
                    <h1 class="text-white">{{ $county->name }}</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">{{ __('header.home') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ $menu }}">{{ __('home.Counties List') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $county->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="space-ptb">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <h2>{{ $county->name }}</h2>
                    {!! app()->getLocale() == 'tr' ? $county->description : $county->description_en !!}
                </div>
                <div class="col-md-5 mt-4 mt-md-0">
                    <img class="img-fluid border-radius" src="{{ asset($county->image) }}" alt="{{ $county->name }}">
                </div>
            </div>
        </div>
    </section>
    <section class="space-ptb bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mt-4 mt-md-0">
                    <div class="row">
                        <!-- History Places -->
                        @if($historyPlaces->isNotEmpty())
                            <div class="row">
                                <div class="col-12">
                                    <h2>{{ __('pages.History Places') }}</h2>
                                </div>
                                @foreach($historyPlaces as $historyPlace)
                                    <div class="col-lg-3 mb-4">
                                        <div class="listing-item">
                                            <div class="listing-image bg-overlay-half-bottom">
                                                <img class="img-fluid" src="{{ asset($historyPlace->image) }}" alt="{{ app()->getLocale() == 'tr' ? $historyPlace->name : $historyPlace->name_en }}">
                                                <div class="listing-quick-box">
                                                    <a class="popup popup-single" href="{{ asset($historyPlace->image) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Zoom"> <i class="fas fa-search-plus"></i> </a>
                                                </div>
                                            </div>
                                            <div class="listing-details">
                                                <div class="listing-details-inner">
                                                    <div class="listing-title">
                                                        <h6><a href="{{ route('place.detail', [ 'categorySlug' => 'tarihi-mekanlar', 'placeSlug' => $historyPlace->slug ]) }}">{{ app()->getLocale() == 'tr' ? $historyPlace->name : $historyPlace->name_en }}</a></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        @if($naturalPlaces->isNotEmpty())
                            <div class="row">
                                <div class="col-12">
                                    <h2>{{ __('pages.Natural Place') }}</h2>
                                </div>
                                @foreach($naturalPlaces as $naturalPlace)
                                    <div class="col-lg-3 mb-4">
                                        <div class="listing-item">
                                            <div class="listing-image bg-overlay-half-bottom">
                                                <img class="img-fluid" src="{{ asset($naturalPlace->image) }}" alt="{{ app()->getLocale() == 'tr' ? $naturalPlace->name : $naturalPlace->name_en }}">
                                                <div class="listing-quick-box">
                                                    <a class="popup popup-single" href="{{ asset($naturalPlace->image) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Zoom"> <i class="fas fa-search-plus"></i> </a>
                                                </div>
                                            </div>
                                            <div class="listing-details">
                                                <div class="listing-details-inner">
                                                    <div class="listing-title">
                                                        <h6><a href="{{ route('place.detail', [ 'categorySlug' => 'dogal-guzellikler', 'placeSlug' => $naturalPlace->slug ]) }}">{{ app()->getLocale() == 'tr' ? $naturalPlace->name : $naturalPlace->name_en }}</a></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <!-- Festivals -->
                        @if($festivals->isNotEmpty())
                            <div class="row">
                                <div class="col-12">
                                    <h2>{{ __('pages.Festivals') }}</h2>
                                </div>
                                @foreach($festivals as $festival)
                                    <div class="col-lg-3 mb-4">
                                        <div class="listing-item">
                                            <div class="listing-image bg-overlay-half-bottom">
                                                <img class="img-fluid" src="{{ asset($festival->image) }}" alt="{{ app()->getLocale() == 'tr' ? $festival->name : $festival->name_en }}">
                                                <div class="listing-quick-box">
                                                    <a class="popup popup-single" href="{{ asset($festival->image) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Zoom"> <i class="fas fa-search-plus"></i> </a>
                                                </div>
                                            </div>
                                            <div class="listing-details">
                                                <div class="listing-details-inner">
                                                    <div class="listing-title">
                                                        <h6><a href="{{ route('culture.detail', ['categorySlug' => 'yerel-festivaller', 'placeSlug' => $festival->slug ]) }}">{{ app()->getLocale() == 'tr' ? $festival->name : $festival->name_en }}</a></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <!-- Museum Places -->
                        @if($museumPlaces->isNotEmpty())
                            <div class="row">
                                <div class="col-12">
                                    <h2>{{ __('pages.Museums') }}</h2>
                                </div>
                                @foreach($museumPlaces as $museumPlace)
                                    <div class="col-lg-3 mb-4">
                                        <div class="listing-item">
                                            <div class="listing-image bg-overlay-half-bottom">
                                                <img class="img-fluid" src="{{ asset($museumPlace->image) }}" alt="{{ app()->getLocale() == 'tr' ? $museumPlace->name : $museumPlace->name_en }}">
                                                <div class="listing-quick-box">
                                                    <a class="popup popup-single" href="{{ asset($museumPlace->image) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Zoom"> <i class="fas fa-search-plus"></i> </a>
                                                </div>
                                            </div>
                                            <div class="listing-details">
                                                <div class="listing-details-inner">
                                                    <div class="listing-title">
                                                        <h6><a href="{{ route('place.detail', [ 'categorySlug' => 'muzeler-ve-sanat-galerileri', 'placeSlug' => $museumPlace->slug ]) }}">{{ app()->getLocale() == 'tr' ? $museumPlace->name : $museumPlace->name_en }}</a></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <!-- News -->
                        @if($news->isNotEmpty())
                            <div class="row">
                                <div class="col-12">
                                    <h2>{{ __('pages.News') }}</h2>
                                </div>
                                @foreach($news as $item)
                                    <div class="col-lg-3 mb-4">
                                        <div class="listing-item">
                                            <div class="listing-image bg-overlay-half-bottom">
                                                <img class="img-fluid" src="{{ asset($item->image) }}" alt="{{ app()->getLocale() == 'tr' ? $item->name : $item->name_en }}">
                                                <div class="listing-quick-box">
                                                    <a class="popup popup-single" href="{{ asset($item->image) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Zoom"> <i class="fas fa-search-plus"></i> </a>
                                                </div>
                                            </div>
                                            <div class="listing-details">
                                                <div class="listing-details-inner">
                                                    <div class="listing-title">
                                                        <h6><a href="{{ route('news.detail', ['categorySlug' => 'guncel-haberler', 'placeSlug' => $item->slug ]) }}">{{ app()->getLocale() == 'tr' ? $item->name : $item->name_en }}</a></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <!-- Events -->
                        @if($events->isNotEmpty())
                            <div class="row">
                                <div class="col-12">
                                    <h2>{{ __('pages.Events') }}</h2>
                                </div>
                                @foreach($events as $event)
                                    <div class="col-lg-3 mb-4">
                                        <div class="listing-item">
                                            <div class="listing-image bg-overlay-half-bottom">
                                                <img class="img-fluid" src="{{ asset($event->image) }}" alt="{{ app()->getLocale() == 'tr' ? $event->name : $event->name_en }}">
                                                <div class="listing-quick-box">
                                                    <a class="popup popup-single" href="{{ asset($event->image) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Zoom"> <i class="fas fa-search-plus"></i> </a>
                                                </div>
                                            </div>
                                            <div class="listing-details">
                                                <div class="listing-details-inner">
                                                    <div class="listing-title">
                                                        <h6><a href="{{ route('news.detail', ['categorySlug' => 'yaklasan-etkinlikler', 'placeSlug' => $event->slug]) }}">{{ app()->getLocale() == 'tr' ? $event->name : $event->name_en }}</a></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <!-- Tourism Office -->
                        @if($tourismOffices->isNotEmpty())
                            <div class="row">
                                <div class="col-12">
                                    <h2>{{ __('pages.Tourism Office') }}</h2>
                                </div>
                                @foreach($tourismOffices as $tourismOffice)
                                    <div class="col-lg-3 mb-4">
                                        <div class="listing-item">
                                            <div class="listing-image bg-overlay-half-bottom">
                                                <img class="img-fluid" src="{{ asset($tourismOffice->image) }}" alt="{{ $tourismOffice->name }}">
                                                <div class="listing-quick-box">
                                                    <a class="popup popup-single" href="{{ asset($tourismOffice->image) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Zoom"> <i class="fas fa-search-plus"></i> </a>
                                                </div>
                                            </div>
                                            <div class="listing-details">
                                                <div class="listing-details-inner">
                                                    <div class="listing-title">
                                                        <h6><a href="{{ route('tourism.detail', ['categorySlug' => 'turizm-ofisleri', 'placeSlug' => $tourismOffice->slug ]) }}">{{ $tourismOffice->name }}</a></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <!-- Traditions -->
                        @if($traditions->isNotEmpty())
                            <div class="row">
                                <div class="col-12">
                                    <h2>{{ __('pages.Traditions') }}</h2>
                                </div>
                                @foreach($traditions as $tradition)
                                    <div class="col-lg-3 mb-4">
                                        <div class="listing-item">
                                            <div class="listing-image bg-overlay-half-bottom">
                                                <img class="img-fluid" src="{{ asset($tradition->image) }}" alt="{{ app()->getLocale() == 'tr' ? $tradition->name : $tradition->name_en }}">
                                                <div class="listing-quick-box">
                                                    <a class="popup popup-single" href="{{ asset($tradition->image) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Zoom"> <i class="fas fa-search-plus"></i> </a>
                                                </div>
                                            </div>
                                            <div class="listing-details">
                                                <div class="listing-details-inner">
                                                    <div class="listing-title">
                                                        <h6><a href="{{ route('culture.detail', ['categorySlug' => 'gelenek-ve-gorenekler', 'placeSlug' => $tradition->slug]) }}">{{ app()->getLocale() == 'tr' ? $tradition->name : $tradition->name_en }}</a></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <!-- Housings -->
                        @if($housings->isNotEmpty())
                            <div class="row">
                                <div class="col-12">
                                    <h2>{{ __('pages.Housings') }}</h2>
                                </div>
                                @foreach($housings as $housing)
                                    <div class="col-lg-3 mb-4">
                                        <div class="listing-item">
                                            <div class="listing-image bg-overlay-half-bottom">
                                                <img class="img-fluid" src="{{ asset($housing->image) }}" alt="{{ app()->getLocale() == 'tr' ? $housing->name : $housing->name_en }}">
                                                <div class="listing-quick-box">
                                                    <a class="popup popup-single" href="{{ asset($housing->image) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Zoom"> <i class="fas fa-search-plus"></i> </a>
                                                </div>
                                            </div>
                                            <div class="listing-details">
                                                <div class="listing-details-inner">
                                                    <div class="listing-title">
                                                        <h6><a href="{{ route('tourism.detail', ['categorySlug' => $housing->category->slug, 'placeSlug' => $housing->slug ]) }}">{{ app()->getLocale() == 'tr' ? $housing->name : $housing->name_en }}</a></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

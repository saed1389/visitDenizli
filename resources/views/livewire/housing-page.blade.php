<div>
    <section class="page-title bg-holder bg-overlay-black-50" style="background: url({{ asset($menu->image_banner) }});">
        <div class="container">
            <div class="row justify-content-center position-relative">
                <div class="col-lg-6 text-center">
                    <h1 class="text-white">{{ app()->getLocale() == 'tr' ? $menu->title : $menu->title_en }}</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">{{ __('header.home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ app()->getLocale() == 'tr' ? $menu->title : $menu->title_en }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="space-ptb bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="sidebar">
                        <div class="widget">
                            <div class="widget-title bg-primary">
                                <h6 class="text-white mb-0"> <i class="fas fa-filter"></i>{{ __('pages.Filters') }} </h6>
                            </div>
                            <div class="widget-content">
                                <div class="pb-3">
                                    <a class="collapse-title" data-bs-toggle="collapse" href="#filters">{{ __('pages.Advanced Filters') }} <i class="fas fa-minus-circle"></i></a>
                                    <div class="collapse show" id="filters">
                                        <div class="form-group mb-3">
                                            <input type="text" class="form-control" placeholder="{{ __('pages.Who are you looking for?') }}" wire:model.live="searchKeyword">
                                        </div>
                                        <div class="form-group mb-3 select-border">
                                            <select class="form-control" wire:model.live="selectedCounty">
                                                <option value="">{{ __('pages.All Counties') }}</option>
                                                @foreach($counties as $county)
                                                    <option value="{{ $county->id }}">{{ $county->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-3 select-border">
                                            <select class="form-control" wire:model.live="selectedCategory">
                                                <option value="">{{ __('pages.all categories') }}</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ app()->getLocale() == 'tr' ? $category->name : $category->name_en }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="car-widget">
                                    <button id="resetButton" class="btn-secondary btn w-100">{{ __('pages.Reset') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 mt-4 mt-md-0">
                    <div class="row mb-4">
                        <div class="col-12">
                            <h6 class="mb-0">{{ __('pages.All lists are sorted by alphabet') }}</h6>
                        </div>
                    </div>
                    <div class="property-filter d-sm-flex mb-4 pt-4 pt-sm-0">
                        <ul class="property-short list-unstyled d-sm-flex mb-0">
                            <li>
                                <form class="form-inline">
                                    <div class="form-group d-sm-flex d-block">
                                        <label class="justify-content-start form-label d-flex align-items-center mb-0">{{ __('pages.Sort') }}: &nbsp;</label>
                                        <div class="short-by">
                                            <select class="form-select" wire:model="sortBy" wire:change="$refresh" style="border: 1px solid #ffffff;">
                                                <option value="name_asc">{{ __('pages.Alphabetic') }} A-Z</option>
                                                <option value="name_desc">{{ __('pages.Alphabetic') }} Z-A</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </div>

                    <div class="row">
                        @foreach($places as $place)
                            @php
                                $images = json_decode($place->images, true);
                                $firstImage = $images[0];
                            @endphp
                            <div class="col-lg-4 mb-4">
                                <div class="listing-item">
                                    <div class="listing-image bg-overlay-half-bottom">
                                        <img class="img-fluid" src="{{ asset($firstImage) }}" alt="{{ app()->getLocale() == 'tr' ? $place->name : $place->name_en }}">
                                        <div class="listing-quick-box">
                                            <a class="category" href="#"> <i class="flaticon-article"></i> {{ app()->getLocale() == 'tr' ? $place->category->name : $place->category->name_en }}</a>
                                            <a class="popup popup-single" href="{{ asset($firstImage) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Zoom">
                                                <i class="fas fa-search-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="listing-details">
                                        <div class="listing-details-inner">
                                            <div class="listing-title">
                                                <h6>
                                                    <a href="{{ route('tourism.detail', ['categorySlug' => $slug, 'placeSlug' => $place->slug]) }}">
                                                        {{ app()->getLocale() == 'tr' ? $place->name : $place->name_en }}
                                                    </a>
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="listing-bottom">
                                            <a class="listing-loaction" href="{{ route('counties.detail', ['placeSlug' => $place->county->slug]) }}">
                                                <i class="fas fa-map-marker-alt"></i> {{ $place->county->name }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

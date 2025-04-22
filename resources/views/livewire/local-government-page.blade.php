<div>
    <section class="page-title bg-holder bg-overlay-black-50" style="background: url({{ asset($menu->image_banner) }});">
        <div class="container">
            <div class="row justify-content-center position-relative">
                <div class="col-lg-6 text-center">
                    <h1 class="text-white banner-shadow">{{ app()->getLocale() == 'tr' ? $menu->title : $menu->title_en }}</h1>
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
    <section class="space-ptb">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <h2>{{ app()->getLocale() == 'tr' ? $menu->title : $menu->title_en }}</h2>
                    {!! app()->getLocale() == 'tr' ? $menu->description : $menu->description_en !!}
                </div>
                <div class="col-md-5 mt-4 mt-md-0">
                    <img class="img-fluid border-radius" src="{{ asset($menu->image) }}" alt="{{ app()->getLocale() == 'tr' ? $menu->title : $menu->title_en }}">
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
                                            <select class="form-select" wire:model="sortBy" wire:change="sortMembers" style="border: 1px solid #ffffff;">
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
                        @foreach($members as $member)
                            <div class="col-lg-3 mb-4">
                                <div class="listing-item">
                                    <div class="listing-image bg-overlay-half-bottom">
                                        <img class="img-fluid" src="{{ asset($member->image) }}" alt="{{ $member->name }}">
                                        <div class="listing-quick-box">
                                            <a class="popup popup-single" href="{{ asset($member->image) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Zoom">
                                                <i class="fas fa-search-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="listing-details">
                                        <div class="listing-details-inner">
                                            <div class="listing-title">
                                                <h6>
                                                    {{ $member->name }} <br><small style="font-size: 13px">({{ $member->title->name }})</small>
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="listing-bottom">
                                            <a class="listing-loaction" href="{{ route('counties.detail', ['placeSlug' => $member->county->slug]) }}">
                                                <i class="fas fa-map-marker-alt"></i> {{ $member->county->name }}
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
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.getElementById('resetButton').addEventListener('click', function () {
                    clearURL();
                });
            });
            function clearURL() {
                let baseUrl = window.location.href.split('?')[0];
                window.history.pushState({}, document.title, baseUrl);
                location.reload();
            }
        </script>
    @endpush
</div>

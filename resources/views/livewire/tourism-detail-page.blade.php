<div>
    <section class="page-title bg-holder bg-overlay-black-50" style="background: url({{ asset($place->banner_image) }});">
        <div class="container">
            <div class="row justify-content-center position-relative">
                <div class="col-lg-6 text-center">
                    <h1 class="text-white banner-shadow">{{ $place->name_en ? app()->getLocale() == 'tr' ? $place->name : $place->name_en : $place->name }}</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">{{ __('header.home') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ $menu }}">@if($type == 'office') {{ __('pages.office') }} @elseif($type == 'tradition') {{ __('pages.tradition') }}  @endif</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $place->name_en ? app()->getLocale() == 'tr' ? $place->name : $place->name_en : $place->name }}</li>
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
                    <h2>{{ $place->name_en ? app()->getLocale() == 'tr' ? $place->name : $place->name_en : $place->name }} </h2>
                    <a class="listing-loaction text-dark mb-3 d-block" href="{{ route('counties.detail', ['placeSlug' => $place->county->slug]) }}"> <i class="fas fa-map-marker-alt pe-2 text-primary"></i> {{ $place->county->name }}</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="listing-detail-page">
                        <div class="listing-detail-box mb-3">
                            <div class="listing-detail-page text-center">
                                <div class="listing-detail-box w-50 mb-3" style="justify-items: center;">
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
            </div>
        </div>
    </section>
</div>

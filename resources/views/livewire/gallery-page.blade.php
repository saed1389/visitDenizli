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
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs nav-tabs-02" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-01-tab" data-bs-toggle="tab" href="#tab-01" role="tab" aria-controls="tab-01" aria-selected="true">{{ __('pages.photos') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-02-tab" data-bs-toggle="tab" href="#tab-02" role="tab" aria-controls="tab-02" aria-selected="false">{{ __('pages.videos') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-03-tab" data-bs-toggle="tab" href="#tab-03" role="tab" aria-controls="tab-03" aria-selected="false">Instagram</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade active show" id="tab-01" role="tabpanel" aria-labelledby="tab-01-tab">
                            <div class="row">
                                @foreach($galleries as $item)
                                    @if($item->image)
                                        <div class="col-lg-3 mb-4">
                                            <div class="listing-item">
                                                <div class="listing-image bg-overlay-half-bottom">
                                                    <img class="img-fluid" src="{{ asset($item->image) }}" alt="{{ app()->getLocale() == 'tr' ? $item->name : $item->name_en }}">
                                                    <div class="listing-quick-box">
                                                        <a class="popup popup-single" href="{{ asset($item->image) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Zoom">
                                                            <i class="fas fa-search-plus"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="listing-details">
                                                    <div class="listing-details-inner">
                                                        <div class="listing-title">
                                                            <h6>
                                                                <a href="">
                                                                    {{ app()->getLocale() == 'tr' ? $item->name : $item->name_en }}
                                                                </a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                    <div class="listing-bottom">
                                                        <a class="listing-loaction" href="">
                                                            <i class="fas fa-camera"></i> {{ $item->shooter }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-02" role="tabpanel" aria-labelledby="tab-02-tab">
                            <div class="row">
                                @foreach($galleries as $item)
                                    @if($item->link)
                                        <div class="col-lg-6 mb-4">
                                            <div class="listing-item">
                                                <div class="listing-image bg-overlay-half-bottom">
                                                    <iframe width="560" height="315" src="{{ $item->link }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                                </div>
                                                <div class="listing-details">
                                                    <div class="listing-details-inner">
                                                        <div class="listing-title">
                                                            <h6>
                                                                <a href="">
                                                                    {{ app()->getLocale() == 'tr' ? $item->name : $item->name_en }}
                                                                </a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-03" role="tabpanel" aria-labelledby="tab-03-tab">
                            <div class="row">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

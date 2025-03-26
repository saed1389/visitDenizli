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
    <section class="space-ptb">
        <div class="container">
            <div class="row">
                @foreach($photos as $item)
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
                @endforeach
                {{--<div class="row">
                    <div class="col-12">
                        {{ $news->links('pagination::bootstrap-5') }}
                    </div>
                </div>--}}
            </div>
        </div>
    </section>
</div>

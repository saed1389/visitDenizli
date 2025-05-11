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

    <section class="space-ptb pt-11">
        <div class="container">
            <div class="row">
                @foreach($videos as $item)
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
                @endforeach
            </div>
        </div>
    </section>
</div>

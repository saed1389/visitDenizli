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
    @livewire('partials.feature')
    @livewire('partials.call-to-action')
</div>

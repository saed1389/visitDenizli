<div>
    <section class="page-title bg-holder bg-overlay-black-50" style="background: url({{ asset('front/assets/images/bg/arama.jpg') }});">
        <div class="container">
            <div class="row justify-content-center position-relative">
                <div class="col-lg-6 text-center">
                    <h1 class="text-white">{{ __('pages.search results') }}: @if($query) {{ $query }}@endif  @if($county) -  {{ $county }}@endif </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">{{ __('header.home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('pages.search results') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    @if($newsResults->isNotEmpty() || $eventResults->isNotEmpty() || $placesResults->isNotEmpty() || $categoriesResults->isNotEmpty())
        <section class="space-ptb bg-holder">
            <div class="container">
                <div class="row">
                    @if($newsResults->isNotEmpty())
                        <div class="col-md-6">
                            <h3>{{ __('pages.News Results') }}</h3>
                            <ul>
                                @forelse ($newsResults as $news)
                                    <li><a href="{{ route('news.detail', ['categorySlug' => 'guncel-haberler', 'placeSlug' => $news->slug]) }}">{{ app()->getLocale() == 'tr' ? $news->name : $news->name_en }}</a></li>
                                @empty
                                    <li>{{ __('pages.No results found') }}</li>
                                @endforelse
                            </ul>
                        </div>
                    @endif
                    @if($eventResults->isNotEmpty())
                        <div class="col-md-6">
                            <h3 class="">{{ __('pages.Event Results') }}</h3>
                            <ul>
                                @forelse ($eventResults as $event)
                                    <li><a href="{{ route('news.detail', ['categorySlug' => 'yaklasan-etkinlikler', 'placeSlug' => $event->slug]) }}">{{ app()->getLocale() == 'tr' ? $event->name : $event->name_en }} </a></li>
                                @empty
                                    <li>{{ __('pages.No results found') }}</li>
                                @endforelse
                            </ul>
                        </div>
                    @endif
                    @if($categoriesResults->isNotEmpty())
                        <div class="col-md-6">
                            <h3 class="">{{ __('pages.Category Results') }}</h3>
                            <ul>
                                @forelse ($categoriesResults as $category)
                                    <li><a href="{{ route('housing.by.category', $category->slug) }}">{{ app()->getLocale() == 'tr' ? $category->name : $category->name_en }}</a></li>
                                @empty
                                    <li>{{ __('pages.No results found') }}</li>
                                @endforelse
                            </ul>
                        </div>
                    @endif
                    @if($placesResults->isNotEmpty())
                        <div class="col-md-6">
                            <h3 class="">{{ __('pages.Housing Results') }}</h3>
                            <ul>
                                @forelse ($placesResults as $place)
                                    <li><a href="{{ route('tourism.detail', ['categorySlug' => 'konaklama-rehberi', 'placeSlug' => $place->slug]) }}">{{ app()->getLocale() == 'tr' ? $place->name : $place->name_en }}</a></li>
                                @empty
                                    <li>{{ __('pages.No results found') }}</li>
                                @endforelse
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @else
        <section class="space-ptb bg-holder">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-md-5 text-center position-relative overflow-hidden">
                        <img class="img-fluid" src="{{ asset('front/assets/images/not-found.jpg') }}" alt="">
                    </div>
                    <div class="col-md-6 offset-md-1 mt-5 mt-md-0 text-center align-items-center">
                        <h1 class="mb-4">No result found</h1>
                        <a href="/" class="btn btn-secondary">{{ __('header.home') }}</a>
                    </div>
                </div>
            </div>
        </section>
    @endif
</div>

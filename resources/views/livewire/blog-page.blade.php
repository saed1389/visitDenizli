<div>
    <section class="page-title bg-holder bg-overlay-black-50" style="background: url({{ asset('front/assets/images/bg/02.jpg') }});">
        <div class="container">
            <div class="row justify-content-center position-relative">
                <div class="col-lg-6 text-center">
                    <h1 class="text-white banner-shadow">Blog</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">{{ __('header.home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Blog</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="space-ptb pt-11">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="blog-sidebar sidebar">
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
                                    </div>
                                </div>
                                <div class="car-widget">
                                    <button id="resetButton" class="btn-secondary btn w-100">{{ __('pages.Reset') }}</button>
                                </div>
                            </div>
                        </div>
                        <div class="widget">
                            <div class="widget-title bg-primary">
                                <h6 class="mb-0 text-white"><i class="far fa-address-card"></i> {{ __('pages.About the News') }}</h6>
                            </div>
                            <div class="widget-content">
                                <p>{!! __('pages.about news description') !!}</p>
                            </div>
                        </div>
                        <div class="widget">
                            <div class="widget-title bg-primary">
                                <h6 class="mb-0 text-white"><i class="fab fa-blogger-b"></i> {{ __('pages.Recent Events') }}</h6>
                            </div>
                            <div class="widget-content">
                                @foreach($recentBlogs as $item)
                                    <div class="d-flex mb-3 align-items-top">
                                        <div class="avatar avatar-xl h-auto">
                                            <img class="img-fluid" src="{{ asset($item->image) }}" alt="{{ app()->getLocale() == 'tr' ? $item->name : $item->name_en }}">
                                        </div>
                                        <div class="ms-3">
                                            <a class="text-dark" href="{{ route('blog.detail', $item->slug) }}"> {{ app()->getLocale() == 'tr' ? $item->name : $item->name_en }} </a>
                                            <a class="d-flex font-sm text-dark" href="javascript: void (0)">{{ date('d/m/Y', strtotime($item->created_at)) }}</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="widget">
                            <div class="widget-title bg-primary">
                                <h6 class="mb-0 text-white"><i class="far fa-envelope"></i> {{ __('pages.Subscribe & Follow') }}</h6>
                            </div>
                            <div class="widget-content">
                                <div class="social">
                                    <ul class="list-unstyled">
                                        @if($setting->site_fb)
                                            <li class="facebook">
                                                <a href="{{ $setting->site_fb }}" target="_blank"> <i class="fab fa-facebook-f me-3"></i>Facebook</a>
                                                <a class="follow ms-auto" href="{{ $setting->site_fb }}" target="_blank">{{ __('pages.Like') }} </a>
                                            </li>
                                        @endif
                                        @if($setting->site_twitter)
                                            <li class="twitter">
                                                <a href="{{ $setting->site_twitter }}" target="_blank"> <i class="fab fa-twitter me-3"></i>twitter</a>
                                                <a class="follow ms-auto" href="{{ $setting->site_twitter }}">{{ __('pages.followers') }} </a>
                                            </li>
                                        @endif
                                        @if($setting->site_instagram)
                                            <li class="instagram">
                                                <a href="{{ $setting->site_instagram }}" target="_blank"> <i class="fab fa-instagram me-3"></i>instagram</a>
                                                <a class="follow ms-auto" href="{{ $setting->site_instagram }}" target="_blank">{{ __('pages.followers') }} </a>
                                            </li>
                                        @endif
                                        @if($setting->site_youtube)
                                            <li class="youtube">
                                                <a href="{{ $setting->site_youtube }}" target="_blank"> <i class="fab fa-youtube me-3"></i>youtube</a>
                                                <a class="follow ms-auto" href="{{ $setting->site_youtube }}" target="_blank">{{ __('pages.Subscribers') }} </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 mt-lg-0 mt-5">
                    @foreach($blogs as $item)
                        <div class="blog-post-02">
                            <img class="img-fluid" src="{{ asset($item->image) }}" alt="{{ app()->getLocale() == 'tr' ? $item->name : $item->name_en }}">
                            <div class="blog-post-info">
                                <h5 class="blog-post-title"><a href="{{ route('blog.detail', $item->slug) }}"> {{ app()->getLocale() == 'tr' ? $item->name : $item->name_en }} </a></h5>
                                {!! app()->getLocale() == 'tr' ? Str::limit($item->description, 100, '...') : Str::limit($item->description_en, 100, '...') !!}
                            </div>
                            <div class="blog-post-footer">
                                <div class="blog-post-time">
                                    <i class="far fa-clock"></i>{{ date('d/m/Y', strtotime($item->created_at)) }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="row">
                        <div class="col-12">
                            {{ $blogs->links('pagination::bootstrap-5') }}
                        </div>
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

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
                        <div class="widget">
                            <div class="widget-title bg-primary">
                                @if($types == 'event')
                                    <h6 class="mb-0 text-white"><i class="far fa-address-card"></i> {{ __('pages.About the Event') }}</h6>
                                @else
                                    <h6 class="mb-0 text-white"><i class="far fa-address-card"></i> {{ __('pages.About the News') }}</h6>
                                @endif
                            </div>
                            <div class="widget-content">
                                <p>The first thing to remember about success is that it is a process – nothing more, nothing less.</p>
                                <ul class="ps-3">
                                    <li class="mb-2">Making the decision</li>
                                    <li class="mb-2">Clarity – developing the Vision</li>
                                    <li class="mb-2">Taking action – practice Ready, Fire, Aim.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="widget">
                            <div class="widget-title bg-primary">
                                @if($types == 'event')
                                    <h6 class="mb-0 text-white"><i class="fab fa-blogger-b"></i> {{ __('pages.Recent Events') }}</h6>
                                @else
                                    <h6 class="mb-0 text-white"><i class="fab fa-blogger-b"></i> {{ __('pages.Recent News') }}</h6>
                                @endif
                            </div>
                            <div class="widget-content">
                                @foreach($recentEvents as $item)
                                    <div class="d-flex mb-3 align-items-top">
                                        <div class="avatar avatar-xl h-auto">
                                            <img class="img-fluid" src="{{ asset($item->image) }}" alt="{{ app()->getLocale() == 'tr' ? $item->name : $item->name_en }}">
                                        </div>
                                        <div class="ms-3">
                                            <a class="text-dark" href="{{ route('news.detail', ['categorySlug' => $slug, 'placeSlug' => $item->slug]) }}"> {{ app()->getLocale() == 'tr' ? $item->name : $item->name_en }} </a>
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
                    @foreach($news as $item)
                        <div class="blog-post-02">
                            <img class="img-fluid" src="{{ asset($item->image) }}" alt="{{ app()->getLocale() == 'tr' ? $item->name : $item->name_en }}">
                            <div class="blog-post-info">
                                @if($types == 'event')
                                    <div class="blog-post-category">
                                        <span class="text-white">{{ __('home.start on') }}: {{ \Carbon\Carbon::createFromFormat('d.m.Y H:i', $item->start_date)->format('d ') . trans('date.months.' . \Carbon\Carbon::createFromFormat('d.m.Y H:i', $item->start_date)->format('F')) . \Carbon\Carbon::createFromFormat('d.m.Y H:i', $item->start_date)->format(' Y') }},</span>
                                    </div>
                                    <div class="blog-post-category bg-danger">
                                        <span class="text-white" >{{ __('home.end on') }}: {{ \Carbon\Carbon::createFromFormat('d.m.Y H:i', $item->end_date)->format('d ') . trans('date.months.' . \Carbon\Carbon::createFromFormat('d.m.Y H:i', $item->end_date)->format('F')) . \Carbon\Carbon::createFromFormat('d.m.Y H:i', $item->end_date)->format(' Y') }}</span>
                                    </div>
                                @endif
                                <h5 class="blog-post-title"><a href="{{ route('news.detail', ['categorySlug' => $slug, 'placeSlug' => $item->slug]) }}"> {{ app()->getLocale() == 'tr' ? $item->name : $item->name_en }} </a></h5>
                                {!! app()->getLocale() == 'tr' ? Str::limit($item->description, 100, '...') : Str::limit($item->description_en, 100, '...') !!}
                            </div>
                            <div class="blog-post-footer">
                                <div class="blog-post-time">
                                    <i class="far fa-clock"></i>{{ date('d/m/Y', strtotime($item->created_at)) }}
                                </div>
                                <div class="blog-post-author">
                                    <span> <a href="#"> <i class="fa fa-location-arrow"></i> {{ $item->county->name }}</a> </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="row">
                        <div class="col-12">
                            {{ $news->links('pagination::bootstrap-5') }}
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

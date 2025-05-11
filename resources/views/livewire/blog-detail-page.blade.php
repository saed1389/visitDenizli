<div>
    <section class="page-title bg-holder bg-overlay-black-50" style="background: url({{ asset('front/assets/images/bg/02.jpg') }});">
        <div class="container">
            <div class="row justify-content-center position-relative">
                <div class="col-lg-6 text-center">
                    <h1 class="text-white banner-shadow">{{ app()->getLocale() == 'tr' ? $blog->name : $blog->name_en }}</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">{{ __('header.home') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('blog.listing') }}">Blog</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ app()->getLocale() == 'tr' ? $blog->name : $blog->name_en }}</li>
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
                        @if($relatedBlogs->count() > 0)
                            <div class="widget">
                                <div class="widget-title bg-primary">
                                    <h6 class="mb-0 text-white"><i class="fab fa-blogger-b"></i> {{ __('pages.recent blogs') }}</h6>
                                </div>
                                <div class="widget-content">
                                    @foreach($relatedBlogs as $item)
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
                        @endif
                        <div class="widget">
                            <div class="widget-title bg-primary">
                                <h6 class="mb-0 text-white"><i class="fa fa-share-alt"></i> {{ __('pages.Subscribe & Follow') }}</h6>
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
                    <div class="blog-detail">
                        <div class="blog-post-02 mb-0">
                            <div class="blog-post-title mt-0">
                                <h2>{{ app()->getLocale() == 'tr' ? $blog->name : $blog->name_en }}</h2>
                            </div>
                            <div class="blog-post-footer border-0 justify-content-start">
                                <div class="blog-post-time ms-0">
                                    <i class="far fa-clock"></i>{{ date('d/m/Y', strtotime($blog->created_at)) }}
                                </div>
                            </div>
                            <div class="blog-post-image">
                                <img class="img-fluid mb-4" src="{{ asset($blog->image) }}" alt="">
                            </div>
                            <div class="blog-post-content border-0">
                                <div class="blog-post-description">
                                    <p class="mb-0">{!! app()->getLocale() == 'tr' ? $blog->description : $blog->description_en  !!}</p>
                                </div>
                                @if($relatedBlogs->count() > 0)
                                    <hr>
                                    <div class="mt-4">
                                        <h5 class="mb-4"> {{ __('pages.Related News') }} </h5>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="owl-carousel " data-nav-dots="true" data-items="2" data-md-items="2" data-sm-items="1" data-xs-items="1" data-xx-items="1" data-space="15">
                                                    @foreach($relatedBlogs as $item)
                                                        <div class="item">
                                                            <div class="blog-post bg-overlay-half-bottom bg-holder" style="background-image: url({{ asset($item->image) }});">
                                                                <div class="blog-post-info">
                                                                    <h5 class="blog-post-title"><a href="{{ route('blog.detail', $item->slug) }}"> {{ app()->getLocale() == 'tr' ? $item->name : $item->name_en }} </a></h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

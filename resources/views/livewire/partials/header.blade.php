<div>
    <header class="header">
        <div class="topbar">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="d-block d-md-flex align-items-center text-center">
                            <div class="me-3 d-inline-block">
                                @if($setting->site_phone)
                                    <a href="tel:{{ $setting->site_phone }}"><i class="fa fa-phone me-2 fa fa-flip-horizontal"></i>{{ $setting->site_phone }}</a>
                                @endif
                            </div>
                            <div class="me-auto d-inline-block">
                                {{--<span class="me-2 text-white">Get App:</span>
                                <a class="pe-1" href="#"><i class="fab fa-android"></i></a>
                                <a href="#"><i class="fab fa-apple"></i></a>--}}
                            </div>
                            <div class="social d-inline-block">
                                <ul class="list-unstyled">
                                    @if($setting->site_fb)
                                        <li><a href="{{ $setting->site_fb }}" target="_blank"> <i class="fab fa-facebook-f"></i> </a></li>
                                    @endif
                                    @if($setting->site_instagram)
                                            <li><a href="{{ $setting->site_instagram }}" target="_blank"> <i class="fab fa-instagram"></i> </a></li>
                                        @endif
                                        @if($setting->site_twitter)
                                            <li><a href="{{ $setting->site_twitter }}" target="_blank"> <i class="fab fa-twitter"></i> </a></li>
                                        @endif
                                        @if($setting->site_youtube)
                                            <li><a href="{{ $setting->site_youtube }}" target="_blank"> <i class="fab fa-youtube"></i> </a></li>
                                        @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-static-top navbar-expand-lg header-sticky">
            <div class="container-fluid">
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target=".navbar-collapse"><i class="fas fa-align-left"></i></button>
                <a class="navbar-brand" href="/">
                    <img class="img-fluid" src="{{ asset($setting->logo) }}" alt="{{ $setting->site_name }}">
                </a>
                <div class="navbar-collapse collapse justify-content-center">
                    <ul class="nav navbar-nav">
                        <li class="nav-item {{ Request::segment(1) == '' ? 'active' : '' }}">
                            <a class="nav-link" href="/">{{ __('header.home') }}</a>
                        </li>
                        <li class="dropdown nav-item {{ Request::segment(1) == 'hakkimiza' ? 'active' : '' }}">
                            <a href="" class="nav-link" data-bs-toggle="dropdown">{{ __('header.about') }}<i class="fas fa-chevron-down fa-xs"></i></a>
                            <ul class="dropdown-menu">
                                @forelse($menus as $item)
                                    @if($item->parent_id == 1)
                                        <li {!! Request::segment(2) == $item->slug ? 'class="active"' : '' !!}>
                                            <a class="dropdown-item" href="{{ $item->slug ? '/hakkimiza/' . $item->slug : '#' }}">
                                                {{ app()->getLocale() == 'tr' ? $item->title : $item->title_en }}
                                            </a>
                                        </li>
                                    @endif
                                @empty
                                    <li><a class="dropdown-item" href="#">No items found</a></li>
                                @endforelse
                            </ul>
                        </li>
                        <li class="nav-item dropdown {{ Request::segment(1) == 'gezilecek-yerler' ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('header.place visit') }} <i class="fas fa-chevron-down fa-xs"></i>
                            </a>
                            <ul class="dropdown-menu">
                                @forelse($menus as $item)
                                    @if($item->parent_id == 2)
                                        <li {!! Request::segment(2) == $item->slug ? 'class="active"' : '' !!}>
                                            <a class="dropdown-item" href="{{ $item->slug ? '/gezilecek-yerler/' . $item->slug : '#' }}">
                                                {{ app()->getLocale() == 'tr' ? $item->title : $item->title_en }}
                                            </a>
                                        </li>
                                    @endif
                                @empty
                                    <li><a class="dropdown-item" href="#">No items found</a></li>
                                @endforelse
                            </ul>
                        </li>
                        <li class="nav-item dropdown {{ Request::segment(1) == 'kultur-ve-sanat' ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('header.culture and art') }} <i class="fas fa-chevron-down fa-xs"></i>
                            </a>
                            <ul class="dropdown-menu">
                                @forelse($menus as $item)
                                    @if($item->parent_id == 3)
                                        <li {!! Request::segment(2) == $item->slug ? 'class="active"' : '' !!}>
                                            <a class="dropdown-item" href="{{ $item->slug ? '/kultur-ve-sanat/' . $item->slug : '#' }}">
                                                {{ app()->getLocale() == 'tr' ? $item->title : $item->title_en }}
                                            </a>
                                        </li>
                                    @endif
                                @empty
                                    <li><a class="dropdown-item" href="#">No items found</a></li>
                                @endforelse
                            </ul>
                        </li>
                        <li class="nav-item dropdown {{ Request::segment(1) == 'etkinlikler-ve-haberler' ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('header.news and events') }} <i class="fas fa-chevron-down fa-xs"></i>
                            </a>
                            <ul class="dropdown-menu">
                                @forelse($menus as $item)
                                    @if($item->parent_id == 4)
                                        <li {!! Request::segment(2) == $item->slug ? 'class="active"' : '' !!}>
                                            <a class="dropdown-item" href="{{ $item->slug ? '/etkinlikler-ve-haberler/' . $item->slug : '#' }}">
                                                {{ app()->getLocale() == 'tr' ? $item->title : $item->title_en }}
                                            </a>
                                        </li>
                                    @endif
                                @empty
                                    <li><a class="dropdown-item" href="#">No items found</a></li>
                                @endforelse
                            </ul>
                        </li>
                        <li class="nav-item dropdown {{ Request::segment(1) == 'turizm' ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('header.tourism') }} <i class="fas fa-chevron-down fa-xs"></i>
                            </a>
                            <ul class="dropdown-menu">
                                @forelse($menus as $item)
                                    @if($item->parent_id == 5)
                                        <li {!! Request::segment(2) == $item->slug ? 'class="active"' : '' !!}>
                                            <a class="dropdown-item" href="{{ $item->slug ? '/turizm/' . $item->slug : '#' }}">
                                                {{ app()->getLocale() == 'tr' ? $item->title : $item->title_en }}
                                            </a>
                                        </li>
                                    @endif
                                @empty
                                    <li><a class="dropdown-item" href="#">No items found</a></li>
                                @endforelse
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('header.business and economy') }} <i class="fas fa-chevron-down fa-xs"></i>
                            </a>
                            <ul class="dropdown-menu">
                                @forelse($menus as $item)
                                    @if($item->parent_id == 6)
                                        <li>
                                            <a class="dropdown-item" href="">
                                                {{ app()->getLocale() == 'tr' ? $item->title : $item->title_en }}
                                            </a>
                                        </li>
                                    @endif
                                @empty
                                    <li><a class="dropdown-item" href="#">No items found</a></li>
                                @endforelse
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('header.gallery') }} <i class="fas fa-chevron-down fa-xs"></i>
                            </a>
                            <ul class="dropdown-menu">
                                @forelse($menus as $item)
                                    @if($item->parent_id == 7)
                                        <li>
                                            <a class="dropdown-item" href="">
                                                {{ app()->getLocale() == 'tr' ? $item->title : $item->title_en }}
                                            </a>
                                        </li>
                                    @endif
                                @empty
                                    <li><a class="dropdown-item" href="#">No items found</a></li>
                                @endforelse
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('header.map and transportation') }} <i class="fas fa-chevron-down fa-xs"></i>
                            </a>
                            <ul class="dropdown-menu">
                                @forelse($menus as $item)
                                    @if($item->parent_id == 8)
                                        <li>
                                            <a class="dropdown-item" href="">
                                                {{ app()->getLocale() == 'tr' ? $item->title : $item->title_en }}
                                            </a>
                                        </li>
                                    @endif
                                @empty
                                    <li><a class="dropdown-item" href="#">No items found</a></li>
                                @endforelse
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('header.contact') }} <i class="fas fa-chevron-down fa-xs"></i>
                            </a>
                            <ul class="dropdown-menu">
                                @forelse($menus as $item)
                                    @if($item->parent_id == 9)
                                        <li>
                                            <a class="dropdown-item" href="">
                                                {{ app()->getLocale() == 'tr' ? $item->title : $item->title_en }}
                                            </a>
                                        </li>
                                    @endif
                                @empty
                                    <li><a class="dropdown-item" href="#">No items found</a></li>
                                @endforelse
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="d-block d-md-flex align-items-center">
                    <div class="add-listing d-none d-sm-block">
                        <div class="d-block d-md-flex align-items-center">
                            <div class="add-listing d-none d-sm-block">
                                <a class="btn btn-sm btn-primary" style="display: {{ app()->getLocale() == 'tr' ? 'none' : 'block' }}"  href="{{ url('/change-locale/tr') }}"> <img style="width: 32px;" src="{{ asset('front/assets/images/tr-flag.png') }}" alt=""> </a>
                                <a class="btn btn-sm btn-primary" style="display: {{ app()->getLocale() == 'en' ? 'none' : 'block' }}"  href="{{ url('/change-locale/en') }}"> <img style="width: 32px;" src="{{ asset('front/assets/images/uk-flag.png') }}" alt=""> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</div>

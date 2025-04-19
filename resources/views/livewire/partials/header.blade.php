<div>
    <header class="header">
        <div class="topbar" style="height: 100px">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="d-block d-md-flex align-items-center text-center" style="justify-content: center;">
                            <a href="/">
                                <img class="logo" src="{{ asset($setting->logo) }}" style="height: 100px" alt="{{ $setting->site_name }}">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-static-top navbar-expand-lg header-sticky">
            <div class="container-fluid">
                <div class="navbar-sticky">
                    <button type="button" class="navbar-toggler navbar-sticky" data-bs-toggle="collapse" data-bs-target=".navbar-collapse">
                        <i class="fas fa-align-left"></i>
                    </button>
                    <div class="add-listing navbar-lang">
                        <a class="btn btn-sm" style="display: {{ app()->getLocale() == 'tr' ? 'none' : 'block' }}"  href="{{ url('/change-locale/tr') }}"> <img style="width: 32px;" src="{{ asset('front/assets/images/tr-flag.png') }}" alt=""> </a>
                        <a class="btn btn-sm" style="display: {{ app()->getLocale() == 'en' ? 'none' : 'block' }}"  href="{{ url('/change-locale/en') }}"> <img style="width: 32px;" src="{{ asset('front/assets/images/uk-flag.png') }}" alt=""> </a>
                    </div>
                </div>
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
                                        @if($item->id == 4)
                                            <li {!! Request::segment(2) == $item->slug ? 'class="active"' : '' !!}>
                                                <a class="dropdown-item" href="https://www.denizli.bel.tr/" target="_blank">
                                                    {{ app()->getLocale() == 'tr' ? $item->title : $item->title_en }}
                                                </a>
                                            </li>
                                        @else
                                            <li {!! Request::segment(2) == $item->slug ? 'class="active"' : '' !!}>
                                                <a class="dropdown-item" href="{{ $item->slug ? '/hakkimiza/' . $item->slug : '#' }}">
                                                    {{ app()->getLocale() == 'tr' ? $item->title : $item->title_en }}
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                @empty
                                    <li><a class="dropdown-item" href="#">No items found</a></li>
                                @endforelse
                            </ul>
                        </li>
                        <li class="nav-item {{ Request::segment(1) == 'ilceler-listesi' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('counties.listing') }}">{{ __('header.counties') }}</a>
                        </li>
                        <li class="nav-item dropdown {{ Request::segment(1) == 'gezilecek-yerler' ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('header.place visit') }} <i class="fas fa-chevron-down fa-xs"></i></a>
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
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('header.culture and art') }} <i class="fas fa-chevron-down fa-xs"></i></a>
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
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('header.news and events') }} <i class="fas fa-chevron-down fa-xs"></i></a>
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
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('header.tourism') }} <i class="fas fa-chevron-down fa-xs"></i></a>
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
                        <li class="nav-item dropdown {{ Request::segment(1) == 'ekonomi' ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('header.business and economy') }} <i class="fas fa-chevron-down fa-xs"></i></a>
                            <ul class="dropdown-menu">
                                @forelse($menus as $item)
                                    @if($item->parent_id == 6)
                                        <li {!! Request::segment(2) == $item->slug ? 'class="active"' : '' !!}>
                                            <a class="dropdown-item" href="{{ $item->slug ? '/ekonomi/' . $item->slug : '#' }}">
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
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('header.map and transportation') }} <i class="fas fa-chevron-down fa-xs"></i></a>
                            <ul class="dropdown-menu {{ Request::segment(1) == 'harita' ? 'active' : '' }}">
                                @forelse($menus as $item)
                                    @if($item->parent_id == 8)
                                        <li {!! Request::segment(2) == $item->slug ? 'class="active"' : '' !!}>
                                            <a class="dropdown-item" href="{{ $item->slug ? '/harita/' . $item->slug : '#' }}">
                                                {{ app()->getLocale() == 'tr' ? $item->title : $item->title_en }}
                                            </a>
                                        </li>
                                    @endif
                                @empty
                                    <li><a class="dropdown-item" href="#">No items found</a></li>
                                @endforelse
                            </ul>
                        </li>
                        @forelse($menus as $item)
                            @if($item->parent_id == 9)
                                <li class="nav-item {{ Request::segment(1) == 'iletisim' ? 'active' : '' }}" >
                                    <a class="nav-link" href="{{ route('contact.page') }}">{{ __('header.contact') }}</a>
                                </li>
                            @endif
                        @empty
                            ''
                        @endforelse
                    </ul>
                </div>
                <div class="d-block d-md-flex align-items-center">
                    <div class="add-listing d-none d-sm-block">
                        <div class="d-block d-md-flex align-items-center">
                            <div class="add-listing d-none d-sm-block">
                                <a class="btn btn-sm" style="display: {{ app()->getLocale() == 'tr' ? 'none' : 'block' }}"  href="{{ url('/change-locale/tr') }}"> <img style="width: 32px;" src="{{ asset('front/assets/images/tr-flag.png') }}" alt=""> </a>
                                <a class="btn btn-sm" style="display: {{ app()->getLocale() == 'en' ? 'none' : 'block' }}"  href="{{ url('/change-locale/en') }}"> <img style="width: 32px;" src="{{ asset('front/assets/images/uk-flag.png') }}" alt=""> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</div>

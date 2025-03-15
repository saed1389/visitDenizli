<div>
    <footer class="footer border-top space-ptb">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0">
                    <div class="footer-contact-info">
                        <a href="/"><img class="img-fluid footer-logo" src="{{ asset($setting->logo) }}" alt="logo"></a>
                        <div class="contact-address mt-5 me-5 pe-5">
                            @if($setting->site_address)
                                <div class="contact-item">
                                    <p class="fw-normal">{{ $setting->site_address }}</p>
                                </div>
                            @endif
                            @if($setting->site_phone)
                                    <div class="contact-item">
                                        <h4 class="mb-0"><a href="tel:{{ $setting->site_phone }}">{{ $setting->site_phone }}</a></h4>
                                    </div>
                            @endif
                                @if($setting->site_email)
                                    <div class="contact-item mt-4">
                                        <a class="text-dark" href="mailto:{{ $setting->site_email }}">{{ $setting->site_email }}</a>
                                    </div>
                                @endif

                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4  mb-4 mb-lg-0">
                    <h5 class="text-primary mb-2 mb-sm-4">{{ __('footer.Popular Locations') }}</h5>
                    <div class="footer-link">
                        <ul class="list-unstyled mb-0">
                            @foreach($popularCounties->take(5) as $county)
                                <li>
                                    <a href="#">{{ $county->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <ul class="list-unstyled mb-0">
                            @foreach($popularCounties->slice(5) as $county)
                                <li>
                                    <a href="#">{{ $county->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-2 mb-4 mb-lg-0">
                    <h5 class="text-primary mb-2 mb-sm-4">{{ __('footer.Categories') }}</h5>
                    <div class="footer-link">
                        <ul class="list-unstyled mb-0">
                            @foreach($categories as $category)
                                <li><a href="#">{{ app()->getLocale() == 'tr' ? $category->name : $category->name_en }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-2 mb-4 mb-sm-0">
                    <h5 class="text-primary mb-2 mb-sm-4">{{ __('footer.Quick Links') }}</h5>
                    <div class="footer-link">
                        <ul class="list-unstyled mb-0">
                            <li><a href="#">Forum Support</a></li>
                            <li><a href="#">Help fAQs</a></li>
                            <li><a href="#">Contact us</a></li>
                            <li><a href="#">Pricing and plans</a></li>
                            <li><a href="#">Cookies policy</a></li>
                            <li><a href="#">Privacy policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row align-items-center mt-lg-5 mt-0 pt-lg-4 pt-0">
                <div class="col-md-7 mt-4 mt-sm-0 text-md-start text-center">
                    <ul class="list-unstyled mb-0 social-icon">
                        @if($setting->site_fb)
                            <li><a href="{{ $setting->site_fb }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                        @endif
                            @if($setting->site_twitter)
                                <li><a href="{{ $setting->site_twitter }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            @endif
                            @if($setting->site_instagram)
                                <li><a href="{{ $setting->site_instagram }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            @endif
                            @if($setting->site_youtube)
                                <li><a href="{{ $setting->site_youtube }}" target="_blank"><i class="fab fa-youtube"></i></a></li>
                            @endif
                    </ul>
                </div>
                <div class="col-md-5 text-md-end text-center mt-4 mt-md-0">
                    <p class="mb-0">©Copyright {{ date('Y') }} <a href="#">Gis Soft Technology</a> {{ __('footer.All Rights Reserved') }}</p>
                </div>
            </div>
        </div>
    </footer>
</div>

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
    <section class="space-pb mt-n5 position-relative z-index-1 pt-11">
        <div class="container">
            <div class="row g-0 bg-white shadow">
                <div class="col-lg-7 bg-white">
                    <div class="contact-form p-md-5 p-4">
                        <h4 class="mb-4 text-primary">{{ __('pages.Let’s Get In Touch') }}!</h4>
                        <form class="pt-3">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">{{ __('pages.Your Name') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" placeholder="{{ __('pages.Your Name') }}" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">{{ __('pages.Your Email') }} <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="inputEmail4" placeholder="{{ __('pages.Your Email') }}" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">{{ __('pages.Your Phone') }}</label>
                                    <input type="text" class="form-control" id="phone" placeholder="{{ __('pages.Your Phone') }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">{{ __('pages.Subject') }} <span class="text-danger">*</span></label>
                                    <select class="form-control" name="subject" required>
                                        <option value="">{{ __('pages.Please Select') }}</option>
                                        <option value="1">{{ __('pages.Complaint') }}</option>
                                        <option value="2">{{ __('pages.Suggestion') }}</option>
                                        <option value="3">{{ __('pages.Request') }}</option>
                                        <option value="4">{{ __('pages.Help') }}</option>
                                        <option value="5">{{ __('pages.Other') }}</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label class="form-label">{{ __('pages.Your Message') }} <span class="text-danger">*</span></label>
                                    <textarea class="form-control" rows="4" placeholder="{{ __('pages.Your Message') }}" required></textarea>
                                </div>
                                <div class="col-md-12">
                                    <a class="btn btn-primary" href="#">{{ __('pages.Send Message') }}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5 bg-primary p-md-5 p-4">
                    <h4 class="text-white mb-4">{{ __('pages.Contact information') }}</h4>
                    <div class="contact-address pt-3">
                        <div class="d-flex mb-3">
                            <div class="contact-address-icon">
                                <i class="flaticon-location text-white fa-3x"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="text-white">{{ __('pages.Address') }}</h6>
                                <p class="text-white">{{ $setting->site_address }}</p>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="contact-address-icon">
                                <i class="flaticon-mail text-white fa-3x"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="text-white">{{ __('pages.Email') }}</h6>
                                <p class="text-white"><a href="" class="text-white">{{ $setting->site_email }}</a></p>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="contact-address-icon">
                                <i class="flaticon-call text-white fa-3x"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="text-white">{{ __('pages.Phone Number') }}</h6>
                                <a class="text-white mb-2" href="tel:{{ $setting->site_phone }}">{{ $setting->site_phone }}</a>
                            </div>
                        </div>
                        <div class="social-icon-02 mt-4 mt-md-5">
                            <div class="d-flex align-items-center">
                                <h6 class="me-3 mb-0 text-white">{{ __('pages.Social Media') }} :</h6>
                                <ul class="list-unstyled mb-0 d-flex">
                                    @if($setting->site_fb)
                                        <li><a href="{{ $setting->site_fb }}" class="text-white me-3" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                    @endif
                                    @if($setting->site_twitter)
                                        <li><a href="{{ $setting->site_twitter }}" class="text-white me-3" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                    @endif
                                    @if($setting->site_instagram)
                                        <li><a href="{{ $setting->site_instagram }}" class="text-white me-3" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                    @endif
                                    @if($setting->site_youtube)
                                        <li><a href="{{ $setting->site_youtube }}" class="text-white me-3" target="_blank"><i class="fab fa-youtube"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=================================
    Contact -->

    <!--=================================
    Contact Info -->
    {{--<section class="space-pb">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <h4 class="mb-4 mb-sm-5">Additional contact Info</h4>
                </div>
                <div class="col-md-4">
                    <div class="">
                        <i class="flaticon-destination text-primary fa-4x"></i>
                        <div class="px-3">
                            <h5>Directro agency offices</h5>
                            <p class="mb-0">Our Directro Agency offices can help with you buying or selling a home.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-4 mt-md-0">
                    <div class="">
                        <i class="flaticon-pin text-primary fa-4x"></i>
                        <div class="px-3">
                            <h5>Lettings offices</h5>
                            <p class="mb-0">Our Lettings offices can assist with you letting your home, protection and moving home.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-4 mt-md-0">
                    <div class="">
                        <i class="flaticon-chat-1 text-primary fa-4x"></i>
                        <div class="px-3">
                            <h5>Chat to us online</h5>
                            <p class="mb-0">Chat to us online if you have a question about using our Mortgage calculator.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>--}}
    <!--=================================
    Contact Info -->

    <!--=================================
    Map -->
    {{--<section class="map">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-sm-12">
                    <div class="map h-500">
                        <!-- iframe START -->
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.8351288872545!2d144.9556518!3d-37.8173306!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d4c2b349649%3A0xb6899234e561db11!2sEnvato!5e0!3m2!1sen!2sin!4v1443621171568" style="border:0; width: 100%; height: 500px;"></iframe>
                        <!-- iframe END -->
                    </div>
                </div>
            </div>
        </div>
    </section>--}}
</div>

@extends('admin.layouts.appAdmin')
@section('title') Visit Denizli - Ayarlar @endsection
@section('right') rightbar-hide @endsection
@section('content')
    <div class="px-md-4 px-2 py-2 page-header" data-bs-theme="none">
        <div class="d-flex align-items-center">
            <button class="btn d-none d-xl-inline-flex me-3 px-0 sidebar-toggle" type="button">
                <svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"></path>
                    <path d="M9 4v16"></path>
                    <path d="M15 10l-2 2l2 2"></path>
                </svg>
            </button>
            <ol class="breadcrumb mb-0 bg-transparent">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" title="home">Gösterge Paneli</a></li>
                <li class="breadcrumb-item active" aria-current="page" title="App">Ayarlar</li>
            </ol>
        </div>
        <ul class="list-unstyled action d-flex align-items-center mb-0">

            <li class="d-none d-xxl-inline-flex">
                <button class="btn px-0 rightbar-toggle" type="button">
                    <svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"></path>
                        <path d="M15 4v16"></path>
                        <path d="M9 10l2 2l-2 2"></path>
                    </svg>
                </button>
            </li>
            <li class="d-inline-flex d-xxl-none">
                <button class="btn border-0 p-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_rightbar">
                    <svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"></path>
                        <path d="M15 4v16"></path>
                        <path d="M9 10l2 2l-2 2"></path>
                    </svg>
                </button>
            </li>
        </ul>
    </div>
    <div class="ps-md-4 pe-md-3 px-2 py-3 page-body">
        <h3 class="title-font mb-3">Ayarlar</h3>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body card-main-one">
                        <form action="{{ route('admin.setting.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="site_name" class="form-label"><strong>Web Sitesi Başlığı</strong></label>
                                    <input type="text" class="form-control" id="site_name" name="site_name" placeholder="Web Sitesi Başlığı" value="{{ $setting->site_name }}" >
                                    @error('site_name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <label for="site_email" class="form-label"><strong>Web Sitesi E-posta</strong></label>
                                    <input type="email" class="form-control" id="site_email" name="site_email" placeholder="Web sitesi E-posta" value="{{ $setting->site_email }}">
                                    @error('site_email')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <label for="site_phone" class="form-label"><strong>Web Sitesi Telefon</strong></label>
                                    <input type="text" class="form-control" id="site_phone" name="site_phone" placeholder="Web Sitesi Telefon" value="{{ $setting->site_phone }}">
                                    @error('site_phone')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <label for="site_address" class="form-label"><strong>Web Sitesi Adresi</strong></label>
                                    <input type="text" class="form-control" id="site_address" name="site_address" placeholder="Web Sitesi Adresi" value="{{ $setting->site_address }}">
                                    @error('site_address')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <br>
                                <div class="col-sm-3 mt-3">
                                    <label for="site_fb" class="form-label"><strong>Facebook</strong></label>
                                    <input type="text" class="form-control" id="site_fb" name="site_fb" placeholder="Facebook" value="{{ $setting->site_fb }}" >
                                    @error('site_fb')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-3 mt-3">
                                    <label for="site_twitter" class="form-label"><strong>Twitter</strong></label>
                                    <input type="text" class="form-control" id="site_twitter" name="site_twitter" placeholder="Twitter" value="{{ $setting->site_twitter }}">
                                    @error('site_twitter')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-3 mt-3">
                                    <label for="site_instagram" class="form-label"><strong>Instagram</strong></label>
                                    <input type="text" class="form-control" id="site_instagram" name="site_instagram" placeholder="Instagram" value="{{ $setting->site_instagram }}">
                                    @error('site_instagram')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-3 mt-3">
                                    <label for="site_youtube" class="form-label"><strong>Youtube</strong></label>
                                    <input type="text" class="form-control" id="site_youtube" name="site_youtube" placeholder="Youtube" value="{{ $setting->site_youtube }}">
                                    @error('site_youtube')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mt-3">
                                    <label for="logo" class="form-label"><strong>Logo <small class="text-danger">Size: 150x50</small></strong></label>
                                    <input type="file" class="form-control" id="logo" name="logo" placeholder="" value="{{ old('logo') }}">
                                    @error('logo')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-2 mt-3">
                                    <img src="{{ $setting->logo ? asset($setting->logo) : asset('panel/assets/images/def.png') }}" id="showLogo" class="img-thumbnail" alt="" >
                                </div>
                                <div class="col-sm-4 mt-3">
                                    <label for="favicon" class="form-label"><strong>Favicon <small class="text-danger">Size: 32x32</small></strong></label>
                                    <input type="file" class="form-control" id="favicon" name="favicon" placeholder="" value="{{ old('favicon') }}">
                                    @error('favicon')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-2 mt-3">
                                    <img src="{{ $setting->favicon ? asset($setting->favicon) : asset('panel/assets/images/def.png') }}" id="showFav" class="img-thumbnail" alt="" >
                                </div>
                                <div class="col-sm-4 mt-3">
                                    <label for="slider" class="form-label"><strong>Slider <small class="text-danger">Size: 1950x850</small></strong></label>
                                    <input type="file" class="form-control" id="slider" name="slider" placeholder="" value="{{ old('slider') }}">
                                    @error('slider')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-2 mt-3">
                                    <img src="{{ $setting->slider ? asset($setting->slider) : asset('panel/assets/images/def.png') }}" id="showSlider" class="img-thumbnail" alt="" >
                                </div>

                                <div class="col-12 text-end">

                                    <button type="submit" class="btn btn-primary">Kaydet</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#logo').change(function (e) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#showLogo').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(e.target.files[0]);
                });
                $('#favicon').change(function (e) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#showFav').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(e.target.files['0']);
                });

                $('#slider').change(function (e) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#showSlider').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(e.target.files['0']);
                });
            });
        </script>
    @endpush
@endsection

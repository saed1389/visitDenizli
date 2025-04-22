@extends('admin.layouts.appAdmin')
@section('title') Visit Denizli - Menü Ekle @endsection
@section('right') rightbar-hide @endsection
@section('content')
    @push('styles')
        <style>
            .ck-rounded-corners .ck.ck-editor__main>.ck-editor__editable, .ck.ck-editor__main>.ck-editor__editable.ck-rounded-corners {
                height: 300px;
            }
        </style>
    @endpush
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
                <li class="breadcrumb-item"><a href="{{ route('admin.menu.index') }}" >Menü Listesi</a></li>
                <li class="breadcrumb-item active" aria-current="page" title="App">Menü Ekle</li>
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
        <h3 class="title-font mb-3">Menü Ekle</h3>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body card-main-one">
                        <form action="{{ route('admin.menu.update', $menu->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="title" class="form-label"><strong>Menü Başlığı (TR) <span class="text-danger">*</span></strong></label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Menü Başlığı (TR) " value="{{ $menu->title }}" required>
                                    @error('title')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <label for="title_en" class="form-label"><strong>Menü Başlığı (EN) </strong></label>
                                    <input type="text" class="form-control" id="title_en" name="title_en" placeholder="Menü Başlığı (EN) " value="{{ $menu->title_en }}" >
                                    @error('title_en')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <label for="parent_id" class="form-label"><strong>Ana Menü <span class="text-danger">*</span></strong></label>
                                    <select class="form-select" name="parent_id" id="parent_id"  required>
                                        <option value="">-- Lütfen Seçin --</option>
                                        <option value="1" @selected($menu->parent_id == 1)>Hakkımızda</option>
                                        <option value="2" @selected($menu->parent_id == 2)>Gezilecek Yerler</option>
                                        <option value="3" @selected($menu->parent_id == 3)>Kültür ve Sanat</option>
                                        <option value="4" @selected($menu->parent_id == 4)>Etkinlikler ve Haberler</option>
                                        <option value="5" @selected($menu->parent_id == 5)>Turizm</option>
                                        <option value="6" @selected($menu->parent_id == 6)>İş ve Ekonomi</option>
                                        <option value="7" @selected($menu->parent_id == 7)>Fotoğraf ve Video Galeri</option>
                                        <option value="8" @selected($menu->parent_id == 8)>Harita ve Ulaşım</option>
                                        <option value="9" @selected($menu->parent_id == 9)>İletişim</option>
                                    </select>
                                    @error('parent_id')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-sm-12 mt-3">
                                    <label for="ckeditor_tr" class="form-label"><strong>Açıklama (TR) </strong></label>
                                    <textarea name="description" class="form-control" id="ckeditor_tr" >{{ $menu->description }}</textarea>
                                    @error('description')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 mt-3">
                                    <label for="ckeditor_en" class="form-label"><strong>Açıklama (EN) </strong></label>
                                    <textarea name="description_en" class="form-control" id="ckeditor_en" >{{ $menu->description_en }}</textarea>
                                    @error('description_en')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mt-3">
                                    <label for="image" class="form-label"><strong>Resim</strong> <small class="text-danger">Size: 700x420</small></label>
                                    <input type="file" class="form-control" id="image" name="image" placeholder="" value="{{ old('image') }}">
                                    @error('image')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-2 mt-3">
                                    <img src="{{ $menu->image ? asset($menu->image) : asset('panel/assets/images/def.png') }}" id="showImage" class="img-thumbnail" alt="" >
                                </div>
                                <div class="col-sm-4 mt-3">
                                    <label for="image_banner" class="form-label"><strong>Banner Resmi</strong> <small class="text-danger">Size: 1950x850</small><</label>
                                    <input type="file" class="form-control" id="image_banner" name="image_banner" placeholder="" value="{{ old('image_banner') }}">
                                    @error('image_banner')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-2 mt-3">
                                    <img src="{{ $menu->image_banner ? asset($menu->image_banner) : asset('panel/assets/images/def.png') }}" id="showBannerImage" class="img-thumbnail" alt="" >
                                </div>
                                <div class="col-sm-3 mt-3">
                                    <label for="status" class="form-label"><strong>Durum</strong></label>
                                    <div class="my-3">
                                        <input id="active" name="status" type="radio" value="1" class="form-check-input" @checked($menu->status == 1)>
                                        <label class="form-check-label" for="active">Acik</label>
                                        <input id="deactivate" name="status" type="radio" value="0" class="form-check-input" @checked($menu->status == 0)>
                                        <label class="form-check-label" for="deactivate">Kapalı</label>
                                    </div>
                                    @error('status')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-12 text-end">
                                    <a href="{{ route('admin.menu.index') }}" class="btn btn-outline-secondary">İptal</a>
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
        <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                ClassicEditor
                    .create(document.querySelector('#ckeditor_tr'), {
                    })
                    .catch(error => {
                        console.error(error);
                    });

                ClassicEditor
                    .create(document.querySelector('#ckeditor_en'), {
                    })
                    .catch(error => {
                        console.error(error);
                    });
            });

            // Image Preview
            $(document).ready(function () {
                $('#image').change(function (e) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#showImage').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(e.target.files[0]);
                });

                $('#image_banner').change(function (e) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#showBannerImage').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(e.target.files['0']);
                });
            });
        </script>
    @endpush
@endsection

@extends('admin.layouts.appAdmin')
@section('title') Visit Denizli - Etkinlik Güncelle @endsection
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
                <li class="breadcrumb-item"><a href="{{ route('admin.events.index') }}" >Etkinlikler Listesi</a></li>
                <li class="breadcrumb-item active" aria-current="page" title="App">Etkinlik Güncelle</li>
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
        <h3 class="title-font mb-3">Etkinlik Güncelle</h3>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body card-main-one">
                        <form action="{{ route('admin.events.update', $event->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="name" class="form-label"><strong>Etkinlik Adı (TR)<span class="text-danger">*</span></strong></label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Etkinlik Adı (TR)" value="{{ $event->name }}" required>
                                    @error('name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <label for="name_en" class="form-label"><strong>Etkinlik Adı (EN)</strong></label>
                                    <input type="text" class="form-control" id="name_en" name="name_en" placeholder="Etkinlik Adı (EN)" value="{{ $event->name_en }}">
                                    @error('name_en')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <label for="county_id" class="form-label"><strong>İlçe Adı <span class="text-danger">*</span></strong></label>
                                    <select class="form-select" name="county_id" id="county_id" required >
                                        <option value="">-- Lütfen Seçin --</option>
                                        @foreach($counties as $county)
                                            <option value="{{ $county->id }}" @selected($event->county_id == $county->id)>{{ $county->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('county_id')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 mt-3">
                                    <label for="ckeditor_tr" class="form-label"><strong>Açıklama (TR) <span class="text-danger">*</span></strong></label>
                                    <textarea name="description" class="form-control" id="ckeditor_tr" >{{ $event->description }}</textarea>
                                    @error('description')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 mt-3">
                                    <label for="ckeditor_en" class="form-label"><strong>Açıklama (EN) </strong></label>
                                    <textarea name="description_en" class="form-control" id="ckeditor_en" >{{ $event->description_en }}</textarea>
                                    @error('description_en')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mt-3">
                                    <label for="latitude" class="form-label"><strong>Etkinlik Enlem</strong></label>
                                    <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Etkinlik Enlem " value="{{ $event->latitude }}" >
                                    @error('latitude')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mt-3">
                                    <label for="longitude" class="form-label"><strong>Etkinlik Boylam</strong></label>
                                    <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Etkinlik Boylam " value="{{ $event->longitude }}">
                                    @error('longitude')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mt-3">
                                    <label for="address" class="form-label"><strong>Etkinlik Adresi</strong></label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Etkinlik adresi" value="{{ $event->address }}" >
                                    @error('address')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mt-3">
                                    <label for="start_date" class="form-label"><strong>Etkinlik Başlangıç Tarihi <span class="text-danger">*</span></strong></label>
                                    <input type="text" class="form-control" id="start_date" name="start_date" placeholder="Etkinlik Başlangıç Tarihi " value="{{ $event->start_date }}" required>
                                    @error('start_date')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mt-3">
                                    <label for="end_date" class="form-label"><strong>Etkinlik Bitiş Tarihi <span class="text-danger">*</span></strong></label>
                                    <input type="text" class="form-control" id="end_date" name="end_date" placeholder="Etkinlik Bitiş Tarihi " value="{{ $event->end_date }}" required>
                                    @error('end_date')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mt-3">
                                    <label for="image" class="form-label"><strong>Resim <small class="text-danger">Size: 700x420</small></strong></label>
                                    <input type="file" class="form-control" id="image" name="image" placeholder="" value="{{ old('image') }}">
                                    @error('image')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-2 mt-3">
                                    <img src="{{ $event->image ? asset($event->image) : asset('panel/assets/images/def.png') }}" id="showImage" class="img-thumbnail" alt="" >
                                </div>

                                <div class="col-sm-4 mt-3">
                                    <label for="banner_image" class="form-label"><strong>Banner Resmi <small class="text-danger">Size: 1950x850</small></strong></label>
                                    <input type="file" class="form-control" id="banner_image" name="banner_image" placeholder="" value="{{ old('banner_image') }}">
                                    @error('banner_image')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-2 mt-3">
                                    <img src="{{ $event->banner_image ? asset($event->banner_image) : asset('panel/assets/images/def.png') }}" id="showBannerImage" class="img-thumbnail" alt="" >
                                </div>

                                <div class="col-sm-3 mt-3">
                                    <label for="status" class="form-label"><strong>Durum</strong></label>
                                    <div class="my-3">
                                        <input id="active" name="status" type="radio" value="1" class="form-check-input" @checked($event->status == 1)>
                                        <label class="form-check-label" for="active">Acik</label>
                                        <input id="deactivate" name="status" type="radio" value="0" class="form-check-input" @checked($event->status == 0)>
                                        <label class="form-check-label" for="deactivate">Kapalı</label>
                                    </div>
                                    @error('status')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-12 text-end">
                                    <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary">İptal</a>
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
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.0.0/dist/css/tempus-dominus.min.css">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.0.0/dist/js/tempus-dominus.min.js"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const ids = ['start_date', 'end_date'];
                const options = {
                    display: {
                        components: {
                            useTwentyfourHour: true,
                            hours: true,
                            minutes: true,
                        },
                    },
                    localization: {
                        locale: 'tr',
                        format: 'HH:mm',
                    },
                };

                ids.forEach(id => {
                    const element = document.getElementById(id);
                    if (element) {
                        new tempusDominus.TempusDominus(element, options);
                    }
                });
            });

        </script>
        <script>
            class MyUploadAdapter {
                constructor(loader) {
                    this.loader = loader;
                }

                upload() {
                    return this.loader.file
                        .then(file => new Promise((resolve, reject) => {
                            const data = new FormData();
                            data.append('upload', file);

                            fetch("{{ route('admin.events.upload') }}", {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: data
                            })
                                .then(response => response.json())
                                .then(result => {
                                    if (result.url) {
                                        resolve({ default: result.url });
                                    } else {
                                        reject(result.error || 'Upload failed');
                                    }
                                })
                                .catch(error => {
                                    reject(error.message || 'Upload failed');
                                });
                        }));
                }
                abort() { }
            }

            function MyCustomUploadAdapterPlugin(editor) {
                editor.plugins.get('FileRepository').createUploadAdapter = loader => {
                    return new MyUploadAdapter(loader);
                };
            }

            document.addEventListener("DOMContentLoaded", function () {
                ClassicEditor
                    .create(document.querySelector('#ckeditor_tr'), {
                        extraPlugins: [MyCustomUploadAdapterPlugin]
                    })
                    .catch(error => {
                        console.error(error);
                    });

                ClassicEditor
                    .create(document.querySelector('#ckeditor_en'), {
                        extraPlugins: [MyCustomUploadAdapterPlugin]
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

                $('#banner_image').change(function (e) {
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

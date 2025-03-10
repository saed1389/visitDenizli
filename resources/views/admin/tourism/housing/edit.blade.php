@extends('admin.layouts.appAdmin')
@section('title') Visit Denizli - Konaklama Rehberi Güncelle @endsection
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
                <li class="breadcrumb-item"><a href="{{ route('admin.housing.index') }}" >Konaklama Rehberi Listesi</a></li>
                <li class="breadcrumb-item active" aria-current="page" title="App">Konaklama Rehberi Güncelle</li>
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
        <h3 class="title-font mb-3">Konaklama Rehberi Güncelle</h3>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body card-main-one">
                        <form action="{{ route('admin.housing.update', $housing->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="name" class="form-label"><strong>Konaklama Rehberi Adı (TR)<span class="text-danger">*</span></strong></label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Konaklama Rehberi Adı (TR)" value="{{ $housing->name }}" required>
                                    @error('name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <label for="name_en" class="form-label"><strong>Konaklama Rehberi Adı (EN)</strong></label>
                                    <input type="text" class="form-control" id="name_en" name="name_en" placeholder="Konaklama Rehberi Adı (EN)" value="{{ $housing->name_en }}">
                                    @error('name_en')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <label for="county_id" class="form-label"><strong>İlçe Adı <span class="text-danger">*</span></strong></label>
                                    <select class="form-select" name="county_id" id="county_id" required >
                                        <option value="">-- Lütfen Seçin --</option>
                                        @foreach($counties as $county)
                                            <option value="{{ $county->id }}" @selected($housing->county_id == $county->id)>{{ $county->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('county_id')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <label for="category_id" class="form-label"><strong>Kategori Adı <span class="text-danger">*</span></strong></label>
                                    <select class="form-select" name="category_id" id="category_id" required >
                                        <option value="">-- Lütfen Seçin --</option>
                                        @foreach($categories as $item)
                                            <option value="{{ $item->id }}" @selected($housing->category_id == $item->id)>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 mt-3">
                                    <label for="ckeditor_tr" class="form-label"><strong>Açıklama (TR) <span class="text-danger">*</span></strong></label>
                                    <textarea name="description" class="form-control" id="ckeditor_tr" >{{ $housing->description }}</textarea>
                                    @error('description')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 mt-3">
                                    <label for="ckeditor_en" class="form-label"><strong>Açıklama (EN) </strong></label>
                                    <textarea name="description_en" class="form-control" id="ckeditor_en" >{{ $housing->description_en }}</textarea>
                                    @error('description_en')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mt-3">
                                    <label for="address" class="form-label"><strong>Konaklama Adres</strong></label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Konaklama Adres" value="{{ $housing->address }}">
                                    @error('address')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mt-3">
                                    <label for="latitude" class="form-label"><strong>Konaklama Enlem</strong></label>
                                    <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Konaklama Enlem" value="{{ $housing->latitude }}">
                                    @error('latitude')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mt-3">
                                    <label for="longitude" class="form-label"><strong>Konaklama Boylam</strong></label>
                                    <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Konaklama Boylam" value="{{ $housing->longitude }}">
                                    @error('longitude')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mt-3">
                                    <label for="website" class="form-label"><strong>Konaklama Web sitesi</strong></label>
                                    <input type="text" class="form-control" id="website" name="website" placeholder="Konaklama Web sitesi" value="{{ $housing->website }}">
                                    @error('website')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mt-3">
                                    <label for="facebook" class="form-label"><strong>Konaklama Facebook</strong></label>
                                    <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Konaklama Facebook" value="{{ $housing->facebook }}">
                                    @error('facebook')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mt-3">
                                    <label for="images" class="form-label"><strong>Resim <small class="text-danger">Size: 700x420</small></strong></label>
                                    <input type="file" class="form-control" id="images" name="images[]" multiple>
                                    @error('images')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Image Preview Section -->
                                <div class="col-sm-6 mt-3 d-flex flex-wrap" id="preview-container">
                                    @php
                                        $images = json_decode($housing->images, true) ?? [];
                                    @endphp
                                    @foreach($images as $image)
                                        <div class="image-preview position-relative m-2">
                                            <img src="{{ asset($image) }}" class="img-thumbnail" width="100">
                                            <button type="button" class="btn btn-danger btn-sm remove-existing-image position-absolute top-0 end-0" data-image="{{ $image }}" data-id="{{ $housing->id }}">X</button>
                                        </div>
                                    @endforeach
                                </div>


                                <div class="col-sm-3 mt-3">
                                    <label for="status" class="form-label"><strong>Durum</strong></label>
                                    <div class="my-3">
                                        <input id="active" name="status" type="radio" value="1" class="form-check-input" @checked($housing->status == 1)>
                                        <label class="form-check-label" for="active">Acik</label>
                                        <input id="deactivate" name="status" type="radio" value="0" class="form-check-input" @checked($housing->status == 0)>
                                        <label class="form-check-label" for="deactivate">Kapalı</label>
                                    </div>
                                    @error('status')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-12 text-end">
                                    <a href="{{ route('admin.housing.index') }}" class="btn btn-outline-secondary">İptal</a>
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
            class MyUploadAdapter {
                constructor(loader) {
                    this.loader = loader;
                }

                upload() {
                    return this.loader.file
                        .then(file => new Promise((resolve, reject) => {
                            const data = new FormData();
                            data.append('upload', file);

                            fetch("{{ route('admin.housing.upload') }}", {
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

            $(document).ready(function () {
                let dt = new DataTransfer(); // DataTransfer to manage file input
                let existingImages = @json($images); // Store existing images

                $('#images').on('change', function (e) {
                    $('#preview-container').html(''); // Clear preview
                    dt.clearData(); // Clear existing file selection

                    let files = Array.from(e.target.files);

                    files.forEach((file, index) => {
                        let reader = new FileReader();
                        reader.onload = function (event) {
                            let img = `<div class="image-preview position-relative m-2" data-index="${index}">
                        <img src="${event.target.result}" class="img-thumbnail" width="100">
                        <button type="button" class="btn btn-danger btn-sm remove-image position-absolute top-0 end-0">X</button>
                   </div>`;
                            $('#preview-container').append(img);
                        };
                        reader.readAsDataURL(file);
                        dt.items.add(file);
                    });

                    this.files = dt.files;
                });

                // Remove new uploaded images
                $(document).on('click', '.remove-image', function () {
                    let indexToRemove = $(this).parent().data('index');
                    dt.items.remove(indexToRemove);
                    document.getElementById('images').files = dt.files;
                    $(this).parent().remove();
                });

                // Remove existing images
                $(document).on('click', '.remove-existing-image', function () {
                    let imageToRemove = $(this).data('image');
                    let housingId = $(this).data('id');
                    let parentDiv = $(this).parent();

                    $.ajax({
                        url: "{{ route('admin.housing.delete-image') }}", // Route for image deletion
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            image: imageToRemove,
                            id: housingId
                        },
                        success: function (response) {
                            if (response.success) {
                                parentDiv.remove(); // Remove image from DOM
                            } else {
                                alert('Failed to delete image.');
                            }
                        },
                        error: function () {
                            alert('Error deleting image.');
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection

@extends('agent.layouts.appAgent')
@section('title') Visit Denizli - Yerel Yönetim Güncelle @endsection
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
                <li class="breadcrumb-item"><a href="{{ route('agent.dashboard') }}" title="home">Gösterge Paneli</a></li>
                <li class="breadcrumb-item"><a href="{{ route('agent.government.index') }}" >Yerel Yönetim Listesi</a></li>
                <li class="breadcrumb-item active" aria-current="page" title="App">Yerel Yönetim Güncelle</li>
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
        <h3 class="title-font mb-3">Yerel Yönetim Güncelle</h3>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body card-main-one">
                        <form action="{{ route('agent.government.update', $government->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="name" class="form-label"><strong>Yerel Yönetim Adı <span class="text-danger">*</span></strong></label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Yerel Yönetim Adı " value="{{ $government->name }}" required>
                                    @error('name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <label for="governmentTitle_id" class="form-label"><strong>Ünvan <span class="text-danger">*</span></strong></label>
                                    <select class="form-select" name="governmentTitle_id" id="governmentTitle_id" required>
                                        <option value="">-- Lütfen Seçin --</option>
                                        @foreach($titles as $title)
                                            <option value="{{ $title->id }}" @selected($government->governmentTitle_id == $title->id)>{{ $title->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('governmentTitle_id')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <label for="county_id" class="form-label"><strong>İlçe Adı</strong></label>
                                    <select class="form-select" name="" id="county_id" required readonly disabled>
                                        <option value="">-- Lütfen Seçin --</option>
                                        @foreach($counties as $county)
                                            <option value="{{ $county->id }}" @selected(Auth::user()->county_id == $county->id)>{{ $county->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('county_id')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <input hidden="" name="county_id" value="{{ Auth::user()->county_id }}">
                                <div class="col-sm-12 mt-3">
                                    <label for="ckeditor_tr" class="form-label"><strong>Açıklama (TR) <span class="text-danger">*</span></strong></label>
                                    <textarea name="description" class="form-control" id="ckeditor_tr" required >{{ $government->description }}</textarea>
                                    @error('description')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 mt-3">
                                    <label for="ckeditor_en" class="form-label"><strong>Açıklama (EN) </strong></label>
                                    <textarea name="description_en" class="form-control" id="ckeditor_en" >{{ $government->description_en }}</textarea>
                                    @error('description_en')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mt-3">
                                    <label for="image" class="form-label"><strong>Resim <small class="text-danger">Size: 700x420</small></strong></label>
                                    <input type="file" class="form-control" id="image" name="image" placeholder="" value="{{ old('image') }}">
                                    @error('image')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-3 mt-3">
                                    <img src="{{ $government->image ? asset($government->image) : asset('panel/assets/images/def.png') }}" id="showImage" class="img-thumbnail" alt="" >
                                </div>
                                <div class="col-12 text-end">
                                    <a href="{{ route('agent.government.index') }}" class="btn btn-outline-secondary">İptal</a>
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

                            fetch("{{ route('agent.government.upload') }}", {
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
            });
        </script>
    @endpush
@endsection

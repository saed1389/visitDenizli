@extends('admin.layouts.appAdmin')
@section('title') Visit Denizli - Tarihçe @endsection
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
                <li class="breadcrumb-item active" aria-current="page" title="App">Tarihçe</li>
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
        <div class="row g-3">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header py-3 d-flex flex-wrap justify-content-between align-items-center bg-transparent border-bottom-0">
                        <h4 class="card-title m-0">Tarihçe</h4>
                    </div>
                    <form action="{{ route('admin.about.history-update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6 ">
                                    <label for="ckeditor_tr" class="form-label"><strong>Tarihçe (TR) <span class="text-danger">*</span></strong></label>
                                    <textarea class="form-control" name="history" id="ckeditor_tr" rows="3">{{ @$about->history }}</textarea>
                                    @error('history')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label for="ckeditor" class="form-label"><strong>Tarihçe (EN)</strong></label>
                                    <textarea class="form-control" name="history_en" id="ckeditor_en" rows="3">{{ @$about->history_en }}</textarea>
                                    @error('history_en')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <div class="col-sm-12 mt-3">
                                        <label for="image" class="form-label"><strong>Resim</strong> <small class="text-danger">Size: 475x410 px</small></label>
                                        <input type="file" class="form-control" id="image" name="image" placeholder="" value="{{ old('image') }}">
                                        @error('image')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-4 mt-3">
                                        <img src="{{ @$about->h_image ? asset(@$about->h_image) : asset('panel/assets/images/def.png') }}" id="showImage" class="img-thumbnail" alt="" >
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <button type="submit" class="btn btn-primary">Kaydet</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
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

                        fetch("{{ route('admin.about.upload') }}", {
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

        // Apply CKEditor to both textareas
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
    <script>
        $(document).ready(function(e){
            $('#image').change(function (e) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endpush
@push('styles')
    <style>
        .ck-rounded-corners .ck.ck-editor__main>.ck-editor__editable, .ck.ck-editor__main>.ck-editor__editable.ck-rounded-corners {
            height: 300px;
        }
    </style>
@endpush

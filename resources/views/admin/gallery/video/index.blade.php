@extends('admin.layouts.appAdmin')
@section('title') Visit Denizli - Video Galerisi @endsection
@section('right') rightbar-hide @endsection
@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
                <li class="breadcrumb-item active" aria-current="page" title="App">Video Galerisi</li>
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
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header py-3 d-flex flex-wrap justify-content-between align-items-center bg-transparent border-bottom-0">
                        <h4 class="card-title m-0">Video Galerisi</h4>
                    </div>
                    <div class="card-body table-main-three">
                        <table class="myDataTable table table-hover table-bordered align-middle mb-0" style="width:100%">
                            <thead class="table-info">
                            <tr class="text-center" style="vertical-align: middle;">
                                <th>#</th>
                                <th>Video Adı</th>
                                <th>İşlem</th>
                            </tr>
                            </thead>
                            <tbody class="text-center" style="vertical-align: middle;">
                            @foreach($videos as $item)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.video.edit', $item->id) }}" class="btn btn-info btn-sm mt-1"><i class="fa fa-edit"></i></a>
                                        <button type="button" href="{{ route('admin.video.destroy', $item->id) }}" class="btn btn-danger btn-sm mt-1" id="delete"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header py-3 d-flex flex-wrap justify-content-between align-items-center bg-transparent border-bottom-0">
                        <h4 class="card-title m-0">Video Ekle</h4>
                    </div>
                    <form action="{{ route('admin.video.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label for="name" class="form-label"><strong>Video Adı (TR)<span class="text-danger">*</span></strong></label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Video Adı (TR)" value="{{ old('name') }}" required>
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 mt-3">
                                    <label for="name_en" class="form-label"><strong>Video Adı (EN)</strong></label>
                                    <input type="text" class="form-control" id="name_en" name="name_en" placeholder="Video Adı (EN)" value="{{ old('name_en') }}" >
                                    @error('name_en')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 mt-3">
                                    <label for="link" class="form-label"><strong>Video Linki</strong></label>
                                    <input type="text" class="form-control" id="link" name="link" placeholder="Video Linki" value="{{ old('link') }}" >
                                    @error('link')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 mt-3">
                                    <label for="status" class="form-label"><strong>Durum</strong></label>
                                    <div class="my-3">
                                        <input id="active" name="status" type="radio" value="1" class="form-check-input" checked="" required="">
                                        <label class="form-check-label" for="active">Açik</label>
                                        <input id="deactivate" name="status" type="radio" value="0" class="form-check-input" required="">
                                        <label class="form-check-label" for="deactivate">Kapalı</label>
                                    </div>
                                    @error('status')
                                    <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('panel/assets/js/code.js') }}"></script>
@endpush

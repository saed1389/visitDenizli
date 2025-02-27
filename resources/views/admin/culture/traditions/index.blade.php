@extends('admin.layouts.appAdmin')
@section('title') Visit Denizli - Gelenek ve Görenekler @endsection
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
                <li class="breadcrumb-item active" aria-current="page" title="App">Gelenek ve Görenekler</li>
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
                        <h4 class="card-title m-0">Gelenek ve Görenekler</h4>
                        <div class="form-check form-switch table-toggle-three">
                            <a href="{{ route('admin.traditions.create') }}" class="btn btn-secondary" >Gelenek ve Görenek Ekle</a>
                        </div>
                    </div>
                    <div class="card-body table-main-three">
                        <table class="myDataTable table table-hover table-bordered align-middle mb-0" style="width:100%">
                            <thead class="table-info">
                            <tr class="text-center" style="vertical-align: middle;">
                                <th>#</th>
                                <th>Resim</th>
                                <th>Gelenek ve Görenek adı</th>
                                <th>İlçe</th>
                                <th>Onayla</th>
                                <th>İşlem</th>
                            </tr>
                            </thead>
                            <tbody class="text-center" style="vertical-align: middle;">
                            @foreach($traditions as $item)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td><img src="{{ asset($item->image) }}" alt="" style="width: 70px;"></td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->county->name }}</td>
                                    <td class="text-center">
                                        <div class="form-check form-switch" style="justify-self: center;">
                                            <input class="form-check-input switch-input active" type="checkbox" @checked($item->status == 1) role="switch" value="{{ $item->id }}">
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.traditions.edit', $item->id) }}" class="btn btn-info btn-sm mt-1"><i class="fa fa-edit"></i></a>
                                        <button type="button" href="{{ route('admin.traditions.destroy', $item->id) }}" class="btn btn-danger btn-sm mt-1" id="delete"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
@endpush
@push('scripts')
    <script src="{{ asset('panel/assets/js/code.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function(){
            $(document).on('change', '.switch-input.active', function() {

                var check_active = $(this).is(':checked') ? 1 : 0;
                var check_id = $(this).val();

                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/admin/traditions/changeStatus/" + check_id + "/" + check_active,
                    data: { id: check_id, active: check_active },
                    success: function(response){
                        toastr.success("Durumu başarıyla değiştirildi!");
                    },
                    error: function(){
                        toastr.error("Bir hata oluştu!");
                    }
                });
            });
        });
    </script>
@endpush

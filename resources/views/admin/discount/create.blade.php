@extends('admin.layout.main')
@section('title', 'Trang thêm mã giảm giá')
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="bi bi-tag"></i>
                    </div>
                    <div>
                        Mã giảm giá
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.discount.store') }}">
                            @csrf
                            <div class="position-relative row form-group">
                                <label for="name" class="col-md-3 text-md-right col-form-label">Tên</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="name" id="name" placeholder="Tên mã giảm giá" type="text"
                                        class="form-control" value="{{ old('name') }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="code" class="col-md-3 text-md-right col-form-label">Mã giảm giá</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="code" id="code" placeholder="Mã giảm giá" type="text"
                                        class="form-control" value="{{ old('code') }}">
                                    @error('code')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="price" class="col-md-3 text-md-right col-form-label">Số tiền giảm</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="price" id="price" placeholder="Số tiền giảm" type="text"
                                        class="form-control" value="{{ old('price') }}">
                                    @error('price')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="begin" class="col-md-3 text-md-right col-form-label">Ngày bắt đầu</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="begin" id="begin"type="date" class="form-control" value="{{ old('begin') }}">
                                    @error('begin')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="end" class="col-md-3 text-md-right col-form-label">Ngày kết thúc</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="end" id="end" type="date" class="form-control" value="">
                                    @error('end')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="position-relative row form-group mb-1">
                                <div class="col-md-9 col-xl-8 offset-md-2">
                                    <a href="{{ route('admin.discount.index') }}"
                                        class="border-0 btn btn-outline-danger mr-1">
                                        <span class="btn-icon-wrapper pr-1 opacity-8">
                                            <i class="bi bi-x-circle-fill"></i>
                                        </span>
                                        <span>Quay lại</span>
                                    </a>

                                    <button type="submit" class="btn-shadow btn-hover-shine btn btn-primary">
                                        <span class="btn-icon-wrapper pr-2 opacity-8">
                                            <i class="bi bi-download"></i>
                                        </span>
                                        <span>Thêm mới</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->




@endsection

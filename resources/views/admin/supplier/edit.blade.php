@extends('admin.layout.main')
@section('title', 'Cập nhật thông tin')
@section('content')

    <div class="app-main__inner">

        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="bi bi-tag"></i>
                    </div>
                    <div>
                        Nhà Cung Cấp
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data"
                            action="{{ route('admin.supplier.update', $supplier->id) }}">
                            @method('PUT')
                            @csrf
                            <div class="position-relative row form-group">
                                <label for="name" class="col-md-3 text-md-right col-form-label">Tên</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="name" id="name" placeholder="Tên nhà cung cấp" type="text"
                                        class="form-control" value="{{ $supplier->name }}">
                                    <input name="id" id="name" placeholder="Name" type="hidden"
                                        class="form-control" value="{{ $supplier->id }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="email" class="col-md-3 text-md-right col-form-label">Email</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="email" id="email" placeholder="Email nhà cung cấp" type="email"
                                        class="form-control" value="{{ $supplier->email }}">
                                    <input name="id" id="email" type="hidden"
                                        class="form-control" value="{{ $supplier->id }}">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="phone" class="col-md-3 text-md-right col-form-label">Số Điện Thoại</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="phone" id="" placeholder="Số điện thoại" type="phone"
                                        class="form-control" value="0{{ $supplier->phone }}">
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>
                            <div class="position-relative row form-group">
                                <label for="address" class="col-md-3 text-md-right col-form-label">Địa Chỉ</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="address" id="address" placeholder="Địa chỉ" type="text"
                                        class="form-control" value="{{ $supplier->address }}">
                                    @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>
                            <div class="position-relative row form-group">
                                <label for="country" class="col-md-3 text-md-right col-form-label">Quốc Gia</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="country" id="country" placeholder="Quốc gia" type="text"
                                        class="form-control" value="{{ $supplier->country }}">
                                    @error('country')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="position-relative row form-group mb-1">
                                <div class="col-md-9 col-xl-8 offset-md-2">
                                    <a href="{{ route('admin.supplier.index') }}"
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
                                        <span>Cập nhật</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

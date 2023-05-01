@extends('admin.layout.main')
@section('title', 'Thay đổi mật khẩu')
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.update_pass') }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="position-relative row form-group">
                                <label for="password" class="col-md-3 text-md-right col-form-label">Mật khẩu mới</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="password" id="name" placeholder="Mật khẩu mới" type="password"
                                        class="form-control" value="">
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="name" class="col-md-3 text-md-right col-form-label">Xác nhận mật khẩu
                                    mới</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="password_confirmation" id="name" placeholder="Nhập lại khẩu mới"
                                        type="password" class="form-control" value="">
                                    @error('password_confirmation')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="position-relative row form-group mb-1">
                                <div class="col-md-9 col-xl-8 offset-md-2">
                                    <a href="{{ route('admin.index') }}" class="border-0 btn btn-outline-danger mr-1">
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
    <!-- End Main -->




@endsection

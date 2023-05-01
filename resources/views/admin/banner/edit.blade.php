@extends('admin.layout.main')
@section('title', 'Cập nhật banner')
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="bi bi-tag"></i>
                    </div>
                    <div>
                        Banner
                        <div class="page-title-subheading">
                            View, create, update, delete and manage.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.banner.update', $banner->id) }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="position-relative row form-group">
                                <label for="name" class="col-md-3 text-md-right col-form-label">Têm banner</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="name" id="name" placeholder="Name" type="text"
                                        class="form-control" value="{{ $banner->name }}">
                                    <input name="id" id="name" placeholder="Name" type="hidden"
                                        class="form-control" value="{{ $banner->id }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="file" class="col-md-3 text-md-right col-form-label">Hình ảnh</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="file" id="file" placeholder="image" type="file" class=""
                                        value="">
                                    <div class="widget-content-left mt-3 ">
                                        <img class="img-thumbnail" style="height: 300px;" data-toggle="tooltip"
                                            title="Image" data-placement="bottom"
                                            src="{{ asset('storage/Banner' . '/' . $banner->img[0]->path) }}"
                                            alt="">
                                    </div>
                                    @error('file')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="index" class="col-md-3 text-md-right col-form-label">Số thứ tự</label>
                                <div class="col-md-9 col-xl-8">

                                    <select name="index" id="index" class="form-control">
                                        <option value="">Chọn</option>
                                        <option {{ $banner->index === 1 ? 'selected' : '' }} value="1">1</option>
                                        <option {{ $banner->index === 2 ? 'selected' : '' }} value="2">2</option>
                                        <option {{ $banner->index === 3 ? 'selected' : '' }} value="3">3</option>
                                    </select>
                                    <select hidden name="id" id="index" class="form-control">
                                        <option hidden value="{{ $banner->id }}"></option>
                                    </select>
                                    @error('index')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="status" class="col-md-3 text-md-right col-form-label">Trạng thái</label>
                                <div class="col-md-9 col-xl-8">
                                    <select name="status" id="status" class="form-control">
                                        <option value="">Chọn</option>
                                        <option {{ $banner->status == 0 ? 'selected' : '' }} value="0">Chờ Duyệt
                                        </option>
                                        <option {{ $banner->status == 1 ? 'selected' : '' }} value="1">Công khai
                                        </option>
                                    </select>
                                    @error('status')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>


                            <div class="position-relative row form-group mb-1">
                                <div class="col-md-9 col-xl-8 offset-md-2">
                                    <a href="{{ route('admin.banner.index') }}"
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
    <!-- End Main -->




@endsection

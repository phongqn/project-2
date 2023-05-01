@extends('admin.layout.main')
@section('title', 'Trang thêm danh mục')
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="bi bi-tag"></i>
                    </div>
                    <div>
                        Brand
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
                        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.category.store') }}">
                            @csrf
                            <div class="position-relative row form-group">
                                <label for="name" class="col-md-3 text-md-right col-form-label">Tên</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="name" id="name" placeholder="Name" type="text"
                                        class="form-control" value="">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="product_category_id" class="col-md-3 text-md-right col-form-label">Parent
                                    Floder</label>
                                <div class="col-md-9 col-xl-8">
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="0">Danh mục</option>
                                        {!! dataTree($list_categories, 0, intval(old('category_id')), 0, 0, 0) !!}
                                    </select>
                                    @error('category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="position-relative row form-group mb-1">
                                <div class="col-md-9 col-xl-8 offset-md-2">
                                    <a href="{{ route('admin.category.index') }}"
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

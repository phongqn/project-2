@extends('admin.layout.main')
@section('title', 'Danh sách nhà cung cấp')
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

                <div class="page-title-actions">
                    <a href="{{ route('admin.supplier.create') }}" class="btn-shadow btn-hover-shine mr-3 btn btn-primary">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="bi bi-plus-circle-fill"></i>
                        </span>
                        Tạo mới
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">

                    <div class="card-header">

                        <form>
                            <div class="input-group">
                                <input type="search" name="q" id="search" placeholder="Tìm Nhà Cung Cấp"
                                    class="form-control" value="{{ request()->input('q') }}">
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-search"></i>&nbsp;
                                        Tìm Kiếm
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="">STT</th>
                                    <th class="">Tên</th>
                                    <th class="">Email</th>
                                    <th class="">Số Điện Thoại</th>
                                    <th class="">Địa Chỉ</th>
                                    <th class="">Quốc Gia</th>
                                    <th class="">Quản lý</th>
                                </tr>
                            </thead>

                            @php
                                $t = 0;
                            @endphp
                            @if ($list_suppliers->total() > 0)
                                @foreach ($list_suppliers as $supplier)
                                    @php $t++; @endphp
                                    <tbody>
                                        <tr>
                                            <td class=" text-muted">{{ $t }}</td>
                                            <td>
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left mr-3">
                                                            <div class="widget-content-left">
                                                                <img width="40" class="rounded-circle"
                                                                    data-toggle="tooltip" title="Image"
                                                                    data-placement="bottom"
                                                                    src="assets/images/_default-user.png" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="widget-content-left flex2">
                                                            <div class="widget-heading">{{ $supplier->name }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="">{{ $supplier->email }}</td>
                                            <td class="">
                                                0{{ $supplier->phone }}
                                            </td>
                                            <td class="">
                                                {{ $supplier->address }}
                                            </td>
                                            <td class="">
                                                {{ $supplier->country }}
                                            </td>

                                            <td class="">

                                                <a href="{{ route('admin.supplier.edit', $supplier->id) }}"
                                                    data-toggle="tooltip" title="Edit" data-placement="bottom"
                                                    class="btn btn-outline-warning border-0 btn-sm">
                                                    <span class="btn-icon-wrapper opacity-8">
                                                    <i class="bi bi-pencil-square"></i>
                                                    </span>
                                                </a>
                                                <form class="d-inline"
                                                    action="{{ route('admin.supplier.destroy', $supplier->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('Delete')
                                                    <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm"
                                                        type="submit" data-toggle="tooltip" title="Delete"
                                                        data-placement="bottom"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xoá bản ghi này chứ ?')">
                                                        <span class="btn-icon-wrapper opacity-8">
                                                        <i class="bi bi-trash3-fill"></i>
                                                        </span>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="text-center">Không tìm thấy bản ghi nào !</td>
                                </tr>
                            @endif
                        </table>
                    </div>

                    <div class="d-block card-footer">
                        {{ $list_suppliers->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

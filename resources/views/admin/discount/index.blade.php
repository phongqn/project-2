@extends('admin.layout.main')
@section('title', 'Trang danh sách mã giảm giá')
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

            <div class="page-title-actions">
                <a href="{{ route('admin.discount.create') }}" class="btn-shadow btn-hover-shine mr-3 btn btn-primary">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="bi bi-plus-circle-fill"></i>
                    </span>
                    Thêm mới
                </a>
            </div>
            <div class="">
                <a href="{{ route('admin.discount.registered_user') }}" class="btn-shadow btn-hover-shine mr-3 btn btn-primary">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="bi bi-card-list"></i>
                    </span>
             Danh sách người đăng kí
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">

                <div class="card-header">

                    <form action="#">
                        <div class="input-group">
                            <input type="search" name="q" id="search" placeholder="Tìm kiếm phiếu giảm giá" class="form-control" value="{{ request()->input('q') }}">

                            <span class="input-group-append">
                                <button type="submit" class="btn btn-primary" name="btn-search">
                                    <i class="bi bi-search"></i>
                                    Search
                                </button>
                            </span>
                        </div>
                    </form>
                </div>

                <div class="table-responsive">

                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">STT</th>
                                <th>Tên</th>
                                <th>Mã giảm giá</th>
                                <th>Số tiền giảm</th>
                                <th>Ngày bắt đầu</th>
                                <th>Ngày kết thúc</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        @php
                        $index = 0;
                        @endphp
                        @if ($list_discounts->total() > 0)
                        @foreach ($list_discounts as $discount)
                        @php $index++; @endphp
                        <tbody>
                            <tr>
                                <td class="text-center text-muted">{{ $index }}</td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading">{{ $discount->name }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading">{{ $discount->code }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading">
                                                    {{ number_format($discount->price, 0, 0, ',') }}đ
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading">{{ $discount->begin }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading">{{ $discount->end }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </td>


                                <td class="text-center">
                                    <a href="{{ route('admin.discount.edit', $discount->id) }}" data-toggle="tooltip" title="Edit" data-placement="bottom" class="btn btn-outline-warning border-0 btn-sm">
                                        <span class="btn-icon-wrapper opacity-8">
                                            <i class="bi bi-pencil-square"></i>
                                        </span>
                                    </a>

                                    <form class="d-inline" action=" {{ route('admin.discount.send_mail', $discount->id) }}" method="POST">
                                        @method('Delete')
                                        @csrf
                                        <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm" type="submit" data-toggle="tooltip" title="Delete" data-placement="bottom" onclick="return confirm('Bạn có chắc chắn xoá bản ghi này chứ ?')">
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
                            <td colspan="8" class="text-center">Không tìm thấy bản ghi nào</td>
                        </tr>
                        @endif
                    </table>
                </div>

                <div class="d-block card-footer">
                    {{-- {{ $list_brands->links() }} --}}
                </div>

            </div>
        </div>
    </div>
</div>
<!-- End Main -->




@endsection
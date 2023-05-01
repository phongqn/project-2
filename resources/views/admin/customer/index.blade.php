@extends('admin.layout.main')
@section('title', 'Trang danh sách khách hàng')
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="bi bi-tag"></i>
                    </div>
                    <div>
                        Khách hàng
                    </div>
                </div>
                <div class="page-title-actions">
                    <a href="{{ route('admin.customer.export') }}" class="btn-shadow btn-hover-shine mr-3 btn btn-primary">
                        Xuất danh sách
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
                                <input type="search" name="q" id="search" placeholder="Tìm kiếm khách hàng"
                                    class="form-control" value="{{ request()->input('q') }}">

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
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Quận/Huyện</th>
                                    <th>Thành phố</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                            </thead>
                            @php
                                $index = 0;
                            @endphp
                            @if ($list_customers->total() > 0)
                                @foreach ($list_customers as $item)
                                    @php $index++; @endphp
                                    <tbody>
                                        <tr>
                                            <td class="text-center text-muted">{{ $index }}</td>
                                            <td>
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left flex2">
                                                            <div class="widget-heading">{{ $item->name }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left flex2">
                                                            <div class="widget-heading">{{ $item->email }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left flex2">
                                                            <div class="widget-heading">
                                                                0{{ $item->phone }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left flex2">
                                                            <div class="widget-heading">{{ $item->address }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left flex2">
                                                            <div class="widget-heading">{{ $item->district }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left flex2">
                                                            <div class="widget-heading">{{ $item->city }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>


                                            <td class="text-center">
                                                <form class="d-inline" action="" method="POST">
                                                    @method('Delete')
                                                    @csrf
                                                    <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm"
                                                        type="submit" data-toggle="tooltip" title="Delete"
                                                        data-placement="bottom"
                                                        onclick="return confirm('Bạn có chắc chắn xoá bản ghi này và xoá luôn tài khoản chứ ?')">
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

@extends('admin.layout.main')
@section('title', 'Trang danh sách người dùng đã đăng kí')
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="bi bi-tag"></i>
                    </div>
                    <div>
                        Danh sách người dùng đã đăng kí
                    </div>
                </div>
                <div class="page-title-actions">
                    <a href="{{ route('admin.discount.send_all') }}" class="btn-shadow btn-hover-shine mr-3 btn btn-primary">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="bi bi-card-list"></i>
                        </span>
                        Gửi tất cả
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">

                    <div class="card-header">
                    </div>

                    <div class="table-responsive">

                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">STT</th>
                                    <th>Tên người dùng</th>
                                    <th>Email người dùng</th>
                                    <th>Tên phiếu giảm giá</th>
                                    <th>Số tiền giảm</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                            </thead>
                            @php
                                $index = 0;
                            @endphp
                            @foreach ($user_registers as $item)
                                @php $index++; @endphp
                                <tbody>
                                    <tr>
                                        <td class="text-center text-muted">{{ $index }}</td>
                                        <td>
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left flex2">
                                                        <div class="widget-heading">{{ $item->user->name }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left flex2">
                                                        <div class="widget-heading">{{ $item->user->email }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left flex2">
                                                        <div class="widget-heading">{{ $item->discount->name }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left flex2">
                                                        <div class="widget-heading">
                                                            {{ number_format($item->discount->price, 0, 0, ',') }}đ
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <form class="d-inline" action=" {{ route('admin.discount.send_mail') }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="userDiscount" value="{{ $item }}">
                                                <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm"
                                                    type="submit" data-toggle="tooltip" title="Gửi mail"
                                                    data-placement="bottom">
                                                    <span class="btn-icon-wrapper opacity-8">
                                                        <i class="bi bi-envelope-check"></i>
                                                    </span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->




@endsection

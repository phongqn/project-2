@extends('admin.layout.main')
@section('title', 'Trang thông tin cửa hàng')
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="bi bi-tag"></i>
                    </div>
                    <div>
                        Thông tin cửa hàng
                    </div>
                </div>

                <div class="page-title-actions">
                    <a href="{{ route('admin.notification.edit') }}" class="btn-shadow btn-hover-shine mr-3 btn btn-primary">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                        </span>
                        Sửa thông tin cửa hàng
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">

                    <div class="table-responsive">

                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <tbody style="width:30%">
                                <tr>
                                    <td>Tên cửa hàng</td>
                                    <td>{{ $notification[0]->name }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{ $notification[0]->email }}</td>
                                </tr>
                                <tr>
                                    <td>Số điện thoại</td>
                                    <td>0{{ $notification[0]->phone }}</td>
                                </tr>
                                <tr>
                                    <td>Địa chỉ</td>
                                    <td>{{ $notification[0]->address }}</td>
                                </tr>
                                <tr>
                                    <td style="width:30%">Bản đồ</td>
                                    <td> {!! $notification[0]->map !!}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->




@endsection

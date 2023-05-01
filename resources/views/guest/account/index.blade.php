@extends('layouts.master')
@push('css')
    <style>
        .modal-dialog {
            max-width: 800px !important;
        }

        .table td {
            padding: 20px 5px 5px 5px !important;
        }
    </style>
@endpush
@section('content')
    @php
        use App\Enums\StatusOrderEnum;
    @endphp
    <div class="container light-style flex-grow-1 container-p-y">

        <h4 class="font-weight-bold py-3 mb-4">
            Hồ sơ của tôi
        </h4>
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list"
                            href="#account-general">Thông
                            tin</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#buy-history">Lịch sử mua
                            hàng</a>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="tab-content">


                        <div class="tab-pane fade active show" id="account-general">
                            <div class="card-body">
                                <form method="POST" action="{{ route('guest.account.update') }}">

                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label class="form-label">Name</label>
                                        <input disabled type="text" class="form-control mb-1" name="name"
                                            value="{{ $customer ? $customer->name : '' }}">

                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Email</label>
                                        <input disabled type="text" class="form-control" name="email"
                                            value="{{ $customer ? $customer->email : '' }}">

                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Số Điện Thoại</label>
                                        <input type="number" class="form-control" name="phone"
                                            value="0{{ $customer ? $customer->phone : '' }}">
                                        @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Địa Chỉ</label>
                                        <input type="text" class="form-control" name="address"
                                            value="{{ $customer ? $customer->address : '' }}">
                                        @error('address')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Huyện/Quận</label>
                                        <input type="text" class="form-control" name="district"
                                            value="{{ $customer ? $customer->district : '' }}">
                                        @error('district')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Thành Phố</label>
                                        <input type="text" class="form-control" name="city"
                                            value="{{ $customer ? $customer->city : '' }}">
                                        @error('city')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-5">
                                        <label class="form-label">Quốc Gia</label>
                                        <input type="text" class="form-control" name="country"
                                            value="{{ $customer ? $customer->country : '' }}">
                                        @error('country')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="text-right mt-3 mb-4" style="margin-right: 20px">
                                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="buy-history">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Ngày đặt</th>
                                        <th scope="col">Thành tiền</th>
                                        <th scope="col">Trạng thái đơn hàng</th>
                                        <th scope="col">Trạng thái thanh toán</th>
                                        <th scope="col">Vận chuyển</th>
                                        <th scope="col">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $index = 0;
                                    @endphp
                                    @forelse ($listOrder as $item)
                                        <tr class="item-order">
                                            <td class="text-center" scope="row">{{ ++$index }}</td>
                                            <td class="text-center">{{ date('d-m-Y', strtotime($item['created_at'])) }}
                                            </td>
                                            <td class="text-center">{{ number_format($item['total_price']) }} đ</td>
                                            <td class="status text-center">{{ StatusOrderEnum::getName($item['status']) }}
                                            </td>
                                            <td class="text-center">
                                                @if ($item['payment_method'] == 2 || ($item['payment_method'] && $item['status'] == StatusOrderEnum::RECEIVED))
                                                    Đã thanh toán
                                                @else
                                                    Chưa thanh toán
                                                @endif
                                            </td>
                                            <td class="text-center">{{ number_format($item['price_ship']) }} đ</td>
                                            <td class="d-flex justify-content-center text-center">
                                                <li class="list-inline-item icon-trash">
                                                    <a class="btn btn-warning btn-sm rounded-0 detail"
                                                        data-id="{{ $item['id'] }}" data-toggle="modal"
                                                        data-target="#modalDetail" data-original-title="Sửa"><i
                                                            class="fa fa-eye"></i></a>
                                                </li>

                                                {{-- <a class="btn detail icon-action" data-id="{{ $item['id'] }}"
                                                    data-toggle="modal" data-target="#modalDetail"
                                                    data-original-title="Xem chi tiết"><i class="fas fa-eye text-primary mr-1 "></a></td>
                                                    data-original-title="Sửa">
                                                    <i class="fas fa-eye text-primary">
                                                    </i>
                                                </a> --}}
                                                @if (
                                                    $item['status'] != StatusOrderEnum::CANCELED &&
                                                        $item['payment_method'] != 2 &&
                                                        !($item['payment_method'] && $item['status'] == StatusOrderEnum::RECEIVED))
                                                    <li class="list-inline-item icon-trash">
                                                        <a class="btn btn-danger btn-sm rounded-0 cancel icon-action"
                                                            data-id="{{ $item['id'] }}" data-toggle="tooltip"
                                                            data-placement="top" title="cancel"><i
                                                                class="fa fa-trash"></i></a>
                                                    </li>
                                                    {{-- <a class="btn cancel icon-action" data-id="{{ $item['id'] }}"><i
                                                            class="fas fa-trash text-primary">
                                                        </i></a> --}}
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('modal')
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Chi tiết</h5>
                    <button type="button" id="closeColor" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="modal-body" id="formcolor" action="{{ route('admin.product.product_color.store') }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name='product_size_id' id="productid">
                    <div class="container-fluid row mb-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Ảnh</th>
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Kích cỡ</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Đơn giá</th>
                                </tr>
                            </thead>
                            <tbody class="list-detail">

                            </tbody>
                        </table>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary closetype" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
@endpush
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.28/dist/sweetalert2.all.min.js"></script>
    @include('guest.includes.script_account')
@endpush

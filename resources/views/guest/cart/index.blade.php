@extends('layouts.master')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    @php
        use App\Enums\TypeSizeEnum;
    @endphp
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Shopping Cart</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shopping Cart</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Kích thước</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @forelse ($listCart as $item)
                            <tr class="item">
                                <td class="align-middle d-flex"><img
                                        src="{{ asset('storage/ProductSize' . '/' . $item['product_color']['product_size']['img'][0]['path']) }}"
                                        alt="" style="width: 50px;">
                                    {{ $item['product_color']['product_size']['product']['name'] }}</td>
                                <td class="align-middle">
                                    {{ $item['product_color']['product_size']['size'] }}
                                    {{ TypeSizeEnum::getName($item['product_color']['product_size']['type_size']) }}</td>
                                <td class="align-middle">
                                    {{ number_format($item['product_color']['product_size']['price_sell'], 0, ',', ',') }} đ
                                </td>
                                <td class="align-middle update-quantity">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" data-id="{{ $item['id'] }}" data-old={{ $item['quantity'] }}
                                            data-quantityinstock="{{ $item['product_color']['quantity'] }}"
                                            class="form-control form-control-sm bg-secondary text-center quantity-input"
                                            value="{{ $item['quantity'] }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle total-price">
                                    {{ number_format($item['quantity'] * $item['product_color']['product_size']['price_sell'], 0, ',', ',') }}
                                    đ</td>
                                <td class="align-middle"><button class="btn btn-sm btn-primary remove"
                                        data-id="{{ $item['id'] }}"><i class="fa fa-times"></i></button></td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                {{-- <div class="mb-5">
                    <div class="input-group">
                        <input type="text" class="form-control p-4 discount-code" name="discountCode"
                            placeholder="Coupon Code" value="{{ $discountCode }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary apply-discount" type="button">Apply Coupon</button>
                        </div>
                    </div>
                </div> --}}
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Đơn giá giỏ hàng</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Tổng tiền sản phẩm</h6>
                            <h6 class="font-weight-medium subtotal">{{ number_format($totalPrice, 0, ',', ',') }} đ</h6>
                        </div>
                        {{-- <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Phí vận chuyển</h6>
                            <input type="hidden" name="ship" value="20000">
                            <h6 class="font-weight-medium">{{ number_format(20000, 0, ',', ',') }} đ</h6>
                        </div> --}}
                        {{-- <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Giảm giá</h6>
                            <input type="hidden" id="isDiscount" name="isdiscount" value="0">
                            <h6 class="font-weight-medium discount-price">{{ $discountPrice }}</h6>
                        </div> --}}
                    </div>
                    <form method="GET" action="{{ route('guest.cart.check_out') }}"
                        class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Tổng cộng</h5>
                            <h5 class="font-weight-bold total-price-cart">
                                {{ number_format($totalPrice, 0, ',', ',') }} đ</h5>
                        </div>
                        <button {{ $totalPrice ? '' : 'disabled' }}
                            class="btn btn-block btn-primary my-3 py-3 checkout">Check
                            Out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.28/dist/sweetalert2.all.min.js"></script>
    @include('guest.includes.script_cart')
@endpush

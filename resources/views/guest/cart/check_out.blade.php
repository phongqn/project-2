@extends('layouts.master')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2 {
            width: 100% !important;
        }

        .select2-selection {
            height: calc(1.5em + 0.75rem + 2px) !important;
        }

        .error {
            color: red !important;
        }

        /* .payment-error {
                                    margin-left: 20px;
                                } */
    </style>
@endpush
@php
    use App\Enums\TypeSizeEnum;
    use App\Enums\PayMentMethodEnum;
@endphp
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Checkout</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Checkout</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Checkout Start -->
    <div class="container-fluid pt-5">
        @if (\Session::has('error'))
            <div class="alert alert-danger">
                <ul>
                    <li>{!! \Session::get('error') !!}</li>
                </ul>
            </div>
        @endif
        <form action="{{ route('guest.order.create') }}" method="POST" id="formdata"
            class="row justify-content-center px-xl-5">
            @csrf
            {{-- {{ route('guest.order.create') }} --}}
            <div class="col-lg-6">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Thông tin đơn hàng</h4>
                    <div class="row">
                        <div class="col-12 form-group">
                            <label>Tên</label>
                            <input class="form-control" type="text" name="name" placeholder="Tên của bạn"
                                value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <div class="text-danger">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="col-12 form-group">
                            <label>Số điện thoại</label>
                            <input class="form-control" type="text" name="phone" placeholder="Số điện thoại"
                                value="{{ old('phone') }}">
                            @if ($errors->has('phone'))
                                <div class="text-danger">{{ $errors->first('phone') }}</div>
                            @endif
                        </div>
                        <div class="col-12 form-group">
                            <label>Thành phố</label>
                            <select class="form-control city" name="city"></select>
                            @if ($errors->has('city'))
                                <div class="text-danger">{{ $errors->first('city') }}</div>
                            @endif
                        </div>
                        <div class="col-12 form-group">
                            <label>Quận/Huyện</label>
                            <select class="form-control district" name="district"></select>
                            @if ($errors->has('district'))
                                <div class="text-danger">{{ $errors->first('district') }}</div>
                            @endif
                        </div>
                        <div class="col-12 form-group">
                            <label>Địa chỉ</label>
                            <input class="form-control" type="text" name="address" placeholder="Địa chỉ cụ thể"
                                value="{{ old('address') }}">
                            @if ($errors->has('address'))
                                <div class="text-danger">{{ $errors->first('address') }}</div>
                            @endif
                        </div>
                        <div class="col-12 form-group">
                            <label>E-mail</label>
                            <input class="form-control" type="text" name="email" placeholder="example@email.com"
                                value="{{ old('emai') }}">
                            @if ($errors->has('email'))
                                <div class="text-danger">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                        <div class="col-12 form-group">
                            <label>Quốc gia</label>
                            <input class="form-control" type="text" name="country" placeholder="Quốc gia"
                                value="{{ old('country') }}">
                            @if ($errors->has('country'))
                                <div class="text-danger">{{ $errors->first('country') }}</div>
                            @endif
                        </div>
                        <div class="col-12 form-group">
                            <label>Mô tả</label>
                            <textarea class="form-control" name='note' placeholder="Vd: lời nhắn gửi cho chủ shop ..."
                                value="{{ old('note') }}"></textarea>
                            @if ($errors->has('note'))
                                <div class="text-danger">{{ $errors->first('note') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">

                <div class="mb-5">
                    <div class="input-group">
                        <input type="text" class="form-control p-4 discount-code" name="discountCode"
                            placeholder="Coupon Code" value="{{ $discountCode }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary apply-discount" type="button">Apply Coupon</button>
                        </div>
                    </div>
                </div>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Order Total</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Products</h5>
                        @forelse ($listCart as $item)
                            <div class="d-flex justify-content-between">
                                <p> {{ $item['product_color']['product_size']['product']['name'] }}</p>
                                <p> {{ $item['product_color']['product_size']['size'] }}
                                    {{ TypeSizeEnum::getName($item['product_color']['product_size']['type_size']) }}</p>
                                <p>{{ number_format($item['quantity'] * $item['product_color']['product_size']['price_sell'], 0, ',', ',') }}
                                    đ</p>
                            </div>
                        @empty
                        @endforelse
                        <hr class="mt-0">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium">{{ number_format($totalPrice, 0, ',', ',') }} đ</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <input type="hidden" name="price_ship" value="{{ $ship }}" id="">
                            <h6 class="font-weight-medium">{{ number_format($ship, 0, ',', ',') }} đ</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Giảm giá</h6>
                            <input type="hidden" name="discount_code" id="discountCode">
                            <h6 class="font-weight-medium discount-price">{{ $discountPrice }}</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold total-price">
                                {{ number_format($totalPrice - $discountPrice + 20000, 0, ',', ',') }} đ
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Payment</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input payment" name="payment_method"
                                    value={{ PayMentMethodEnum::VNPAY }} id="vnpay">
                                <label class="custom-control-label" for="vnpay">Paypal</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input payment"
                                    name="payment_method"value={{ PayMentMethodEnum::DIRECT }} id="directcheck">
                                <label class="custom-control-label" for="directcheck">Direct Check</label>
                            </div>
                        </div>

                        @if ($errors->has('payment_method'))
                            <div class="error payment-error">{{ $errors->first('payment_method') }}</div>
                        @endif
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <button class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3 place-order">Thanh toán
                            khi nhận</button>
                        <div>
                            {{-- @csrf --}}
                            <button type="submit"
                                class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3 vnpay d-none"
                                name="redirect">VN
                                PAY</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Checkout End -->
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.28/dist/sweetalert2.all.min.js"></script>
    @include('guest.includes.script_checkout')
@endpush

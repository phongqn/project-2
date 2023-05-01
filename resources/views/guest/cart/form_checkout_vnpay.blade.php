@extends('layouts.master')
@section('content')
    <div class="container-fluid pt-5">
        <form action="{{ route('vn_pay') }}" method="POST" class="row px-xl-5">
            @csrf
            {{-- {{ route('guest.order.create') }} --}}
            <div class="col-lg-8">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Thông tin đơn hàng</h4>
                    <div class="row">
                        <div class="col-6 form-group">
                            <label>Tên</label>
                            <input class="form-control" type="text" name="name" placeholder="John"
                                value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <div class="error">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="col-6 form-group">
                            <label>Số điện thoại</label>
                            <input class="form-control" type="text" name="phone" placeholder="Doe"
                                value="{{ old('phone') }}">
                            @if ($errors->has('phone'))
                                <div class="error">{{ $errors->first('phone') }}</div>
                            @endif
                        </div>
                        <div class="col-6 form-group">
                            <label>Thành phố</label>
                            <select class="form-control city" name="city"></select>
                            @if ($errors->has('city'))
                                <div class="error">{{ $errors->first('city') }}</div>
                            @endif
                        </div>
                        <div class="col-6 form-group">
                            <label>Quận/Huyện</label>
                            <select class="form-control district" name="district"></select>
                            @if ($errors->has('district'))
                                <div class="error">{{ $errors->first('district') }}</div>
                            @endif
                        </div>
                        <div class="col-6 form-group">
                            <label>Địa chỉ</label>
                            <input class="form-control" type="text" name="address" placeholder="Địa chỉ"
                                value="{{ old('address') }}">
                            @if ($errors->has('address'))
                                <div class="error">{{ $errors->first('address') }}</div>
                            @endif
                        </div>
                        <div class="col-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" type="text" name="email" placeholder="example@email.com"
                                value="{{ old('emai') }}">
                            @if ($errors->has('email'))
                                <div class="error">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                        <div class="col-6 form-group">
                            <label>Quốc gia</label>
                            <input class="form-control" type="text" name="country" placeholder="Quốc gia"
                                value="{{ old('country') }}">
                            @if ($errors->has('country'))
                                <div class="error">{{ $errors->first('country') }}</div>
                            @endif
                        </div>
                        <div class="col-6 form-group">
                            <label>Mô tả</label>
                            <textarea class="form-control" name='note' placeholder="Mô tả" value="{{ old('note') }}">
                            </textarea>
                            @if ($errors->has('note'))
                                <div class="error">{{ $errors->first('note') }}</div>
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
                                <input type="radio" class="custom-control-input" name="payment_method"
                                    value={{ PayMentMethodEnum::VNPAY }} id="paypal">
                                <label class="custom-control-label" for="paypal">VNPAY</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input"
                                    name="payment_method"value={{ PayMentMethodEnum::DIRECT }} id="directcheck">
                                <label class="custom-control-label" for="directcheck">Thanh toán tại nhà</label>
                            </div>
                        </div>
                    </div>
                    @if ($errors->has('payment_method'))
                        <div class="error">{{ $errors->first('payment_method') }}</div>
                    @endif
                    <div class="card-footer border-secondary bg-transparent">
                        <button class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Place Order</button>
                        <div>
                            {{-- @csrf --}}
                            <button type="submit" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3"
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

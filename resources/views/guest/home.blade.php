@extends('layouts.master')
@push('css')
    <style>
        .img-product {
            height: 15rem;
        }
    </style>
@endpush
@section('slide')
    <div id="header-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach ($list_banners as $item)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}" style="height: 410px;">
                    <img class="img-fluid" src="{{ asset('storage/Banner' . '/' . $item->path) }}" alt="Image">
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-prev-icon mb-n2"></span>
            </div>
        </a>
        <a class="carousel-control-next" href="#header-carousel" data-slide="next">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-next-icon mb-n2"></span>
            </div>
        </a>
    </div>
@endsection
@section('content')
    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Sản phẩm chất lượng</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Giao hàng miễn phí</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">14 ngày trả hàng miễn phí</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Hỗ trợ 24/7</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured End -->
    <!-- Products Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Sản phẩm nổi bật</span></h2>
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="row px-xl-5 pb-3">

            @foreach ($listOutstanding as $product)
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">

                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100 img-product"
                                src="{{ asset('storage/Product' . '/' . $product['img'][0]['path']) }}" alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">{{ $product['name'] }}</h6>
                            <div class="d-flex justify-content-center">
                                <h6>{{ number_format($product['ProductSize'][0]['price_sell'], 0, ',', ',') }}đ</h6>
                            </div>
                        </div>

                        {{-- @dd($product['ProductSize'][0]['price_sell']) --}}
                        <div class="card-footer d-flex justify-content-between bg-light border">

                            <a href="{{ route('guest.detail', ['slug' => $product['slug'], 'size' => $product['ProductSize'][0]['size'], 'type' => $product['ProductSize'][0]['type_size']]) }}"
                                class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Xem chi tiết
                            </a>
                            <form action="{{ route('guest.liked.add_product') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product['id'] }}">
                                <button type="submit" class="btn btn-sm text-dark p-0"><i
                                        class="fas fa-solid fa-heart text-primary mr-1"></i>Thêm vào yêu thích</button>
                            </form>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

    </div>
    <!-- Products End -->
    <!-- Products Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Sản phẩm bán chạy</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
            @foreach ($listSelling as $product)
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">

                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100 img-product"
                                src="{{ asset('storage/Product' . '/' . $product['img'][0]['path']) }}" alt="">

                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">{{ $product['name'] }}</h6>
                            <div class="d-flex justify-content-center">

                                <h6>{{ number_format($product['ProductSize'][0]['price_sell'], 0, ',', ',') }}đ</h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="{{ route('guest.detail', ['slug' => $product['slug'], 'size' => $product['ProductSize'][0]['size'], 'type' => $product['ProductSize'][0]['type_size']]) }}"
                                class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Xem chi tiết
                            </a>
                            <form action="{{ route('guest.liked.add_product') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product['id'] }}">
                                <button type="submit" class="btn btn-sm text-dark p-0"><i
                                        class="fas fa-solid fa-heart text-primary mr-1"></i>Thêm vào yêu thích</button>
                            </form>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
    <!-- Products End -->


    <!-- Vendor Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel vendor-carousel">
                    {{-- brands --}}
                    @foreach ($list_brands as $item)
                        <div class="vendor-item border p-4">
                            <img style="height:70px" src="{{ asset('storage/Brand' . '/' . $item->path) }}"
                                alt="">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor End -->
@endsection

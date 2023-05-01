@extends('layouts.master')
@push('css')
    @section('content')
        <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="col-12">
                    <nav class="breadcrumb bg-light mb-30">
                        <a class="breadcrumb-item text-dark" href="{{ route('guest.index') }}">Trang chủ</a>
                        <span class="breadcrumb-item active">Hướng dẫn mua hàng</span>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container-fluid">

            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Hướng dẫn mua
                    hàng trên website</span></h2>
            <div class="row px-xl-5">
                <div class="col-lg-7 mb-5">
                    <div class="contact-form bg-light p-30">
                        <p>Nhằm giúp khách hàng thuận lợi hơn trong mua sắm, nay Merriman ra mắt hình thức ĐẶT HÀNG ONLINE TRÊN
                            WEBSITE, dưới đây là hướng dẫn những bước cơ bản để quý khách hàng có thể mua hàng online một cách
                            dễ dàng.</p>
                    </div>

                </div>
            </div>
        @endsection

@extends('layouts.master')
@push('css')
    @section('content')
        <!-- Breadcrumb Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="col-12">
                    <nav class="breadcrumb bg-light mb-30">
                        <a class="breadcrumb-item text-dark" href="{{ route('guest.index') }}">Trang chủ</a>
                        <span class="breadcrumb-item active">Giới thiệu</span>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Breadcrumb End -->


        <!-- Contact Start -->
        <div class="container-fluid">

            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Giới thiệu về
                    Everything Store</span></h2>
            <div class="row px-xl-5">
                <div class="col-lg-7 mb-5">
                    <div class="contact-form bg-light p-30">

                    </div>

                </div>
            </div>
            <!-- Contact End -->
        @endsection

@extends('layouts.master')
@push('css')
    @section('content')
        <!-- Breadcrumb Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="col-12">
                    <nav class="breadcrumb bg-light mb-30">
                        <a class="breadcrumb-item text-dark" href="{{ route('guest.index') }}">Trang chủ</a>
                        <span class="breadcrumb-item active">Liên hệ</span>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Breadcrumb End -->


        <!-- Contact Start -->
        <div class="container-fluid">
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
            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Kết Nối
                    Với
                    Chúng Tôi</span></h2>
            <div class="row px-xl-5">
                <div class="col-lg-7 mb-5">
                    <div class="contact-form bg-light p-30">
                        <div id="success"></div>
                        <p class="help-block text-danger">

                        </p>
                        <form name="sentMessage" id="contactForm" action="{{ route('guest.contact.send_message') }}"
                            novalidate="novalidate" method="POST">
                            @csrf
                            <div class="control-group" style="margin-bottom:10px">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Tên của bạn" data-validation-required-message="Please enter your name" />
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="control-group" style="margin-bottom:10px">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Mail của bạn" data-validation-required-message="Email của bạn" />
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="control-group" style="margin-bottom:10px">
                                <textarea class="form-control" rows="8" id="message" name="message" placeholder="Lời nhắn của bạn"
                                    data-validation-required-message="Please enter your message"></textarea>
                                @error('message')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div>
                                <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Gửi</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5 mb-5">
                    <div class="bg-light p-30 mb-30">
                        {!! $notification[0]['map'] !!}
                    </div>
                    <div class="bg-light p-30 mb-3">
                        <p class="mb-2"><i
                                class="fa fa-map-marker-alt text-primary mr-3"></i>{{ $notification[0]['address'] }}</p>
                        <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>{{ $notification[0]['email'] }}</p>
                        <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>0{{ $notification[0]['phone'] }}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->
    @endsection

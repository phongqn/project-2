@extends('layouts.master')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('guest.index') }}">Trang chủ</a>
                    <span class="breadcrumb-item active">Sản phẩm yêu thích</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <div class="container-fluid pt-5">
        <h4 class="pl-5 pb-3">Danh sách sản phẩm yêu thích</h4>
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
        <div class="row px-xl-5">

            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Stt</th>
                            <th>Tên Sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @php
                            $index = 0;
                        @endphp
                        @forelse ($likeProduct as $item)
                            {{-- @dd($item['id']) --}}
                            <tr class="item">
                                <td class="align-middle">{{ ++$index }}</td>
                                <td class="align-middle">
                                    <a
                                        href="{{ route('guest.detail', ['slug' => $item['product']['slug'], 'size' => $item['product']['product_size'][0]['size'], 'type' => $item['product']['product_size'][0]['type_size']]) }}">
                                        {{ $item['product']['name'] }}
                                    </a>
                                </td>
                                <td class="align-middle">
                                    <a
                                        href="{{ route('guest.detail', ['slug' => $item['product']['slug'], 'size' => $item['product']['product_size'][0]['size'], 'type' => $item['product']['product_size'][0]['type_size']]) }}">
                                        <img class="w-25"
                                            src="{{ asset('storage/Product' . '/' . $item['product']['img'][0]['path']) }}"
                                            alt="">
                                    </a>
                                </td>
                                <td class="align-middle">
                                    <form method="Post" action="{{ route('guest.liked.destroy_product', $item['id']) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-primary remove" data-id=><i
                                                class="fa fa-times"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                       <p class="text-danger text-center">Không có sản phẩm nào</p>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@extends('layouts.master')
@push('css')
    <style>
    </style>
    @section('content')
        @php
            use App\Enums\TypeSizeEnum;
        @endphp
        <!-- Page Header Start -->
        <div class="container-fluid bg-secondary mb-5">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
                <h1 class="font-weight-semi-bold text-uppercase mb-3">Hóa Đơn</h1>
                <div class="d-inline-flex">
                    <p class="m-0"><a href="">Trang Chủ</a></p>
                    <p class="m-0 px-2">-</p>
                    <p class="m-0">Hóa Đơn</p>
                </div>
            </div>
        </div>
        <!-- Page Header End -->


        <!-- Shop Start -->
        <div class="container-fluid pt-5">
            <div class="row px-xl-5">
                <div class="col-12 col-md-12">
                    <div class="row pb-3">
                        <div class="col-12 pb-1">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <table class="table container table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col" class="text-center">#</th>
                                            <th scope="col" class="text-center">Tên Người Nhận</th>
                                            <th scope="col" class="text-center">Email</th>
                                            <th scope="col" class="text-center">Số điện thoại</th>
                                            <th scope="col" class="text-center">Địa Chỉ</th>
                                            <th scope="col" class="text-center">Ngày Đặt Hàng</th>
                                            <th scope="col" class="text-center">Số Lượng</th>
                                            <th scope="col" class="text-center">Đơn Giá</th>
                                            <th scope="col" class="text-center">Phí Vận Chuyển</th>
                                            <th scope="col" class="text-center">Tình Trạng</th>
                                            <th scope="col" class="text-center">Ghi chú</th>
                                            <th scope="col" class="fix text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                        @endphp

                                        @forelse ($listOrder as $item)
                                            <tr>
                                                <td scope="col" class="align-middle text-center">{{ ++$i }}</td>
                                                <td scope="col" class="align-middle text-center">{{ $item['user']['name'] }}
                                                </td>
                                                <td scope="col" class="align-middle text-center">{{ $item['user']['email'] }}
                                                </td>
                                                <td scope="col" class="align-middle text-center">{{ $item['address'] }}</td>
                                                <td scope="col" class="align-middle text-center">{{ $item['created_at'] }}
                                                </td>
                                                <td scope="col" class="align-middle text-center">{{ $item['quantity'] }}</td>
                                                <td scope="col" class="align-middle text-center">{{ $item['total_price'] }}
                                                </td>
                                                <td scope="col" class="align-middle text-center">{{ $item['price_ship'] }}
                                                </td>

                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="list-product col-12 row">
                        </div>
                        <div class="col-12 pb-1" id="pagination">

                        </div>
                    </div>
                </div>
                <!-- Shop Product End -->
            </div>
        </div>
        <!-- Shop End -->
    @endsection
    @push('js')
        <script src={{ asset('js/pagination.js') }}></script>
        <script>
            $(document).ready(function() {})
        </script>
    @endpush

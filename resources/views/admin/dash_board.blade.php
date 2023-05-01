@extends('admin.layout.main')
@section('title', 'Trang danh sách banner')
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <style>

    </style>
@endpush
@section('content')
    @php
        use App\Enums\PayMentMethodEnum;
        use App\Enums\StatusOrderEnum;
    @endphp
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="bi bi-tag"></i>
                    </div>
                    <div>
                        Dash board
                        <div class="page-title-subheading">
                            View, create, update, delete and manage.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="col-xl-9 col-sm-12 main container">
                    <div class="row">
                        <!-- Sales Card -->
                        <div class="col-xxl-4 col-md-4">
                            <div class="card info-card sales-card bg-success bg-gradient">
                                <div class="card-body">
                                    <h2 class="card-title">Đơn đã bán</h2>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                        </div>
                                        <div class="ps-3">
                                            {{-- <h6 id="total_orders">{{ $ordersnumbers }}</h6> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Sales Card -->
                        <!-- Revenue Card -->
                        <div class="col-xxl-4 col-md-4">
                            <div class="card info-card revenue-card bg-danger bg-gradient">
                                <div class="card-body">
                                    <h2 class="card-title">Doanh Thu Tháng</h2>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-circle-dollar-to-slot"></i>
                                        </div>
                                        <div class="ps-3">
                                            {{-- <h6 id="total_money">{{ $saless }}đ</h6> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Revenue Card -->
                        <!-- Customers Card -->
                        <div class="col-xxl-4 col-md-4">
                            <div class="card info-card customers-card bg-info bg-gradient">
                                <div class="card-body">
                                    <h2 class="card-title">Khách hàng mới</h2>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-users"></i>
                                        </div>
                                        <div class="ps-3">
                                            {{-- <h6 id="total_user">{{ $customernumbers }}</h6> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Sales -->
                        <!-- Recent Sales -->
                        {{-- <div class="col-12">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">
                                    <h5 class="card-title">5 khách hàng mua nhiều nhất</h5>

                                    <table class="table table-striped table-hover table-bordered text-center">
                                        <thead>
                                            <tr>
                                                <th scope="col">STT</th>
                                                <th scope="col">Tên</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Tổng số đơn</th>
                                                <th scope="col">Tổng số tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody id="recent_orders">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> --}}
                        <!-- End Recent Sales -->
                        <!-- Top Selling -->
                        <div class="col-12">
                            <div class="card top-selling overflow-auto">
                                <div class="card-body pb-0">
                                    <h5 class="card-title">5 sản phẩm bán chạy nhất</h5>

                                    <table class="table table-striped table-hover table-bordered text-center">
                                        <thead>
                                            <tr>
                                                <th scope="col">STT</th>
                                                <th scope="col">Ảnh</th>
                                                <th scope="col">Tên sản phẩm</th>
                                                <th scope="col">Tổng số lượng bán</th>
                                            </tr>
                                        </thead>
                                        <tbody id="new_product">
                                            @php
                                                $index = 0;
                                            @endphp
                                            @forelse ($topProduct as $item)
                                                <tr>
                                                    <td>
                                                        {{ $index++ }}
                                                    </td>
                                                    <td>
                                                        <img src="{{ asset('storage/Product' . '/' . $item['img']['path']) }}"
                                                            alt="">
                                                    </td>
                                                    <td>
                                                        {{ $item['name'] }}
                                                    </td>
                                                    <td>
                                                        {{ $item['count'] }}
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
        </div>
    </div>
    <!-- End Main -->

@endsection
@push('js')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.28/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {

        })
    </script>
@endpush

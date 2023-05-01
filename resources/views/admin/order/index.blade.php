@extends('admin.layout.main')
@section('title', 'Trang danh sách banner')
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <style>
        .modal-dialog {
            max-width: 800px !important;
        }

        .select2-selection {
            border: 1px solid black;
            border-radius: 3px;
        }

        .dataTables_wrapper {
            padding-left: 10px !important;
            padding-right: 10px !important;
        }
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
                        Hóa đơn
                        <div class="page-title-subheading">
                            View, create, update, delete and manage.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">
                        <form action="#">
                            <div class="input-group">
                                <div class="col-12">
                                    {{-- <label for="">Khách hàng: </label>
                                    <select class="form-control" id="customer">
                                        <option value="">--Chọn--</option>
                                        @forelse ($listUser as $item)
                                            <option value="{{ $item['id'] }}">
                                                {{ $item['customer']['name'] }}_{{ $item['customer']['email'] }}
                                            </option>
                                        @empty
                                        @endforelse
                                    </select> --}}
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">

                        <table class="align-middle mb-0 table table-borderless table-striped table-hover table-order">
                            <thead>
                                <tr>
                                    <th class="text-center">STT</th>
                                    <th>Tên khách hàng</th>
                                    <th>Số điện thoại</th>
                                    <th>Email</th>
                                    <th>Địa chỉ</th>
                                    <th>Số lượng</th>
                                    <th>Giá trị</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Trạng thái đơn hàng</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                            </thead>
                            {{-- @php
                                $stt = 0;
                            @endphp
                            @forelse ($orders as $item)
                                <tr>
                                    <td class="text-center text-muted">{{ ++$stt }}</td>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading">{{ $item['user']['name'] }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading">{{ $item['phone'] }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading">{{ $item['email'] }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading">{{ $item['address'] }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading">{{ $item['quantity'] }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading">
                                                        {{ number_format($item['total_price'], 0, ',', ',') }} đ</div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading">
                                                        {{ PayMentMethodEnum::getName($item['payment_method']) }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading">
                                                        <select name="" id="" class="select-status">
                                                            @foreach (StatusOrderEnum::getValues() as $itemStatus)
                                                                <option data-id="{{ $item['id'] }}"
                                                                    value="{{ $itemStatus }}"
                                                                    {{ $itemStatus == $item['status'] ? 'selected' : '' }}>
                                                                    {{ StatusOrderEnum::getName($itemStatus) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a data-toggle="modal" data-target="#modalDetail" data-original-title="Sửa"
                                            data-id="{{ $item['id'] }}" data-placement="bottom"
                                            class="btn btn-outline-warning border-0 btn-sm detail-order">
                                            <span class="btn-icon-wrapper opacity-8">
                                                <i class="bi bi-pencil-square"></i>
                                            </span>
                                        </a>
                                        <a href="{{ route('admin.order.export_excel', ['id' => $item['id']]) }}"
                                            data-id="{{ $item['id'] }}" data-placement="bottom"
                                            class="btn btn-outline-success border-0 btn-sm export-excel">
                                            <span class="btn-icon-wrapper opacity-8">
                                                <i class="fa-solid fa-file-excel"></i>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Không tìm thấy bản ghi nào</td>
                                </tr>
                            @endforelse --}}
                        </table>
                    </div>
                    <div class="d-block card-footer">
                        {{-- {{ $list_banners->links() }} --}}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->

@endsection

@push('modal')
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Chi tiết</h5>
                    <button type="button" id="closeColor" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="modal-body" id="formcolor" action="{{ route('admin.product.product_color.store') }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name='product_size_id' id="productid">
                    <div class="container-fluid row mb-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Ảnh</th>
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Kích cỡ</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Đơn giá</th>
                                </tr>
                            </thead>
                            <tbody class="list-detail">

                            </tbody>
                        </table>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary closetype" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
@endpush
@push('js')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.28/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('change', '.select-status', function() {
                let id = $(this).find(':selected').attr('data-id')
                let ele = $(this)
                let status = $(this).val()
                console.log(id, status)
                $.ajax({
                    url: "{{ route('admin.order.update_status') }}",
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id,
                        status: status
                    },
                    success: function(result) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Hủy thành công',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    },
                    error: function(error) {
                        console.log('www', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Hủy thất bại',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                })
            })

            $(document).on('click', '.detail-order', function() {
                let id = $(this).attr('data-id')
                var url = '{{ route('admin.order.detail', ':id') }}';
                url = url.replace(':id', id);
                console.log(url)
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(result) {
                        $('.list-detail').empty();
                        $('.list-detail').append(result);
                    },
                    error: function(error) {
                        console.log('www', error);
                    }
                })
            })


            $("#customer").select2({
                tags: true
            });

            $.ajax({
                url: "{{ route('admin.order.list_order') }}",
                method: 'GET',
                success: function(response) {
                    console.log(response)
                    var index = 0;
                    // console.log(selet)
                    var oTable = $('.table-order').DataTable({
                        "processing": true,
                        "info": false,
                        "pageLength": 6,
                        "columnDefs": [{
                            "searchable": false,
                            "targets": 0
                        }],
                        data: response.order,
                        columns: [{
                                data: 'STT',
                                render: function(data, type, row) {
                                    return ++index;
                                }
                            }, {
                                data: 'user',
                                render: function(data, type, row) {
                                    return row['user']['name'];
                                }
                            }, {
                                data: 'phone',
                            }, {
                                data: 'email'
                            }, {
                                data: 'address'
                            }, {
                                data: 'quantity'
                            }, {
                                data: 'total_price',
                                render: function(data, type, row) {
                                    return Intl.NumberFormat('en-VN').format(row[
                                        'total_price']) + ' đ';
                                }
                            }, {
                                data: 'payment_name'
                            },
                            {
                                data: 'status_name',
                                render: function(data, type, row) {
                                    let selet =
                                        '<select name="" id="" class="select-status">';
                                    response.status.forEach(function(ele) {
                                        selet +=
                                            `<option data-id="${row.id}" value=${ele.id} ${ele.id==row['status']?'selected':''}>${ele.name}</option>`
                                    })
                                    selet += '</select>'
                                    return selet;
                                }
                            }, {
                                data: 'Action',
                                render: function(data, type, row) {
                                    let url = `order/${row['id']}/export-excel`
                                    return `<a data-toggle="modal" data-target="#modalDetail" data-original-title="Sửa"
                                            data-id="${ row['id'] }" data-placement="bottom"
                                            class="btn btn-outline-warning border-0 btn-sm detail-order">
                                            <span class="btn-icon-wrapper opacity-8">
                                                <i class="bi bi-pencil-square"></i>
                                            </span>
                                        </a>
                                        <a href="${url}"
                                            data-id="${ row['id'] }" data-placement="bottom"
                                            class="btn btn-outline-success border-0 btn-sm export-excel">
                                            <span class="btn-icon-wrapper opacity-8">
                                                <i class="fa-solid fa-file-excel"></i>
                                            </span>
                                        </a>`;
                                }
                            }
                        ],
                    }).column(1);
                }

            })
        })
    </script>
@endpush

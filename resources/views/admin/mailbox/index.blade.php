@extends('admin.layout.main')
@section('title', 'Trang danh hòm thư')
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="bi bi-tag"></i>
                    </div>
                    <div>
                        Hòm thư
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="table-responsive">

                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">STT</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Lời nhắn</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                            </thead>
                            @php
                                $index = 0;
                            @endphp
                            @foreach ($list_mailbox as $item)
                                @php $index++; @endphp
                                <tbody>
                                    <tr>
                                        <td class="text-center text-muted">{{ $index }}</td>
                                        <td>
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left flex2">
                                                        <div class="widget-heading">{{ $item->name }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left flex2">
                                                        <div class="widget-heading">{{ $item->email }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left flex2">
                                                        <div class="widget-heading">{{ $item->messenger }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <form class="d-inline" action="" method="POST">
                                                @method('Delete')
                                                @csrf
                                                <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm"
                                                    type="submit" data-toggle="tooltip" title="Delete"
                                                    data-placement="bottom"
                                                    onclick="return confirm('Bạn có chắc chắn xoá bản ghi này chứ ?')">
                                                    <span class="btn-icon-wrapper opacity-8">
                                                        <i class="bi bi-trash3-fill"></i>
                                                    </span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- End Main -->




    @endsection

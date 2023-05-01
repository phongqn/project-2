@extends('admin.layout.main')
@section('title', 'Trang danh sách thư mục')
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="bi bi-tag"></i>
                    </div>
                    <div>
                        Danh mục
                    </div>
                </div>

                <div class="page-title-actions">
                    <a href="{{ route('admin.category.create') }}" class="btn-shadow btn-hover-shine mr-3 btn btn-primary">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="bi bi-plus-circle-fill"></i>
                        </span>
                        Tạo mới
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">
                        <form action="#">
                            <div class="input-group">
                                <input type="search" name="q" id="search" placeholder="Tìm kiếm danh mục"
                                    class="form-control" value="{{ request()->input('q') }}">
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-primary" class="btn-search">
                                        <i class="bi bi-search"></i>
                                        Tìm kiếm
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">

                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">STT</th>
                                    <th>Tên</th>
                                    <th>Danh mục cha</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                            </thead>
                            @php
                                $index = 0;
                            @endphp
                            @if ($list_categories->total() > 0)
                                @foreach ($list_categories as $category)
                                    @php $index++; @endphp
                                    <tbody>

                                        <tr>
                                            <td class="text-center text-muted">{{ $index }}</td>
                                            <td>
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left flex2">
                                                            <div class="widget-heading">{{ $category->name }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            @if ($category->parent_id > 0)
                                                <td>
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left flex2">
                                                                <div class="widget-heading">
                                                                    {{ $category->parent->name }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            @else
                                                <td>
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left flex2">
                                                                <div class="widget-heading">Null</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            @endif

                                            <td class="text-center">
                                                <a href="{{ route('admin.category.edit', $category->id) }}"
                                                    data-toggle="tooltip" title="Edit" data-placement="bottom"
                                                    class="btn btn-outline-warning border-0 btn-sm">
                                                    <span class="btn-icon-wrapper opacity-8">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </span>
                                                </a>
                                                <form class="d-inline"
                                                    action="{{ route('admin.category.destroy', $category->id) }}"
                                                    method="POST">
                                                    @method('Delete')
                                                    @csrf
                                                    <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm"
                                                        type="submit" data-toggle="tooltip" title="Delete"
                                                        data-placement="bottom"
                                                        onclick="return confirm('Bạn có chắc chắn xoá bản ghi này')">
                                                        <span class="btn-icon-wrapper opacity-8">
                                                            <i class="bi bi-trash3-fill"></i>
                                                        </span>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="text-center">Không tìm thấy bản ghi nào !</td>
                                </tr>
                            @endif
                        </table>
                    </div>

                    <div class="d-block card-footer">
                        {{ $list_categories->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->




@endsection

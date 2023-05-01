<div class="col-lg-3 d-none d-lg-block">
    <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100"
        data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
        <h6 class="m-0">Danh mục</h6>
        <i class="fa fa-angle-down text-dark"></i>
    </a>
    <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light"
        id="navbar-vertical" style="width: calc(100% - 30px); z-index: 2;">
        <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
            @foreach ($categories as $category)
                @if ($category['parent_id'] == 0)
                    <div class="nav-item dropdown">
                        <a href="" class="nav-link" data-toggle="dropdown">{{ $category['name'] }}<i
                                class="fa fa-angle-down float-right mt-1"></i></a>
                        @if (!empty($category['children']))
                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                @foreach ($category['children'] as $item)
                                    <a href="" class="dropdown-item">{{ $item['name'] }}</a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif
            @endforeach
        </div>

    </nav>
</div>

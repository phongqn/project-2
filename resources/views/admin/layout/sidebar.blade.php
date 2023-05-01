<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Menu</li>

                <li class="mm-active">
                    <a href="#">
                        <i class="bi bi-menu-button-wide mr-2"></i>Ứng dụng
                        <i class="bi bi-caret-down-fill"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('admin.index') }}">
                                <i class="metismenu-icon"></i>Dash board
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.banner.index') }}">
                                <i class="metismenu-icon"></i>Banner
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.product.index') }}" class="">
                                <i class="metismenu-icon"></i>Sản phẩm
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.category.index') }}">
                                <i class="metismenu-icon"></i>Phân loại
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.brand.index') }}">
                                <i class="metismenu-icon"></i>Nhãn hàng
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.supplier.index') }}">
                                <i class="metismenu-icon"></i>Nhà cung cấp
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.notification.index') }}">
                                <i class="metismenu-icon"></i>Thông tin cửa hàng
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.customer.index') }}">
                                <i class="metismenu-icon"></i>Thông tin khách hàng
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.order.index') }}">
                                <i class="metismenu-icon"></i>Đơn hàng
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.discount.index') }}">
                                <i class="metismenu-icon"></i>Mã giảm giá
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.mailbox.index') }}">
                                <i class="metismenu-icon"></i>Lời nhắn của khách hàng
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

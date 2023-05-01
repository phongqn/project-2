<nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
    <a href="" class="text-decoration-none d-block d-lg-none">
        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
    </a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
        <div class="navbar-nav mr-auto py-0">
            <a href="{{ route('guest.index') }}" class="nav-item nav-link">Trang chủ</a>
            <a href="{{ route('guest.shop') }}" class="nav-item nav-link">Sản phẩm</a>
            <a href="{{ route('guest.contact.index') }}" class="nav-item nav-link">Liên hệ</a>
            <a href="{{ route('guest.about.index') }}" class="nav-item nav-link">Giới thiệu</a>
            <a href="{{route('guest.about.helpp') }}" class=" nav-item nav-link">Hướng dẫn mua hàng</a>
            <a href="{{route('guest.coupon.index')}}" class=" nav-item nav-link">Phiếu giảm giá</a>
        </div>
        <div class="navbar-nav ml-auto py-0">
            @if (Auth::check())
            <div class="dropdown">
                <button class="btn btn-white dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth()->user()->name }}
                </button>
                <div class=" dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ route('guest.account.index') }}">Thông tin</a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
            @else
            <a href="{{ 'login' }}" class="nav-item nav-link">Login</a>
            <a href="{{ 'register' }}" class="nav-item nav-link">Register</a>
            @endif
        </div>
    </div>
</nav>
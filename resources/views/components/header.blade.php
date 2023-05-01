<div class="container-fluid">
    <div class="row align-items-center py-3 px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a href="{{ route('guest.index') }}" class="text-decoration-none">
                <h1 class="m-0 display-5 font-weight-semi-bold"><span
                        class="text-primary font-weight-bold border px-3 mr-1">Everything</span></h1>
            </a>
        </div>
        <div class="col-lg-6 col-6 text-left">
            <form action="">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Tìm sản phẩm">
                    <div class="input-group-append">
                        <span class="input-group-text bg-transparent text-primary">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-3 col-6 text-right">
            <a href="{{ route('guest.liked.index') }}" class="btn border">
                <i class="fas fa-heart text-primary"></i>
                <span class="badge">{{ $quantityLiked }}</span>
            </a>
            <a href="{{ route('guest.cart.index') }}" class="btn border">
                <i class="fas fa-shopping-cart text-primary"></i>
                <span class="badge">{{ $quantityCart }}</span>
            </a>
        </div>
    </div>
</div>

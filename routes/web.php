<?php

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Jobs\SendOrderMail;
use App\Models\OrderDetail;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use App\Exports\CustomerExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Services\Guest\Cart\CartService;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Guest\CartController;
use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Guest\AboutController;
use App\Http\Controllers\Guest\LikedController;
use App\Http\Controllers\Guest\OrderController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Guest\CouponController;
use App\Http\Controllers\Admin\MailboxController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Guest\AccountController;
use App\Http\Controllers\Guest\ContactController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductSizeController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductColorController;
use App\Http\Controllers\Guest\ProductController as GuestProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();




Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/sign-in', [AuthController::class, 'signIn'])->name('sign_in');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::group(['middleware' => 'assign.guard:admin'], function () {
        Route::get('/change-pass', [AuthController::class, 'changePass'])->name('change_pass');
        Route::put('/update-pass', [AuthController::class, 'updatePass'])->name('update_pass');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');
        Route::get('/',  [DashboardController::class, 'index'])->name('index');

        Route::group(['prefix' => 'banner', 'as' => 'banner.', 'namespace' => 'Banner'], function () {
            Route::get('/', [BannerController::class, 'index'])->name('index');
            Route::get('create', [BannerController::class, 'create'])->name('create');
            Route::post('store', [BannerController::class, 'store'])->name('store');
            Route::get('{id}/edit', [BannerController::class, 'edit'])->name('edit');
            Route::put('{id}/update', [BannerController::class, 'update'])->name('update');
            Route::delete('{id}', [BannerController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'notification', 'as' => 'notification.', 'namespace' => 'Notification'], function () {
            Route::get('/', [NotificationController::class, 'index'])->name('index');
            Route::get('/edit', [NotificationController::class, 'edit'])->name('edit');
            Route::put('/update', [NotificationController::class, 'update'])->name('update');
        });

        Route::group(['prefix' => 'customer', 'as' => 'customer.', 'namespace' => 'Customer'], function () {
            Route::get('/', [CustomerController::class, 'index'])->name('index');
            Route::get('/export', [CustomerController::class, 'export'])->name('export');
        });

        Route::group(['prefix' => 'discount', 'as' => 'discount.', 'namespace' => 'Discount'], function () {
            Route::get('/', [DiscountController::class, 'index'])->name('index');
            Route::get('create', [DiscountController::class, 'create'])->name('create');
            Route::post('store', [DiscountController::class, 'store'])->name('store');
            Route::get('{id}/edit', [DiscountController::class, 'edit'])->name('edit');
            Route::put('{id}/update', [DiscountController::class, 'update'])->name('update');
            Route::delete('{id}', [DiscountController::class, 'destroy'])->name('destroy');
            route::get('/registered-user', [DiscountController::class, 'registeredUser'])->name('registered_user');
            route::post('/send-mail', [DiscountController::class, 'sendMail'])->name('send_mail');
            route::get('/send-all', [DiscountController::class, 'sendAll'])->name('send_all');
        });

        Route::group(['prefix' => 'brand', 'as' => 'brand.', 'namespace' => 'Brand'], function () {
            Route::get('/', [BrandController::class, 'index'])->name('index');
            Route::get('create', [BrandController::class, 'create'])->name('create');
            Route::post('store', [BrandController::class, 'store'])->name('store');
            Route::get('{id}/edit', [BrandController::class, 'edit'])->name('edit');
            Route::put('{id}/update', [BrandController::class, 'update'])->name('update');
            Route::delete('{id}', [BrandController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'mailbox', 'as' => 'mailbox.', 'namespace' => 'Mailbox'], function () {
            Route::get('/', [MailboxController::class, 'index'])->name('index');
        });


        Route::group(['prefix' => 'category', 'as' => 'category.', 'namespace' => 'Category'], function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('create', [CategoryController::class, 'create'])->name('create');
            Route::post('store', [CategoryController::class, 'store'])->name('store');
            Route::get('{id}/edit', [CategoryController::class, 'edit'])->name('edit');
            Route::put('{id}/update', [CategoryController::class, 'update'])->name('update');
            Route::delete('{id}', [CategoryController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'product', 'as' => 'product.', 'namespace' => 'Product'], function () {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::get('create', [ProductController::class, 'create'])->name('create');
            Route::post('store', [ProductController::class, 'store'])->name('store');
            Route::get('{id}/edit', [ProductController::class, 'edit'])->name('edit');
            Route::put('update', [ProductController::class, 'update'])->name('update');
            Route::delete('delete', [ProductController::class, 'delete'])->name('delete');
            Route::post('change-status', [ProductController::class, 'changeStatus'])->name('change_status');
            Route::get('list-product', [ProductController::class, 'listProduct'])->name('list_product');
            Route::post('change-outstanding', [ProductController::class, 'changeOutstanding'])->name('change_outstanding');
            Route::group(['prefix' => 'product-size', 'as' => 'product_size.', 'namespace' => 'ProductSize'], function () {
                Route::get('{id}/create', [ProductSizeController::class, 'create'])->name('create');
                Route::post('store', [ProductSizeController::class, 'store'])->name('store');
                Route::delete('detele-img', [ProductSizeController::class, 'deleteImg'])->name('detele_img');
                Route::delete('detele', [ProductSizeController::class, 'delete'])->name('detele');
                Route::post('update', [ProductSizeController::class, 'update'])->name('update');
                Route::get('{id}/edit', [ProductSizeController::class, 'edit'])->name('edit');
                Route::get('{id}/list-product-size', [ProductSizeController::class, 'listProductSize'])->name('list_product_size');
            });
            Route::group(['prefix' => 'product-color', 'as' => 'product_color.', 'namespace' => 'ProductColor'], function () {
                Route::post('store', [ProductColorController::class, 'store'])->name('store');
                Route::delete('delete', [ProductColorController::class, 'delete'])->name('delete');
                Route::get('{productSizeId}/list-color', [ProductColorController::class, 'listColorProduct'])->name('list_color');
                Route::put('update', [ProductColorController::class, 'update'])->name('update');
            });
        });

        Route::group(['prefix' => 'order', 'as' => 'order.', 'namespace' => 'Order'], function () {
            Route::get('/', [AdminOrderController::class, 'index'])->name('index');
            Route::get('{id}/detail', [AdminOrderController::class, 'detail'])->name('detail');
            Route::post('/update-status', [AdminOrderController::class, 'updateStatus'])->name('update_status');
            Route::get('{id}/export-excel', [AdminOrderController::class, 'exportExcel'])->name('export_excel');
            Route::get('list-order', [AdminOrderController::class, 'getData'])->name('list_order');
        });

        Route::group(['prefix' => 'supplier', 'as' => 'supplier.', 'namespace' => 'Supplier'], function () {
            Route::get('/', [SupplierController::class, 'index'])->name('index');
            Route::get('create', [SupplierController::class, 'create'])->name('create');
            Route::post('store', [SupplierController::class, 'store'])->name('store');
            Route::get('{id}/edit', [SupplierController::class, 'edit'])->name('edit');
            Route::put('{id}/update', [SupplierController::class, 'update'])->name('update');
            Route::delete('{id}', [SupplierController::class, 'destroy'])->name('destroy');
        });
    });
});
//================GUEST=========================//
Route::group(['as' => 'guest.', 'namespace' => 'Guest'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/shop', [GuestProductController::class, 'index'])->name('shop');
    Route::get('{slug}/size:{size}-{type}/shop-detail', [GuestProductController::class, 'detail'])->name('detail');
    Route::group(['prefix' => 'product', 'as' => 'product.', 'namespace' => 'Guest'], function () {
        Route::get('/list-product', [GuestProductController::class, 'listProduct'])->name('list_product');
        Route::get('{id}/quantity-product-color', [GuestProductController::class, 'quantityProductColor'])->name('quantity_product_color');
    });

    Route::group(['prefix' => 'liked', 'as' => 'liked.', 'namespace' => 'Guest'], function () {
        Route::get('/', [LikedController::class, 'index'])->name('index');
        Route::post('/add-product', [LikedController::class, 'addProduct'])->name('add_product');
        Route::delete('/{id}', [LikedController::class, 'destroyProduct'])->name('destroy_product');
    });

    Route::group(['prefix' => 'cart', 'as' => 'cart.', 'namespace' => 'Guest'], function () {
        Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add_to_cart');
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::put('update', [CartController::class, 'update'])->name('update');
        Route::delete('delete', [CartController::class, 'delete'])->name('delete');
        Route::get('check-out', [CartController::class, 'checkOut'])->name('check_out');
        Route::post('discount', [CartController::class, 'discount'])->name('discount');
    });

    Route::group(['prefix' => 'order', 'as' => 'order.', 'namespace' => 'Guest'], function () {
        Route::post('create', [OrderController::class, 'create'])->name('create');
        Route::post('/vn-pay', [OrderController::class, 'vnPayOnline'])->name('vn_pay');
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('{id}/detail', [OrderController::class, 'detail'])->name('detail');
        Route::post('cancel', [OrderController::class, 'cancel'])->name('cancel');
    });

    Route::group(['prefix' => 'contact', 'as' => 'contact.', 'namespace' => 'Guest'], function () {
        Route::get('/', [ContactController::class, 'index'])->name('index');
        Route::post('/send-message', [ContactController::class, 'sendMessage'])->name('send_message');
    });

    Route::group(['prefix' => 'about', 'as' => 'about.', 'namespace' => 'Guest'], function () {
        Route::get('/', [AboutController::class, 'index'])->name('index');
        Route::get('/helpp', [AboutController::class, 'helpp'])->name('helpp');
    });

    Route::group(['prefix' => 'account', 'as' => 'account.', 'namespace' => 'Guest'], function () {
        Route::get('/', [AccountController::class, 'index'])->name('index');
        Route::put('/update', [AccountController::class, 'update'])->name('update');
    });

    Route::group(['prefix' => 'coupon', 'as' => 'coupon.', 'namespace' => 'Guest'], function () {
        Route::get('/', [CouponController::class, 'index'])->name('index');
        Route::post('/register-coupon', [CouponController::class, 'registerCoupon'])->name('register_coupon');
    });
});






Route::fallback(function () {
    return view('errors.404');
})->name('error');
// Route::get('/test', function () {
//     return view('test');
// });
Route::get('/test1', function (Request $request) {
    $request->session()->put('cart', ['dadfas' => 123, 'jhfjasd' => 'khan asdfasddeptai']);
});
Route::get('/test', function (Request $request) {
    // $request->session()->forget('cart');
    dd($request->session()->pull('cart'));
})->name('test');

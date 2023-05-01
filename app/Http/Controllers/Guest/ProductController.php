<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Notification;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Services\Guest\Product\ProductService;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        return view('guest.product.index', [
            'brands' => Brand::get()->toArray(),
            'notification' => Notification::get(),
            'categories' => Category::with('children')->get()->toArray()
        ]);
    }

    public function listProduct(Request $request)
    {

        return  $this->productService->getListProduct($request);
    }

    public function detail(Request $request)
    {
        $response = $this->productService->getDataDetail($request);
        if ($response['success']) {
            return view('guest.product.detail', $response['data'], ['notification' => Notification::get()]);
        } else {
            Toastr::error('Thông báo', 'Thêm sản phẩm thất bại');
            return App::abort(404, 'Record not found.');
        }
    }
    public function quantityProductColor(Request $request)
    {
        $productColor = ProductColor::find($request->id);
        if ($productColor) {
            return $productColor->quantity;
        } else {
            return response()->json([
                'message' => 'Lỗi'
            ], 404);
        }
    }
}

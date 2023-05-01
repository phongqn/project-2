<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Models\Product;
use App\Services\Admin\Product\ProductService;
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

    public function listProduct(Request $request)
    {
        return $this->productService->getListProductData($request);
    }
    
    public function index(Request $request)
    {
        return view('admin.product.index', ['listProduct' => $this->productService->getListProduct($request)]);
    }

    public function create()
    {
        return view('admin.product.create', $this->productService->getDataCreate());
    }

    public function store(ProductRequest $request)
    {
        $response = $this->productService->create($request);
        if ($response['success']) {
            return redirect()->route('admin.product.product_size.create', ['id' => $response['data']['id']]);
        } else {
            Toastr::error('Thông báo', 'Thêm sản phẩm thất bại');
            return redirect()->back();
        }
    }

    public function edit(Request $request)
    {
        $product = Product::where('id', $request->id)->first();
        if ($product) {
            $data = ['product' => $product] + $this->productService->getDataCreate();
            return view('admin.product.edit', $data);
        } else {
            return App::abort(404, 'Record not found.');
        }
    }

    public function update(ProductRequest $request)
    {
        $response = $this->productService->update($request);
        if ($response['success']) {
            return redirect()->route('admin.product.product_size.create', ['id' => $response['data']['id']]);
        } else {
            Toastr::error('Thông báo', 'Cập nhật sản phẩm thất bại');
            return redirect()->back();
        }
    }

    public function changeStatus(Request $request)
    {
        return $this->productService->changeStatus($request);
    }

    public function changeOutstanding(Request $request)
    {
        return $this->productService->changeOutstanding($request);
    }

    public function delete(Request $request)
    {
        $response = $this->productService->delete($request->id);
        if ($response['success']) {
            Toastr::success('Thông báo', 'Xoá sản phẩm thành công');
            return redirect()->back();
        } else {
            Toastr::error('Thông báo', 'Xoá sản phẩm thất bại');
            return redirect()->back();
        }
    }
}

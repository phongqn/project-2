<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductSizeRequest;
use App\Models\ProductSize;
use App\Services\Admin\Product\ProductSizeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\ValidationException;

class ProductSizeController extends Controller
{
    protected $productSizeService;

    public function __construct(ProductSizeService $productSizeService)
    {
        $this->productSizeService = $productSizeService;
    }

    public function listProductSize($id)
    {
        return view('admin.product.component.list-detail', ['listDetail' => ProductSize::with('Color', 'ProductColor', 'Img')->where('product_id', $id)->get()->toArray(), 'idProduct' => $id]);
    }

    public function create(Request $request)
    {
        $data = $this->productSizeService->getDataCreate($request);
        if ($data['success']) return view('admin.product.create_size', $data['data']);
        else {
            return App::abort(404, 'Record not found.');
        }
    }

    public function store(ProductSizeRequest $request)
    {
        $response = $this->productSizeService->create($request);
        if ($response['success']) {
            return view('admin.product.component.item_size', $response['data']);
        } else {
            throw ValidationException::withMessages(['Thất bại']);
        }
    }

    public function deleteImg(Request $request)
    {
        return $this->productSizeService->deleteImg($request, 'ProductSize');
    }

    public function edit($id)
    {
        $productSize = ProductSize::with('Img')->where('id', $id)->first();
        if ($productSize) return view(
            'admin.product.component.item_update_size_product',
            ['porductSize' => $productSize->toArray()]
        );
        else {
            return App::abort(404, 'Record not found.');
        }
    }

    public function update(ProductSizeRequest $request)
    {
        $response = $this->productSizeService->update($request);
        if ($response['success']) {
            return $response;
        } else return response()->json([
            'message' => 'Xóa thất bại'
        ], 400);
    }

    public function delete(Request $request)
    {
        $response = $this->productSizeService->delete($request->id);
        if ($response['success']) {
            return $response;
        } else return response()->json([
            'message' => $response['error']
        ], 400);
    }
}

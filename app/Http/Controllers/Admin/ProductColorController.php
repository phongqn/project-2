<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductColorRequest;
use App\Models\ProductColor;
use App\Services\Admin\Product\ProductColorService;
use Illuminate\Http\Request;

class ProductColorController extends Controller
{
    protected $productColorService;

    public function __construct(ProductColorService $productColorService)
    {
        $this->productColorService = $productColorService;
    }

    public function store(ProductColorRequest $request)
    {
        $respone = $this->productColorService->create($request);
        if ($respone['success']) {
            return $respone;
        } else {
            return response()->json([
                'message' => 'Xóa thất bại'
            ], 400);
        }
    }

    public function listColorProduct($productSizeId)
    {
        return view('admin.product.component.item_color_product', ['listColor' => ProductColor::with('Color', 'Img')->where('product_size_id', $productSizeId)->get()->toArray()]);
    }

    public function delete(Request $request)
    {
        $respone = $this->productColorService->delete($request);
        if ($respone['success']) {
            return $respone;
        } else {
            return response()->json([
                'message' => 'Xóa thất bại'
            ], 400);
        }
    }
    
    public function update(ProductColorRequest $request)
    {
        $respone = $this->productColorService->update($request);
        if ($respone['success']) {
            return $respone;
        } else {
            return response()->json([
                'message' => 'Xóa thất bại'
            ], 400);
        }
    }
}

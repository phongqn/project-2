<?php

namespace App\Services\Admin\Product;

use App\Enums\TypeImgEnum;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\Supplier;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Throwable;

class ProductColorService extends BaseService
{
    public function __construct(ProductColor $productColor)
    {
        $this->model = $productColor;
    }


    public function create($request)
    {
        try {
            DB::beginTransaction();
            $this->model->create($request->all());
            DB::commit();
            return ['success' => true, 'message' => 'thành công'];
        } catch (Throwable $e) {
            DB::rollBack();
            return ['success' => false, 'error' => $e];
        }
    }

    public function delete($request)
    {
        try {
            DB::beginTransaction();
            $productColor = $this->model->where('product_size_id', $request->product_size_id)->where('color_id', $request->color_id)->first();
            $quantity = $productColor->quantity;
            $productColor->delete();
            DB::commit();
            return ['success' => true, 'data' => ['quantity' => $quantity]];
        } catch (Throwable $e) {
            DB::rollBack();
            return ['success' => false, 'error' => 'Thất bại'];
        }
    }

    public function update($request)
    {
        try {
            $productColor = $this->model->where('id', $request->id);
            $productColor->update(['quantity' => $request->quantity]);
            $productSizeId = $productColor->first()->product_size_id;
            $quantity = $this->model->where('product_size_id', $productSizeId)->get()->sum('quantity');
            return ['success' => true, 'message' => 'Thành công', 'data' => ['quantity' => $quantity, 'id' => $productSizeId], 'new' => $request->all()];
        } catch (Throwable $e) {
            return ['success' => false, 'error' => 'Thất bại'];
        }
    }
}

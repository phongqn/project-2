<?php

namespace App\Services\Admin\Product;

use App\Enums\TypeImgEnum;
use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Throwable;

class ProductSizeService extends BaseService
{
    public function __construct(ProductSize $product)
    {
        $this->model = $product;
    }

    /**
     *  @param  int  $id
     * Lấy dữ liệu để thêm chi tiết sản phẩm
     * @return  array
     */
    public function getDataCreate($request)
    {
        if (Product::find($request->id)) {
            return  [
                'success' => true,
                'data' => [
                    'id' => $request->id,
                    'listDetail' => $this->model->with('ProductColor')->where('product_id', $request->id)->get()->toArray(),
                    'colors' => Color::get()->toArray()
                ]
            ];
        } else {
            return [
                'success' => false,
                'error' => 'Lỗi'
            ];
        }
    }

    public function create($request)
    {
        try {
            DB::beginTransaction();
            $productSize = $this->model->create($request->all());
            $img = [];
            foreach ($request->file('img') as $item) {
                $filename = time() . '_' . $item->getClientOriginalName();
                $location = storage_path('app/public/ProductSize');
                $item->move($location, $filename);
                Image::create([
                    'object_id' => $productSize->id,
                    'path' => $filename,
                    'type' => TypeImgEnum::PRODUCTSIZE_IMG,
                ]);
                $img[] = $filename;
            }
            DB::commit();
            return ['success' => true, 'data' => ['productSize' => $productSize->toArray(), 'quantity' => 0]];
        } catch (Throwable $e) {
            DB::rollBack();
            return ['success' => false, 'error' => $e];
        }
    }

    /**
     * @param  Request  $request,String $folderName
     * Xóa ảnh sản phẩm
     * @return  response json
     */
    public function deleteImg($request, $folderName)
    {
        try {
            $img = Image::where('id', $request->id)->first();
            deleteImgFromFile($folderName . "\\" . $img->path);
            $img->delete();
            return ['success' => true, 'message' => 'thành công'];
        } catch (Throwable $e) {
            return ['success' => false, 'error' => 'Thất bại'];
        }
    }

    public function update($request)
    {
        try {
            DB::beginTransaction();
            $productSize = $this->model->where('id', $request->id)->first();
            $productSize->update($request->all());
            if (!empty($request->file('img'))) {
                foreach ($request->file('img') as $item) {
                    $filename = time() . '_' . $item->getClientOriginalName();
                    $location = storage_path('app/public/ProductSize');
                    $item->move($location, $filename);
                    Image::create([
                        'object_id' => $productSize->id,
                        'path' => $filename,
                        'type' => TypeImgEnum::PRODUCTSIZE_IMG,
                    ]);
                }
            }
            DB::commit();
            return ['success' => true, 'message' => 'thành công'];
        } catch (Throwable $e) {
            DB::rollBack();
            // return $e;
            return ['success' => true, 'error' => 'Thất bại'];
        }
    }

    /**
     * @param  int  $id
     * Xóa chi tiết sản phẩm (theo dung lượng,màu ...)
     * @return  response json
     */
    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $listImg = Image::where('object_id', $id)->where('type', TypeImgEnum::PRODUCTSIZE_IMG); //->delete();
            foreach ($listImg->get() as $item) {
                deleteImgFromFile('ProductSize' . "\\" . $item->path);
            }
            $listImg->delete();
            $listColorProduct = ProductColor::where('product_size_id', $id);
            $listColorProduct->delete();
            $productSize = $this->model->where('id', $id);
            $idProduct = $productSize->first()->product_id;
            $productSize->delete();
            $isEmpty = $this->model->where('product_id', $idProduct)->count() ? 1 : 0; //check product còn size nào không
            DB::commit();
            return ['success' => true, 'message' => 'thành công', 'data' => ['isEmpty' => $isEmpty]];
        } catch (Throwable $e) {
            DB::rollBack();
            return ['success' => false, 'error' => $e];
        }
    }
}

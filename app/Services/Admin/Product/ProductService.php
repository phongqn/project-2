<?php

namespace App\Services\Admin\Product;

use App\Enums\TypeImgEnum;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Supplier;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Throwable;

class ProductService extends BaseService
{
    public function __construct(Product $product)
    {
        $this->model = $product;
        $this->perPage = 6;
    }

    /**
     * @param  Request  $request
     * Lấy danh sách sản phẩm
     *  @returna array
     */
    public function getListProduct($request)
    {
        $searchName = $request->input('search') ? $request->input('search') : '';
        return $this->model->with('Brand', 'Img', 'Category')->where('name', 'like', '%' . $searchName . '%')->paginate($this->perPage);
    }

    /**
     * @param  Request  $request
     * Lấy danh sách sản phẩm
     *  @returna array
     */
    public function getListProductData($request)
    {
        $searchName = $request->input('search') ? $request->input('search') : '';
        return $this->model->with('Brand', 'Img', 'Category')->where('name', 'like', '%' . $searchName . '%')->get()->toArray();
    }

    /**
     *
     * Lấy dữ liệu cho việc thêm sản phẩm
     * @return  array
     */
    public function getDataCreate()
    {
        $categories = Category::with('parent')->get()->toArray();
        return ['suppliers' => Supplier::get()->toArray(), 'categories' => $categories, 'brands' => Brand::get()->toArray()];
    }
    /**
     * @param  Request  $request
     * Lưu sản phẩm đã thêm
     * @return  array
     */
    public function create($request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $data['is_selling'] = !empty($request->input('is_selling')) ? 1 : 0;
            $data['is_outstanding'] = !empty($request->input('is_outstanding')) ? 1 : 0;
            $data['status'] = !empty($request->input('status')) ? '1' : '0';
            $data['slug'] = create_slug($data['name']);
            $product = $this->model->create($data);
            $file = $request->file('img');
            $filename = time() . '_' . $file->getClientOriginalName();
            $location = storage_path('app/public/Product');
            $file->move($location, $filename);
            Image::create([
                'object_id' => $product->id,
                'path' => $filename,
                'type' => TypeImgEnum::PRODUCT_IMG,
            ]);
            DB::commit();
            return ['success' => true, 'data' => ['id' => $product->id]];
        } catch (Throwable $e) {
            DB::rollBack();
            dd($e);
            return ['success' => false, 'error' => $e];
        }
    }

    /**
     * @param  Request  $request
     * Cập nhật thông tin sản phẩm
     *
     */
    public function update($request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $data['is_selling'] = !empty($request->input('is_selling')) ? 1 : 0;
            $data['is_outstanding'] = !empty($request->input('is_outstanding')) ? 1 : 0;
            $data['status'] = !empty($request->input('status')) ? '1' : '0';
            $data['slug'] = create_slug($data['name']);
            $product = $this->model->where('id', $request->id)->first();
            $product->update($data);
            if (!empty($request->file('img'))) {
                $oldImg = Image::where('object_id', $product->id)->where('type', TypeImgEnum::PRODUCT_IMG)->first(); //->delete();
                deleteImgFromFile('Product' . "\\" . $oldImg->path);
                $oldImg->delete();
                $file = $request->file('img');
                $filename = time() . '_' . $file->getClientOriginalName();
                $location = storage_path('app/public/Product');
                $file->move($location, $filename);
                Image::create([
                    'object_id' => $product->id,
                    'path' => $filename,
                    'type' => TypeImgEnum::PRODUCT_IMG,
                ]);
            }
            DB::commit();
            return ['success' => true, 'data' => ['id' => $product->id]];
        } catch (Throwable $e) {
            DB::rollBack();
            dd($e);
            return ['success' => false, 'error' => $e];
        }
    }

    /**
     * @param  int  $id
     * Xóa sản phẩm
     * @return array
     */
    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $imgProduct = Image::where('object_id', $id)->where('type', TypeImgEnum::PRODUCT_IMG)->first(); //->delete();
            deleteImgFromFile('Product' . "\\" . $imgProduct->path);
            $imgProduct->delete();
            $listProductSize = ProductSize::where('product_id', $id)->get();
            $productSize = new ProductSizeService(new ProductSize());
            foreach ($listProductSize as $item) {
                $productSize->delete($item->id);
            }
            Product::where('id', $id)->delete();
            DB::commit();
            return ['success' => true];
        } catch (Throwable $e) {
            DB::rollBack();
            return ['success' => false, 'error' => 'Xóa thất bại'];
        }
    }

    /**
     * @param  Request  $request
     * Thay đổi trạng thái sản phẩm
     * @return  array
     */
    public function changeStatus($request)
    {
        try {
            $this->model->where('id', $request->input('product_id'))->update(['status' => $request->input('status') ? '1' : '0']);
            return ['success' => true];
        } catch (Throwable $e) {
            DB::rollBack();
            return  ['success' => false, 'error' => 'Thất bại'];
        }
    }

    public function changeOutstanding($request)
    {
        try {
            $this->model->where('id', $request->input('product_id'))->update(['is_outstanding' => $request->input('is_outstanding')]);
            return ['success' => true];
        } catch (Throwable $e) {
            DB::rollBack();
            return  ['success' => false, 'error' => 'Thất bại'];
        }
    }
}

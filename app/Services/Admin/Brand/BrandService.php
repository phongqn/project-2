<?php

namespace App\Services\Admin\Brand;

use Throwable;
use App\Models\Image;
use App\Models\Brand;
use App\Enums\TypeImgEnum;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class BrandService extends BaseService
{
    public function __construct(Brand $brand)
    {
        $this->model = $brand;
    }

    /**
     * @param Request ,$request
     * Lấy tất cả brand
     * @return  true false
     */

    public function get_all($request)
    {
        $keyword = "";
        if ($request->input('q')) {
            $keyword = $request->input('q');
        }
        $brands = $this->model
            ->with('Img')
            ->where('name',  'LIKE', "%{$keyword}%")
            ->latest()
            ->paginate(10);

        return $brands;
    }

    /**
     * @param Request ,$request
     * Tạo brand
     * @return  true false
     */

    public function create($request)
    {
        try {
            DB::beginTransaction();
            $brand = $this->model->create([
                'name' => $request->name,
                'status' => $request->status,
                'index' => $request->index,
            ]);
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $location = storage_path('app/public/Brand');
                $file->move($location, $filename);
                Image::create([
                    'path' => $filename,
                    'object_id' => $brand->id,
                    'type' => TypeImgEnum::BRAND_IMG,
                ]);
            }
            DB::commit();
            return [
                'success' => true,
            ];
        } catch (Throwable $e) {
            DB::rollBack();
            return [
                'success' => false,
                'error' => $e
            ];
        }
    }

    /**
     * @param Request ,$request $id
     * Cập nhật brand
     * @return  true false
     */

    public function update($id, $request)
    {
        try {
            DB::beginTransaction();
            $this->model->find($id)->update([
                'name' => $request->name,
                'index' => $request->index,
                'status' => $request->status
            ]);
            $brand =  $this->model->with('Img')->find($id);
            $path_old = $brand->img[0]->path;
            if ($request->hasFile('file')) {
                deleteImgFromFile('Brand' . "\\" . $path_old);
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $location = storage_path('app/public/Brand');
                $file->move($location, $filename);
            } else {
                $filename = $path_old;
            }
            $image = Image::where('object_id', $id)->where('type', TypeImgEnum::BRAND_IMG)->first();
            $image->update([
                'path' => $filename,
                'type' => TypeImgEnum::BRAND_IMG,
            ]);
            DB::commit();
            return [
                'success' => true,
            ];
        } catch (Throwable $e) {
            DB::rollBack();
            return [
                'success' => false,
                'error' => $e
            ];
        }
    }

    /**
     * @param id ,$id
     * Xoá brand
     * @return  true false
     */

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $brand =  $this->model->with('Img')->findOrFail($id);
            $brand->delete();
            $path_img = $brand->img[0]->path;
            deleteImgFromFile('Brand' . "\\" . $path_img);
            $brand->img[0]->delete();
            DB::commit();
            return [
                'success' => true,
            ];
        } catch (Throwable $e) {
            DB::rollBack();
            return [
                'success' => false,
                'error' => $e
            ];
        }
    }
}

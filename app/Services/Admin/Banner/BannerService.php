<?php

namespace App\Services\Admin\Banner;

use Throwable;
use App\Models\Image;
use App\Models\Banner;
use App\Enums\TypeImgEnum;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class BannerService extends BaseService
{
    /**
     * BannerService constructor.
     *
     * @param  Banner  $banner
     * 
     */

    public function __construct(Banner $banner)
    {
        $this->model = $banner;
    }

    /**
     * @param Request ,$request
     * Lấy tất cả banner
     * @return  array
     */


    public function get_all($request)
    {
        $keyword = "";
        if ($request->input('q')) {
            $keyword = $request->input('q');
        }
        $banners = $this->model
            ->with('Img')
            ->where('name',  'LIKE', "%{$keyword}%")
            ->latest()
            ->paginate(10);

        return $banners;
    }

    /**
     * @param Request ,$request
     * Tạo banner
     * @return  true false
     */

    public function create($request)
    {
        try {
            DB::beginTransaction();
            $banner = $this->model->create([
                'name' => $request->name,
                'status' => $request->status,
                'index' => $request->index,
            ]);
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $location = storage_path('app/public/Banner');
                $file->move($location, $filename);
                Image::create([
                    'path' => $filename,
                    'object_id' => $banner->id,
                    'type' => TypeImgEnum::BANNER_IMG,
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
     * @param Request ,$request
     * Cập nhật banner
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
            $banner =  $this->model->with('Img')->find($id);
            $path_old = $banner->img[0]->path;
            if ($request->hasFile('file')) {
                deleteImgFromFile('Banner' . "\\" . $path_old);
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $location = storage_path('app/public/Banner');
                $file->move($location, $filename);
            } else {
                $filename = $path_old;
            }
            $image = Image::where('object_id', $id)->where('type', TypeImgEnum::BANNER_IMG)->first();
            $image->update([
                'path' => $filename,
                'type' => TypeImgEnum::BANNER_IMG,
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
     * @param $id
     * Xoá banner
     * @return  true false
     */

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $banner =  $this->model->with('Img')->findOrFail($id);
            $banner->delete();
            $path_img = $banner->img[0]->path;
            deleteImgFromFile('Banner' . "\\" . $path_img);
            $banner->img[0]->delete();
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

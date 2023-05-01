<?php

namespace App\Services\Guest\Liked;

use Exception;
use Throwable;
use App\Enums\TypeImgEnum;
use App\Models\LikeProduct;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;


class LikedService extends BaseService
{

    /**
     *Lấy danh lượt thích
     * @return  array
     */

    public function getLikeProduct()
    {

        $result = LikeProduct::with('Product')->where('user_id', Auth::user()->id)->get()->toArray();
        return $result;
    }

    /**
     *Lấy tổng só lượt thích
     * @return  array
     */

    public function quantityLiked()
    {
        if (!auth()->check()) {
            return 0;
        } else {
            $quantityLiked = LikeProduct::with('Product')->where('user_id', auth()->user() ? auth()->user()->id : 0)->count();
            return $quantityLiked;
        }
    }

    /**
     * @param Reuqest, $request
     *Thêm lượt thích sản phẩm
     * @return  true false
     */

    public function addLikeProduct($request)
    {
        try {
            if (Auth::check()) {
                $result = LikeProduct::where('product_id', $request->id,)
                    ->where('user_id',  Auth::user()->id)
                    ->exists();
                if ($result) {
                    throw new Exception('Bạn đã thích sản phẩm này rồi !');
                } else {
                    LikeProduct::create([
                        'product_id' => $request->id,
                        'user_id' => Auth::user()->id,
                        'status' => 1
                    ]);
                }
                return [
                    'success' => true,
                ];
            } else {
                throw new Exception('Bạn chưa đăng kí tài khoản !');
            }
        } catch (Throwable $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * @param id, $id
     *Xoá lượt thích
     * @return  true false
     */

    public function destroyLikeProduct($id)
    {
        try {
            LikeProduct::find($id)->delete();
            return [
                'success' => true,
            ];
        } catch (Throwable $e) {
            return [
                'success' => false,
                'error' => $e
            ];
        }
    }
}

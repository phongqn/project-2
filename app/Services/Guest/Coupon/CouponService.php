<?php

namespace App\Services\Guest\Coupon;

use Throwable;
use Exception;
use App\Models\Discount;
use App\Models\DiscountUser;
use App\Models\Notification;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;


class CouponService extends BaseService
{

    public function __construct(Discount $discount)
    {
        $this->model = $discount;
    }

    /**
     *Thông tin cửa hàng
     * @return  array
     */

    public function getNotification()
    {
        $notification = Notification::all();
        return $notification;
    }

    /**
     *Đăng kí nhận khuyến mãi
     * @return  array
     */

    public function getDiscount()
    {
        $discounts = $this->model->all()->toArray();
        return $discounts;
    }

    /**
     * @param Reuqest, $request
     *Đăng kí nhận khuyến mãi
     * @return  true false
     */

    public function registerCoupon($request)
    {
        try {
            $result = DiscountUser::where('discount_id', $request->id,)
                ->where('user_id',  Auth::user()->id)
                ->exists();
            if ($result) {
                throw new Exception('Bạn đã nhận phiếu giảm giá này rồi !');
            } else {
                DiscountUser::create([
                    'discount_id' => $request->id,
                    'user_id' => Auth::user()->id,
                ]);
            }
            return [
                'success' => true,
            ];
        } catch (Throwable $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}

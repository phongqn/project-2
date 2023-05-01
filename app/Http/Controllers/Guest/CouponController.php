<?php

namespace App\Http\Controllers\Guest;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Guest\Coupon\CouponService;

class CouponController extends Controller
{
    protected $couponService;

    public function __construct(CouponService $couponService)
    {
        $this->couponService = $couponService;
    }
    public function index()
    {
        $notification = $this->couponService->getNotification();
        $discounts = $this->couponService->getDiscount();
        $time_discount = Carbon::parse($discounts[0]['end']);
        $currentDateTime = Carbon::now();

        return view('guest/coupon/index', compact('notification', 'discounts', 'time_discount', 'currentDateTime'));
    }

    public function registerCoupon(Request $request)
    {
        $response = $this->couponService->registerCoupon($request);
        if (isset($response['error'])) {
            return redirect()->back()->with('error', $response['error']);
        } else {
            return redirect()->back()->with('success', 'Đăng kí thành công thành công');
        }
    }
}

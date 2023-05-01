<?php

namespace App\Services\Admin\Discount;

use Throwable;
use App\Models\Discount;
use App\Mail\UserDiscount;
use App\Models\DiscountUser;
use App\Services\BaseService;
use App\Jobs\SendUserDiscount;
use App\Jobs\SendAllUserDiscount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DiscountService extends BaseService
{
    public function __construct(Discount $discount)
    {
        $this->model = $discount;
    }

    /**
     * @param Request ,$request
     * Lấy tất mã giảm giá, tìm kiếm
     * @return  array
     */

    public function get_all($request)
    {
        $keyword = "";
        if ($request->input('q')) {
            $keyword = $request->input('q');
        }
        $discouts = $this->model
            ->where('name',  'LIKE', "%{$keyword}%")
            ->latest()
            ->paginate(10);
        return $discouts;
    }

    /**
     * @param Request ,$request
     * Tạo khách hàng
     * @return  true, flase
     */

    public function create($request)
    {
        try {
            $this->model->create([
                'name' => $request->name,
                'code' => $request->code,
                'price' => $request->price,
                'begin' => $request->begin,
                'end' => $request->end
            ]);
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
    /**
     * @param Request ,$request, $id
     * Cập nhật khách hàng
     * @return  true flase
     */

    public function update($id, $request)
    {
        try {
            $this->model->find($id)->update([
                'name' => $request->name,
                'code' => $request->code,
                'price' => $request->price,
                'begin' => $request->begin,
                'end' => $request->end
            ]);
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

    /**
     * @param id, $id
     *Xoá mã giảm giá
     * @return  true flase
     */


    public function destroy($id)
    {
        try {
            $this->model->find($id)->delete();
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
    /**
     *Lấy danh sách người đăng kí
     * @return  array
     */

    public function getRegisteredUser()
    {
        $discountUser = DiscountUser::all();
        return $discountUser;
    }

    /**
     * @param Request, $request
     *Gửi mail
     * @return  true flase
     */

    public function sendMail($request)
    {

        try {
            $userDiscount = json_decode($request->userDiscount);
            SendUserDiscount::dispatch($userDiscount);
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

    /**
     *Gửi mail
     * @return  true flase
     */

    public function sendAll()
    {
        try {
            $userAllDiscount = DiscountUser::with(['User', 'Discount'])->get()->toArray();
            SendAllUserDiscount::dispatch($userAllDiscount);
        } catch (Throwable $e) {
            return [
                'success' => false,
                'error' => $e
            ];
        }
    }
}

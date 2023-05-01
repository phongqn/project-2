<?php

namespace App\Services\Guest\Account;

use Throwable;
use App\Models\User;
use App\Models\Customer;
use App\Models\Notification;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class AccountService extends BaseService
{
    /**
     * Class constructor.
     */
    protected $customerModel;


    public function __construct(Customer $customerModel)
    {
        $this->customerModel = $customerModel;
    }

    /**
     *Lất thông tin cửa hàng
     * @return array
     */

    public function getNotification()
    {
        $notification = Notification::get();
        return $notification;
    }

    /**
     *Láy thông tin 1 người dùng
     * @return  array
     */

    public function findCustomer()
    {
        $account_id = Auth::user()->id;
        $customer = $this->customerModel->where('account_id', $account_id)->first();
        return $customer;
    }

    /**
     * @param Reuqest, $request
     *Cập nhật 1 người dùng
     * @return  true false
     */

    public function update($request)
    {
        try {
            $account_id = Auth::user()->id;
            $this->customerModel->where('account_id', $account_id)->update([
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'district' => $request->district,
                'country' => $request->country,
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
}

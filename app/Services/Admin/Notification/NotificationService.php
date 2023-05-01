<?php

namespace App\Services\Admin\Notification;

use Throwable;
use App\Models\Notification;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class NotificationService extends BaseService
{
    public function __construct(Notification $notification)
    {
        $this->model = $notification;
    }

    /**
     * @param Request $request
     * Cập nhật thông tin cửa hàng
     * @return  true flase
     */

    public function update($request)
    {

        try {
            $notification = $this->model->get();
            $this->model->find($notification[0]->id)->update([
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'map' => $request->map,
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

<?php

namespace App\Services\Admin\Customer;

use App\Models\Customer;
use Throwable;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class CustomerService extends BaseService
{
    public function __construct(Customer $customer)
    {
        $this->model = $customer;
    }

    /**
     * @param Request ,$request
     * Lấy tất cả khách hàng, tìm kiếm
     * @return  array
     */

    public function getAll($request)
    {
        $keyword = "";
        if ($request->input('q')) {
            $keyword = $request->input('q');
        }
        $customer = $this->model
            ->where('name',  'LIKE', "%{$keyword}%")
            ->latest()
            ->paginate(10);
        return $customer;
    }

    /**
     * @param id ,$id
     * Xoá khách hàng
     * @return  array
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
}

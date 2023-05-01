<?php

namespace App\Services\Admin\Supplier;

use Throwable;
use App\Models\Supplier;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;


class SupplierService extends BaseService
{
    /**
     * Class constructor.
     */
    public function __construct(Supplier $supplier)
    {
        $this->model = $supplier;
    }


    /**
     * @param Request, $request
     *Lấy tất cả nhà cung cấp
     * @return  array
     */

    public function get_all($request)
    {
        $keyword = "";
        if ($request->input('q')) {
            $keyword = $request->input('q');
        }
        $suppliers = $this->model
            ->where('name', 'LIKE', "%{$keyword}%")
            ->latest()
            ->paginate(10);
        return $suppliers;
    }

    /**
     * @param Request, $request
     *Tạo nhà cung cấp
     * @return  true, flase
     */

    public function create($request)
    {
        try {
            $this->model->create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'country' => $request->country
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
     * @param Request, $request,id
     *Cập nhật cung cấp
     * @return  true, flase
     */


    public function update($id, $request)
    {
        try {
            $this->model->find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'country' => $request->country
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
     *Xoá nhật cung cấp
     * @return  true, flase
     */

    public function delete($id)
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

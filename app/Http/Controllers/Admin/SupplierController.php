<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Supplier\SupplierRequest;
use App\Services\Admin\Supplier\SupplierService;
use Brian2694\Toastr\Facades\Toastr;

class SupplierController extends Controller
{
    //
    protected $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    public function index(Request $request)
    {
        $list_suppliers = $this->supplierService->get_all($request);
        return view('admin/supplier/index', compact('list_suppliers'));
    }

    public function create()
    {
        $list_suppliers = $this->supplierService->all();
        return view('admin/supplier/create', compact('list_suppliers'));
    }

    public function store(SupplierRequest $request)
    {
        $response = $this->supplierService->create($request);
        if (isset($response['error'])) {
            Toastr::error('Thông báo', 'Thêm nhà cung cấp thất bại');
            return redirect()->back();
        } else {
            Toastr::success('Thông báo', 'Thêm nhà cung cấp thành công');
            return redirect()->route('admin.supplier.index');
        }
    }

    public function edit($id)
    {
        $supplier = $this->supplierService->getById($id);
        return view('admin/supplier/edit', compact('supplier'));
    }

    public function update(SupplierRequest $request, $id)
    {
        $response = $this->supplierService->update($id, $request);
        if (isset($response['error'])) {
            Toastr::error('Thông báo', 'Cập nhật nhà cung cấp thất bại');
            return redirect()->back();
        } else {
            Toastr::success('Thông báo', 'Cập nhật cung cấp thành công');
            return redirect()->route('admin.supplier.index');
        }
    }

    public function destroy($id)
    {
        $response = $this->supplierService->delete($id);
        if (isset($response['error'])) {
            Toastr::error('Thông báo', 'Xoá nhà cung cấp thất bại');
            return redirect()->back();
        } else {
            Toastr::success('Thông báo', 'Xoá nhà cung cấp thành công');
            return redirect()->route('admin.supplier.index');
        }
    }
}

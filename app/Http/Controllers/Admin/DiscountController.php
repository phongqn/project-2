<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\Discount\DiscountRequest;

use App\Services\Admin\Discount\DiscountService;

class DiscountController extends Controller
{
    protected $discountService;

    public function __construct(DiscountService $discountService)
    {
        $this->discountService = $discountService;
    }

    public function index(Request $request)
    {
        $list_discounts = $this->discountService->get_all($request);
        return view('admin/discount/index', compact('list_discounts'));
    }

    public function create()
    {
        return view('admin/discount/create');
    }

    public function store(DiscountRequest $request)
    {
        $response = $this->discountService->create($request);
        if (isset($response['error'])) {
            Toastr::error('Thông báo', 'Thêm mã giảm giá thất bại');
            return redirect()->back();
        } else {
            Toastr::success('Thông báo', 'Thêm mã giảm giá thành công');
            return redirect()->route('admin.discount.index');
        }
    }

    public function edit($id)
    {
        $discount = $this->discountService->getById($id);
        return view('admin.discount.edit', compact('discount'));
    }

    public function update(DiscountRequest $request, $id)
    {
        $response = $this->discountService->update($id, $request);
        if (isset($response['error'])) {
            Toastr::error('Thông báo', 'Cập nhật mã giảm giá thất bại');
            return redirect()->back();
        } else {
            Toastr::success('Thông báo', 'Cập nhật mã giảm giá thành công');
            return redirect()->route('admin.discount.index');
        }
    }

    public function destroy($id)
    {
        $response = $this->discountService->destroy($id);
        Toastr::success('Thông báo', 'Cập nhật mã giảm giá thành công');
        if (isset($response['error'])) {
            Toastr::error('Thông báo', 'Xoá mã giảm giá thất bại');
            return redirect()->back();
        } else {
            Toastr::success('Thông báo', 'Xoá mã giảm giá thành công');
            return redirect()->route('admin.discount.index');
        }
    }

    public function registeredUser()
    {
        $user_registers = $this->discountService->getRegisteredUser();
        return view('admin/discount/registerUser', compact('user_registers'));
    }

    public function sendMail(Request $request)
    {
        $response = $this->discountService->sendMail($request);
        if (isset($response['error'])) {
            Toastr::error('Thông báo', 'Gửi mã thất bại');
            return redirect()->back();
        } else {
            Toastr::success('Thông báo', 'Gửi mã thành công thành công');
            return redirect()->route('admin.discount.registered_user');
        }
    }

    public function sendAll()
    {
        $response =  $this->discountService->sendAll();
        if (isset($response['error'])) {
            Toastr::error('Thông báo', 'Gửi mã thất bại');
            return redirect()->back();
        } else {
            Toastr::success('Thông báo', 'Gửi mã thành công thành công');
            return redirect()->route('admin.discount.registered_user');
        }
    }
}

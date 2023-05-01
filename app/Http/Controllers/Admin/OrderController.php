<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrderExport;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use App\Services\Admin\Customer\CustomerService;
use App\Services\Admin\Order\OrderService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request)
    {
        $response = $this->orderService->getData($request);
        $listUser = User::with('customer')->get()->toArray();
        return view('admin.order.index', ['orders' => $response, 'listUser' => $listUser]);
    }

    public function getData(Request $request)
    {
        $response = $this->orderService->getData($request);
        return $response;
    }

    public function updateStatus(Request $request)
    {
        if ($request->id && $request->status) {
            $response = $this->orderService->updateStatus($request->id, $request->status);
            if ($response['success']) {
                return $response['data'];
            }
        }
        return response()->json([
            'message' => 'Lỗi'
        ], 404);
    }

    public function detail($id)
    {
        if ($id) {
            $response = $this->orderService->detail($id);
            if ($response['success']) {
                return view('admin.order.order_detail', $response['data']);
            }
        }
        return response()->json([
            'message' => 'Lỗi'
        ], 404);
    }

    public function exportExcel($id)
    {
        $response = $this->orderService->exportExcel($id);
        return Excel::download(new OrderExport(
            $response['order'],
            $response['orderDetail'],
        ), 'HoaDon' . date('Y-m-d-His') . '.xlsx');
    }
}

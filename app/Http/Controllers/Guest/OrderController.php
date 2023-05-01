<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderRequest;
use App\Models\Cart;
use App\Models\Notification;
use App\Services\Guest\Cart\CartService;
use App\Services\Guest\Order\OrderService;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class OrderController extends Controller
{
    protected $orderService;
    
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $listOrder = $this->orderService->getOrders();
        return view('guest.order.index', ['listOrder' => $listOrder]);
    }

    public function create(OrderRequest $request)
    {

        $response = $this->orderService->create($request);
        if ($response['success']) {
            return redirect()->route('guest.account.index')->with('success', 'Thanh toán thành công');
        } else {
            return redirect()->back()->withInput($request->input())->with('error', 'Thanh toán thất bại');
        }
    }

    public function vnPayOnline(OrderRequest $request)
    {
        session()->put('infocusomer', $request->all());
        session()->save();
        $this->orderService->vnPay($request);
    }

    public function detail($id)
    {
        if ($id) {
            $response = $this->orderService->detail($id);
            if ($response['success']) {
                return view('guest.account.order_detail', $response['data']);
            }
        }
        return response()->json([
            'message' => 'Lỗi'
        ], 404);
    }

    public function cancel(Request $request)
    {
        $response = $this->orderService->cancel($request->id);
        if ($response['success']) {
            return $response['data'];
        } else {
            return response()->json([
                'message' => 'Lỗi'
            ], 404);
        }
    }
}

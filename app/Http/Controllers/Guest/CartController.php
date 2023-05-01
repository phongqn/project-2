<?php

namespace App\Http\Controllers\Guest;

use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Discount;
use App\Enums\PriceShipEnum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Services\Guest\Cart\CartService;
use App\Services\Guest\Home\HomeService;
use App\Services\Guest\Account\AccountService;
use App\Services\Guest\Contact\ContactService;

class CartController extends Controller
{
    protected $cartService;
    
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $data = $this->cartService->getDataCart();
        $data = ['listCart' => $data] + ['totalPrice' => $this->cartService->totalPrice()];
        return view('guest.cart.index', $data);
    }

    public function addToCart(Request $request)
    {
        if ($request->id && $request->quantity) {
            $response = $this->cartService->addToCart($request->id, $request->quantity);
            if ($response['success']) {
                return $response['data'];
            } else {
                return response()->json([
                    'message' => $response['error']
                ], 404);
            }
        }
        return response()->json([
            'message' => 'Thiếu dữ liệu cần thiết hoặc số lương không hợp lệ'
        ], 404);
    }

    public function delete(Request $request)
    {
        if ($request->id) {
            $response = $this->cartService->delete($request->id);
            if ($response['success']) {
                return $response['data'];
            } else {
                return response()->json([
                    'message' => $response['error']
                ], 404);
            }
        } else return response()->json([
            'message' => 'Thiếu dữ liệu cần thiết'
        ], 404);
    }

    public function update(Request $request)
    {
        if (!is_numeric($request->quantity) || $request->quantity < 0 || !$request->id) {
            return response()->json([
                'message' => 'Thất bại 11'
            ], 404);
        }
        $response = $this->cartService->update($request->quantity, $request->id);
        if ($response['success']) {
            return $response['data'];
        } else {
            return response()->json([
                'message' => $response['error']
            ], 404);
        }
    }

    public function checkOut(Request $request, AccountService $account)
    {
        // dd(!auth()->check()||auth()->guard('admin')->check());
        if (!auth()->check()) {
            return redirect()->route('guest.shop');
        }
        if ($this->cartService->totalPrice() <= 0 || $this->cartService->totalQuantity() <= 0) {
            return redirect()->route('guest.shop');
        }
        $infoCustomer = $account->findCustomer(auth()->user()->id);
        $data = $this->cartService->getDataCart();
        $response = $this->cartService->getDiscount($request->discountCode);
        $data = ['listCart' => $data] + $response['data'] + ['infoCustomer' => $infoCustomer]
            + ['totalPrice' => $this->cartService->totalPrice(), 'ship' => PriceShipEnum::URBAN];
        return view('guest.cart.check_out', $data);
    }

    public function discount(Request $request)
    {
        $response = $this->cartService->getDiscount($request->discount_code);
        if ($response['success']) {
            $res = $response['data'] + $response['message'] + ['totalPrice' => $this->cartService->totalPrice(), 'ship' => PriceShipEnum::URBAN];
            return $res;
        } else {
            return response()->json([
                'message' => 'Mã giảm giá đã tồn tại hoặc đã hết hạn',
                'data' => ['totalPrice' => $this->cartService->totalPrice(), 'ship' => PriceShipEnum::URBAN] + $response['data']
            ], 404);
        }
    }
}

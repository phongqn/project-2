<?php

namespace App\Services\Guest\Order;

use App\Enums\StatusOrderEnum;
use App\Jobs\SendOrderMail;
use App\Models\Cart;
use App\Models\DiscountUser;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use App\Services\BaseService;
use App\Services\Guest\Cart\CartService;
use Illuminate\Support\Facades\DB;
use Throwable;

class OrderService extends BaseService
{
    public function __construct(Order $order)
    {
        $this->model = $order;
    }

    public function getOrders()
    {
        return $this->model->where('user_id', auth()->user()->id)->get()->toArray();
    }

    public function create($request)
    {
        try {
            DB::beginTransaction();
            $cart = new CartService(new Cart());
            $dataCart = $cart->getDataCart();
            $discountId = 0;
            $discountPrice = 0;
            if ($request->discount_code) {
                $discount = DiscountUser::join('discounts', 'discounts.id', 'discount_user.discount_id')
                    ->where('discount_user.user_id', auth()->user()->id)
                    ->where('code', $request->discount_code)->select('discount_user.id', 'discounts.price')->first();
                DiscountUser::where('id', $discount->id)->update(['status' => 1]);
                $discountId = $discount ? $discount->id : 0;
                $discountPrice = $discount ? $discount->price : 0;
            }
            $dataOrder = $request->all() + [
                'user_id' => auth()->user()->id,
                'total_price' => $cart->totalPrice() - $discountPrice,
                'quantity' => array_sum(array_column($dataCart, 'quantity')),
                'discount_id' => $discountId,
                'type' => 1,
                'status' => StatusOrderEnum::PROCESSING
            ];
            // dd($dataOrder);
            $order = $this->model->create($dataOrder);
            $cartProduct = $cart->getDataCartProduct();
            // dd($cartProduct);
            foreach ($cartProduct as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['product_size'][0]['price_sell']
                ]);
            }
            $cart->deleteAll();
            $orderDetail = OrderDetail::where('order_id', $order->id)
                ->join('product_color', 'product_color.id', 'order_detail.product_id')
                ->join('product_size', 'product_size.id', 'product_color.product_size_id')
                ->join('products', 'products.id', 'product_size.product_id')
                ->select(DB::raw('products.name,product_size.price_sell,product_size.size,product_size.type_size,order_detail.quantity'))
                ->get()->toArray();
            $user = User::where('id', auth()->user()->id)->first()->toArray();
            // dd($user, $order, $orderDetail);
            SendOrderMail::dispatch($user, $order->toArray(), $orderDetail);
            DB::commit();
            return ['success' => true, 'data' => ['id' => $order->id]];
        } catch (Throwable $e) {
            DB::rollBack();
            dd($e);
            return ['success' => false, 'error' => $e];
        }
    }

    public function vnPay($request)
    {
        // dd($request->all());

        $total = CartService::getInstance()->totalPrice();
        $discountPrice = CartService::getInstance()->getDiscount($request->discountCode)['data']['discountPrice'];

        $bytes = random_bytes(20);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('guest.account.index');
        $vnp_TmnCode = "F23II7E9";
        $vnp_HashSecret = "IDBGMMVEEJDCAPTBLKHFXHTCUOVZIJZJ";

        $vnp_TxnRef = bin2hex($bytes);
        $vnp_OrderInfo = 'Thanh toán đơn hàng khanhdz';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = 1000 * (floatval($total) - floatval($discountPrice) + floatval($request->price_ship));
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            // $this->create($request);
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }

    public function detail($id)
    {
        try {
            $orderDetail = OrderDetail::with(['ProductSize' => function ($q) {
                $q->with('Product');
            }])->where('order_id', $id)->get();
            return ['success' => true, 'data' => [
                'orderDetails' => $orderDetail,
            ]];
        } catch (Throwable $e) {
            return ['success' => false, 'error' => 'Thất bại'];
        }
    }

    public function cancel($id)
    {
        try {
            $this->model->where('id', $id)->update(['status' => StatusOrderEnum::CANCELED]);
            return ['success' => true, 'data' => [
                'id' => $id
            ]];
        } catch (Throwable $e) {
            return ['success' => false, 'error' => 'Thất bại'];
        }
    }
}

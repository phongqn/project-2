<?php

namespace App\Services\Admin\Order;

use App\Enums\StatusOrderEnum;
use App\Exports\OrderExport;
use App\Jobs\SendOrderMail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Throwable;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class OrderService extends BaseService
{
    /**
     * Class constructor.
     */
    public function __construct(Order $order)
    {
        $this->model = $order;
    }


    /**
     * @param Request $request
     * Lấy thông tin 
     * @return  array
     */

    public function getData($request)
    {
        $order = $this->model->query();
        $status = [];
        foreach (StatusOrderEnum::getValues() as $item) {
            $status[] = ['id' => $item, 'name' => StatusOrderEnum::getName($item)];
        }
        return ['order' => $order->with('User')->get()->toArray(), 'status' => $status];
    }

    /**
     * @param id $id,$status
     * Cập nhật đơn hàng 
     * @return data , true flase
     */

    public function updateStatus($id, $status)
    {
        try {
            $order = $this->model->where('id', $id);
            $order->update(['status' => $status]);
            $user = User::where('id', $order->first()->user_id)->first()->toArray();
            SendOrderMail::dispatch($user, $order->first(), null, 2);
            return ['success' => true, 'data' => [
                'id' => $id,
                'status' => $status
            ]];
        } catch (Throwable $e) {
            return ['success' => false, 'error' => 'Thất bại'];
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

    public function exportExcel($id)
    {
        $order = Order::where('orders.id', $id)->join('users', 'users.id', 'orders.user_id');
        $orderDetail = $order->join('order_detail', 'order_detail.order_id', 'orders.id')
            ->join('product_color', 'product_color.id', 'order_detail.product_id')
            ->join('product_size', 'product_size.id', 'product_color.product_size_id')
            ->join('products', 'products.id', 'product_size.product_id')
            ->select(
                DB::raw(
                    'products.name as productName,
                order_detail.price as price,
                order_detail.quantity as count,
                product_size.size,
                product_size.type_size,
                (order_detail.price*order_detail.quantity) as totalPriceProduct'
                )
            )
            ->get();
        $order = $order->leftJoin('discount_user', 'discount_user.id', 'orders.discount_id')
            ->leftJoin('discounts', 'discounts.id', 'discount_user.discount_id')
            ->select(
                DB::raw('orders.*,users.name,ifnull(discounts.price,0) as dicountPrice')
            )->first()->toArray();
        return compact('order', 'orderDetail');
    }
}

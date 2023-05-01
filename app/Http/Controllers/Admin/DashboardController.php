<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $now = Carbon::now();
        $month = $now->month;
        $year = $now->year;
        $orders = Order::whereMonth('created_at', $month)->whereYear('orders.created_at', $year);
        $ordersnumber = $orders->count();
        $sales = $orders->sum('total_price');
        $customernumber = User::count();
        $topProduct = Product::with('Img')->join('product_size', 'product_size.product_id', 'products.id')
            ->join('product_color', 'product_color.product_size_id', 'product_size.id')
            ->join('order_detail', 'order_detail.product_id', 'product_color.id')
            ->groupBy('products.id', 'products.name')
            ->select(DB::raw('products.id, products.name,sum(order_detail.quantity) as count'))
            ->orderBy('count', 'desc')
            ->skip(0)->limit(5)
            ->get()->toArray();
        $topCustomer = User::join('orders', 'orders.user_id', 'users.id')
            ->join('customers', 'customers.account_id', 'users.id')
            ->groupBy('customers.name', 'customers.email', 'customers.phone')
            ->select(DB::raw('customers.name, customers.email, customers.phone,sum(orders.quantity) as count,sum(total_price)as totalPrice'))
            ->orderBy('count', 'desc')
            ->skip(0)->limit(5)
            ->get()->toArray();
        return view('admin/dashboard/index', compact('orders', 'ordersnumber', 'sales', 'customernumber', 'topProduct', 'topCustomer'));
    }
}

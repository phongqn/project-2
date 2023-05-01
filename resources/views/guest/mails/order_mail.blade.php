<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Email hóa đơn</title>
    <style>
        /* CSS cho phần header */
        .header {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        /* CSS cho phần thông tin khách hàng */
        .customer-info {
            padding: 10px;
            border: 1px solid #ccc;
        }

        /* CSS cho bảng thông tin sản phẩm */
        .product-info {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 10px;
        }

        .product-info td,
        .product-info th {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        .product-info th {
            background-color: #f2f2f2;
        }

        /* CSS cho phần tổng tiền */
        .total {
            text-align: right;
            margin-top: 10px;
        }

        .total span {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Email hóa đơn</h1>
    </div>
    <div class="customer-info">
        <h2>Thông tin khách hàng</h2>
        <p>Tên: {{ $user['name'] }}</p>
        <p>Email: {{ $user['email'] }}</p>
        <p>Địa chỉ: {{ $order['address'] }}</p>
    </div>
    <table class="product-info">
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderDetail as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ $item['price_sell'] }}</td>
                    <td>{{ $item['price_sell'] * $item['quantity'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="total">
        <span>Tổng tiền thanh toán:</span> {{ $order['total_price'] }} đồng
    </div>
</body>

</html>

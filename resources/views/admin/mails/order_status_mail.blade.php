<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trạng thái đơn hàng</title>
</head>
@php
    use App\Enums\StatusOrderEnum;
@endphp

<body>
    Xin chào {{ $user['name'] }},

    Đơn hàng ngày {{ date('d-m-Y', strtotime($order->created_at)) }} vừa được cập nhật trạng thái
    {{ StatusOrderEnum::getName($order->status) }}
</body>

</html>

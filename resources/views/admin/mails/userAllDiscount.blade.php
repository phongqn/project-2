<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail nhận mã</title>
</head>

<body>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        td:first-child {
            font-weight: bold;
        }

        .discount-table {
            background-color: #f5f5f5;
            border-radius: 8px;
            margin-bottom: 16px;
        }

        .discount-table td:last-child {
            font-weight: bold;
            color: #ff5722;
        }

        .thank-you {
            font-size: 18px;
            font-weight: bold;
            color: #008000;
            margin-top: 16px;
        }
    </style>

    <h1>Xin chào {{ $userAllDiscount[0]['user']['name'] }},</h1>
    <h3>Cám ơn bạn đã quan tâm tới chương trình khuyến mãi của tôi</h3>
    <table class="discount-table">
        <tr>
            <td>Tên mã:</td>
            <td>{{ $userAllDiscount[0]['discount']['name'] }}</td>
        </tr>
        <tr>
            <td>Mã giảm giá:</td>
            <td>{{ $userAllDiscount[0]['discount']['code'] }}</td>
        </tr>
        <tr>
            <td>Số tiền được giảm:</td>
            <td>{{ number_format( $userAllDiscount[0]['discount']['price'], 0, 0, ',') }}đ</td>
        </tr>
        <tr>
            <td>Ngày hết hạn:</td>
            <td>{{  $userAllDiscount[0]['discount']['end'] }}</td>
        </tr>
    </table>

    <p class="thank-you">
        Xin mời {{ $userAllDiscount[0]['user']['name'] }} hãy áp mã này vào phần thanh toán!
        Chúc bạn có trải nghiệm tốt nhất khi mua sắm!
        Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!
    </p>


</body>

</html>

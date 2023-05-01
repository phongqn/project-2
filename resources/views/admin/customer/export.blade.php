<table>
    <thead>
        <tr>
            <th>Stt</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th>Quận/Huyện</th>
            <th>Tỉnh/Thành phố</th>
            <th>Quốc gia</th>
        </tr>
    </thead>
    <tbody>
        @php
            $index = 0;
        @endphp
        @foreach ($customers as $customer)
            @php $index++; @endphp
            <tr>
                <td>{{ $index }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->phone }}</td>
                <td>{{ $customer->address }}</td>
                <td>{{ $customer->district }}</td>
                <td>{{ $customer->city }}</td>
                <td>{{ $customer->country }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

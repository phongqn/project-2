@php
    $index = 0;
    use App\Enums\TypeSizeEnum;
@endphp
@forelse ($orderDetails as $item)
    {{-- @php
        dd($item->ProductSize[0]->Product);
    @endphp --}}
    <tr>
        <td scope="row">{{ ++$index }}</td>
        <td scope="row"><img style="width: 100px;height:50px;"
                src="{{ asset('storage/ProductSize' . '/' . $item->productsize[0]->Thums()->path) }}" alt=""></td>
        <td>{{ $item->ProductSize[0]->Product->name }}</td>
        <td>{{ $item->productsize[0]->size }} {{ TypeSizeEnum::getName($item->productsize[0]->type_size) }}</td>
        <td>{{ $item->quantity }}</td>
        <td>{{ number_format($item->price) }} đ</td>
    </tr>
@empty
@endforelse

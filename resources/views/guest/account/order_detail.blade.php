@php
    $index = 0;
    use App\Enums\TypeSizeEnum;
@endphp
@forelse ($orderDetails as $item)
    <tr>
        <td scope="row text-center">{{ ++$index }}</td>
        <td scope="row text-center"><img style="width: 100px;height:50px;"
                src="{{ asset('storage/ProductSize' . '/' . $item->productsize[0]->Thums()->path) }}" alt=""></td>
        <td class="text-center">{{ $item->ProductSize[0]->Product->name }}</td>
        <td class="text-center">{{ $item->productsize[0]->size }}
            {{ TypeSizeEnum::getName($item->productsize[0]->type_size) }}</td>
        <td class="text-center">{{ $item->quantity }}</td>
        <td class="text-center">{{ number_format($item->price) }} đ</td>
    </tr>
@empty
@endforelse

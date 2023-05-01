 @foreach ($listColor as $item)
     <tr>
         <td class="text-center text-muted">{{ $item['color']['name'] }}</td>
         <td class="text-center"><input type="number" value={{ $item['quantity'] }} class="quantity-product-color"></td>
         <td class="text-center">
             <button data-id="{{ $item['color_id'] }}"
                 class="btn btn-hover-shine btn-outline-danger border-0 btn-sm delete-color" type="submit"
                 data-toggle="tooltip" title="Delete" data-placement="bottom">
                 <span class="btn-icon-wrapper opacity-8">
                     <i class="bi bi-trash"></i>
                 </span>
             </button>
             <button title="save" data-placement="bottom" data-id="{{ $item['id'] }}" disabled
                 class="btn btn-hover-shine btn-outline-success border-0 btn-sm update-quantity-color">
                 <span class="btn-icon-wrapper opacity-8">
                     <i class="bi bi-save-fill"></i>
                 </span>
             </button>
         </td>
     </tr>
 @endforeach

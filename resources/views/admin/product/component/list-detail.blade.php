  <div class="col-md-12 form-update-detail">
      <div class="position-relative row form-group mb-1 mt-2">
          <div class="col-md-12 text-right col-xl-12">
              <a href="{{ route('admin.product.product_size.create', ['id' => $idProduct]) }}" type="button"
                  id="update" class="btn-shadow btn-hover-shine btn btn-warning">
                  <span class="btn-icon-wrapper pr-2 opacity-8">
                      <i class="bi bi-tools"></i>
                  </span>
                  <span>Sửa</span>
              </a>
          </div>
      </div>
      @php
          use App\Enums\TypeSizeEnum;
      @endphp
      <table class="align-middle mb-0 table table-borderless table-striped table-hover">
          <thead>
              <tr>
                  <th class="text-center">ID</th>
                  <th class="text-center">Ảnh</th>
                  <th class="text-center">Dung lượng</th>
                  <th class="text-center">Giá nhập</th>
                  <th class="text-center">Giá bán</th>
                  <th class="text-center">Số lượng</th>
                  <th class="text-center">Màu sắc</th>
                  {{-- <th class="text-center">Actions</th> --}}
              </tr>
          </thead>

          <tbody id="list">
              @php
                  $id = 0;
              @endphp
              @forelse ($listDetail as $item)
                  <tr id="item-{{ $item['id'] }}">
                      <td class="text-center item-price_import">{{ $id++ }}</td>
                      <td class="text-center text-muted"><img
                              src="{{ asset('storage/ProductSize' . '/' . $item['img'][0]['path']) }}" alt=""
                              style="width: 80px;height: 80px;">
                      </td>
                      <td class="text-center text-muted item-capacity">
                          {{ $item['size'] . ' ' . TypeSizeEnum::getName($item['type_size']) }}
                      </td>
                      <td class="text-center item-price_import">{{ $item['price_import'] }} đ</td>
                      <td class="text-center item-price_sell">{{ $item['price_sell'] }} đ</td>
                      <td class="text-center {{ 'quantity-' . $item['id'] }}">
                          {{ array_sum(array_column($item['product_color'], 'quantity')) }}
                      </td>
                      <td class="text-center {{ 'quantity-' . $item['id'] }}">
                          {{ implode(',', array_column($item['color'], 'name')) ? implode(',', array_column($item['color'], 'name')) : 'Chưa có chiết sản phẩm' }}
                      </td>
                      {{-- <td class="text-center">
                     <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm remove" type="button"
                         data-toggle="tooltip" title="Delete" data-placement="bottom" data-id="{{ $item['id'] }}">
                         <span class="btn-icon-wrapper opacity-8">
                             <i class="bi bi-trash"></i>
                         </span>
                     </button>
                 </td> --}}
                  </tr>

              @empty
                  <tr class="empty-data">
                      <td colspan="6" class="text-center" id="notdata">hiện không có dữ liệu
                      </td>
                  </tr>
              @endforelse

          </tbody>
      </table>
  </div>

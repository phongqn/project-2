 <script>
     $(document).ready(function() {

         $(document).on('change', '.quantity-input', function() {
             let newVal = parseInt($(this).val())
             let olVal = parseInt($(this).attr('data-old'))
             let ele = $(this)
             let quantityInstock = parseInt($(this).attr('data-quantityinstock'))
             console.log(newVal >= 0)
             if ((olVal + quantityInstock) < newVal || newVal < 0 || isNaN(newVal)) {
                 $(this).val(olVal)
                 if (newVal < 0) {
                     Swal.fire({
                         icon: 'warning',
                         title: 'Số lượng nhập không hợp lệ',
                         showConfirmButton: false,
                         timer: 1500
                     })
                 } else {
                     Swal.fire({
                         icon: 'warning',
                         title: 'Vượt quá số lượng cho phép',
                         showConfirmButton: false,
                         timer: 1500
                     })
                 }

             } else {
                 let id = $(this).attr('data-id')
                 updateProductCart(id, newVal, ele, olVal)
             }
         })

         // Product Quantity
         $('.quantity button').on('click', function(e) {
             e.stopPropagation();
             var button = $(this);
             var oldValue = button.parent().parent().find('input').val();
             let quantityInStock = parseInt(button.parent().parent().find('input').attr(
                 'data-quantityinstock'))
             let id = button.parent().parent().find('input').attr('data-id')
             if (button.hasClass('btn-plus')) {
                 if (quantityInStock <= 0) {
                     Swal.fire({
                         icon: 'warning',
                         title: 'Vượt quá số lượng cho phép',
                         showConfirmButton: false,
                         timer: 1500
                     })
                     var newVal = parseFloat(oldValue);
                 } else {
                     var newVal = parseFloat(oldValue) + 1;
                     updateProductCart(id, newVal, button.parent().parent().find('input'), oldValue)
                 }
             } else {
                 if (oldValue > 0) {
                     var newVal = parseFloat(oldValue) - 1;
                     updateProductCart(id, newVal, button.parent().parent().find('input'), oldValue)
                 } else {
                     newVal = 0;
                 }
             }
             // button.parent().parent().find('input').val(newVal);
         });

         $(document).on('click', '.remove', function() {
             let id = $(this).attr('data-id')
             let ele = $(this)
             $.ajax({
                 url: "{{ route('guest.cart.delete') }}",
                 type: 'DELETE',
                 data: {
                     "_token": "{{ csrf_token() }}",
                     id: id
                 },
                 success: function(result) {
                     console.log(result);
                     ele.closest('.item').remove()

                     $('.subtotal').text(Intl.NumberFormat('en-VN')
                         .format(result['totalPrice']) + ' đ')
                     if (result['totalPrice'] <= 0) {
                         $('.checkout').attr('disabled', true)
                     }
                     $('.total-price-cart').text(Intl.NumberFormat('en-VN')
                         .format(result['totalPrice']) + ' đ')
                     $('.badge').text(result['totalQuantity'])
                     Swal.fire({
                         icon: 'success',
                         title: 'Xóa thành công',
                         showConfirmButton: false,
                         timer: 1500
                     })
                 },
                 error: function(error) {
                     Swal.fire({
                         icon: 'error',
                         title: 'Xóa thất bại',
                         showConfirmButton: false,
                         timer: 1500
                     })
                 }
             })
         })

         function updateProductCart(id, quantity, ele, olVal) {
             $.ajax({
                 url: "{{ route('guest.cart.update') }}",
                 type: 'PUT',
                 data: {
                     "_token": "{{ csrf_token() }}",
                     id: id,
                     quantity: quantity
                 },
                 success: function(result) {
                     console.log(result);
                     if (result['delete']) {
                         ele.closest('.item').remove()
                     } else {
                         ele.attr('data-old', result['quantity'])
                         ele.attr('data-quantityinstock', result['quantityInStock'])
                         ele.val(result['quantity'])
                         ele.closest('.item').find('.total-price').text(Intl.NumberFormat('en-VN')
                             .format(result['quantity'] * result['price']) + ' đ')
                         if (result['totalPrice'] <= 0) {
                             $('.checkout').attr('disabled', true)
                         } else {
                             $('.checkout').attr('disabled', false)
                         }

                     }
                     $('.badge').text(result['totalQuantity'])
                     $('.subtotal').text(Intl.NumberFormat('en-VN')
                         .format(result['totalPrice']) + ' đ')
                     $('.total-price-cart').text(Intl.NumberFormat('en-VN')
                         .format(result['totalPrice']) + ' đ')

                 },
                 error: function(error) {
                     alert('qua so luwong cho phep')
                     console.log('www', error);
                     ele.val(olVal)
                 }
             })
         }

         function updateButtonCheckOut($check) {
             $('.check').attr('disabled', check)
         }
     })
 </script>

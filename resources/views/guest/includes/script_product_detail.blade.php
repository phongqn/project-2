 <script>
     $(document).ready(function() {
         $(document).on('change', '.color', function() {
             console.log($(this).val())
             let id = $(this).val()
             var url = '{{ route('guest.product.quantity_product_color', ':id') }}';
             url = url.replace(':id', id);
             $.ajax({
                 url: url,
                 type: 'GET',
                 success: function(result) {
                     console.log(result);
                     $('#quantity').text(result)
                     if (parseInt(result) <= 0) {
                         disabledAddToCart(true)
                     } else {
                         disabledAddToCart(false)
                     }
                 },
                 error: function(error) {
                     console.log('www', error);
                 }
             })
         })

         function disabledAddToCart(check) {
             $('.quantity button').attr('disabled', check)
             $('#count').attr('disabled', check)
             $('.add-to-cart').attr('disabled', check)
         }
         $(document).on('change', '#count', function() {
             console.log($(this).val())
             let max = parseInt($('#quantity').text())
             let data = parseInt($(this).val())
             if (isNaN(data) || data <= 0) {
                 Swal.fire({
                     icon: 'warning',
                     title: 'Vui lòng nhập số lượng hợp lệ',
                     showConfirmButton: false,
                     timer: 1500
                 })
                 $('#count').val(1)
             }
             if (data > max) {
                 Swal.fire({
                     icon: 'warning',
                     title: 'Vượt quá số lượng trong kho',
                     showConfirmButton: false,
                     timer: 1500
                 })
                 $('#count').val(parseInt($('#quantity').text()))
             }
             // if (isNaN(data)) {
             //     $(this).val(1);
             // } else {
             // $.ajax({
             //     url: ,
             //     type: 'GET',
             //     success: function(result) {
             //         console.log(result);
             //         $('#quantity').text(result)
             //     },
             //     error: function(error) {
             //         console.log('www', error);
             //     }
             // })
             // }
         })
         // Product Quantity
         $('.quantity button').on('click', function() {
             var button = $(this);
             var oldValue = parseInt($('#count').val());
             var max = parseInt($('#quantity').text())
             console.log(max)
             if (button.hasClass('btn-plus')) {
                 if (oldValue + 1 > max) {
                     Swal.fire({
                         icon: 'warning',
                         title: 'Vượt quá số lượng trong kho',
                         showConfirmButton: false,
                         timer: 1500
                     })
                     var newVal = oldValue
                 } else var newVal = parseFloat(oldValue) + 1;
             } else {
                 if (oldValue > 0) {
                     var newVal = parseFloat(oldValue) - 1;
                 } else {
                     newVal = 0;
                 }
             }
             $('#count').val(newVal);
         });
         $('.add-to-cart').on('click', function() {
             // Swal.fire({
             //     icon: 'success',
             //     title: 'Thêm giỏ hàng thành công',
             //     showConfirmButton: false,
             //     timer: 1500
             // })
             console.log($('.color:checked').val())
             let quantity = $('#count').val()
             let id = $('.color:checked').val()
             // var url = '{{ route('guest.cart.add_to_cart', ':id') }}';
             // url = url.replace(':id', id);
             $.ajax({
                 url: "{{ route('guest.cart.add_to_cart') }}",
                 type: 'POST',
                 data: {
                     "_token": "{{ csrf_token() }}",
                     id: id,
                     quantity: quantity
                 },
                 success: function(result) {
                     console.log(result)
                     $('#count').val(0)
                     $('#quantity').text(result.quantityInStock)
                     if (!result.quantityInStock) {
                         console.log('dddd')
                         disabledAddToCart(true)
                     } else {
                         console.log('tt')
                         disabledAddToCart(false)
                     }
                     Swal.fire({
                         icon: 'success',
                         title: 'Thêm giỏ hàng thành công',
                         showConfirmButton: false,
                         timer: 1500
                     })
                     $('.badge').text(result.totalQuantity)
                 },
                 error: function(error) {
                     Swal.fire({
                         icon: 'error',
                         title: 'Thêm giỏ hàng thất bại',
                         showConfirmButton: false,
                         timer: 1500
                     })
                     console.log('www', error);
                 }
             })
         })

     });
 </script>

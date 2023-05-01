   <script type="text/javascript">
       $(document).ready(function() {
           var imagesPreview = function(input, placeToInsertImagePreview) {

               if (input.files) {
                   var filesAmount = input.files.length;

                   for (i = 0; i < filesAmount; i++) {
                       var reader = new FileReader();

                       reader.onload = function(event) {
                           $($.parseHTML('<img class="col-2 img-product mt-2 mb-2">')).attr('src', event
                                   .target
                                   .result)
                               .appendTo(
                                   placeToInsertImagePreview);
                       }

                       reader.readAsDataURL(input.files[i]);
                   }
               }

           };

           $('#imageUpload').on('change', function() {
               $('div.listphoto').empty()
               imagesPreview(this, 'div.listphoto');
           });



           //gửi request tạo sản phẩm trong bảng productsize
           $('#save').on('click', function() {
               const obj = $('#formdata');
               const formData = new FormData(obj[0]);
               $.ajax({
                   url: obj.attr('action'),
                   type: 'POST',
                   data: formData,
                   processData: false,
                   contentType: false,
                   async: false,
                   cache: false,
                   enctype: 'multipart/form-data',
                   success: function(result) {
                       $('.emty-data').remove()
                       $('#notdata').remove()
                       console.log('gia tri nhan duwojc sau kho goi view: ', result)
                       $('#list').append(result);
                       $('#formdata').find('.input').val(null);
                       $('#formdata').find('.error').text('')
                       // document.getElementById('output').src = '';
                       $('div.listphoto').empty()
                       Swal.fire({
                           icon: 'success',
                           title: 'Thêm thành công',
                           showConfirmButton: false,
                           timer: 1500
                       })
                   },
                   error: function(error) {
                       console.log('www', error);
                       $('#formdata').find('.error').text('')
                       object = error.responseJSON ? error.responseJSON.errors : {}
                       for (const property in object) {
                           $('#formdata').find('.error-' + property).text(object[property][0])
                           console.log(`${property}: ${object[property][0]}`);
                       }
                   }
               })
           })


           //thêm màu và số lượng cho tưng chi tiết sản phẩm
           $('#savecolor').on('click', function() {
               console.log('co chay nha')
               const obj = $('#formcolor');
               const formData = new FormData(obj[0]);
               $.ajax({
                   url: obj.attr('action'),
                   type: 'POST',
                   data: formData,
                   processData: false,
                   contentType: false,
                   async: false,
                   cache: false,
                   enctype: 'multipart/form-data',
                   success: function(result) {
                       let quantityClass = '.quantity-' + $('#productid').val();
                       let quanitty = parseInt($(quantityClass).text()) + parseInt($(
                           '#quantity').val())
                       $(quantityClass).text(quanitty)
                       $('#formcolor').find('.error').text('')
                       $('#formcolor').find('.input').val(null);
                       $('#formcolor').find('select').val(null);
                       $('#formcolor').find('.error').text('')
                       $('.listphoto').empty();
                       Swal.fire({
                           icon: 'success',
                           title: 'Thêm thành công',
                           showConfirmButton: false,
                           timer: 1500
                       })
                       $('#closeColor').trigger('click')
                   },
                   error: function(error) {
                       console.log('www', error);
                       $('#formcolor').find('.error').text('')
                       object = error.responseJSON ? error.responseJSON.errors : {}
                       for (const property in object) {
                           $('#formcolor').find('.error-' + property).text(object[property][0])
                       }
                       Swal.fire({
                           icon: 'error',
                           title: 'Thêm thất bại',
                           showConfirmButton: false,
                           timer: 1500
                       })

                   }
               })
           })

           //thay đổi product_id trong form thêm màu cho chi tiết sản phẩm
           $(document).on('click', '.add-color', function(event) {
               let id = $(this).attr('data-id')
               $('#productid').val(parseInt(id))
           })
           //lấy chi tiết sản phẩm
           $(document).on('click', '.list-color', function() {
               console.log('co chay nha')
               let id = $(this).attr('data-id')
               $('#productSizeId').val(id)
               var url = '{{ route('admin.product.product_color.list_color', ':id') }}';
               url = url.replace(':id', id);
               console.log(url)
               $.ajax({
                   url: url,
                   type: 'GET',
                   success: function(result) {
                       $('#listColor').empty();
                       $('#listColor').append(result);
                   },
                   error: function(error) {
                       console.log('www', error);
                   }
               })
           })
           //remove color
           $(document).on('click', '.delete-color', function() {
               console.log('co chay nha')
               let product_size_id = $('#productSizeId').val()
               let color_id = $(this).attr('data-id')
               console.log('color_id', color_id, product_size_id)
               let obj = $(this);

               $.ajax({
                   url: "{{ route('admin.product.product_color.delete') }}",
                   type: 'DELETE',
                   data: {
                       "_token": "{{ csrf_token() }}",
                       product_size_id: product_size_id,
                       color_id: color_id
                   },
                   success: function(result) {
                       console.log(result)
                       obj.closest('tr').remove()
                       Swal.fire({
                           icon: 'success',
                           title: 'Xóa thành công',
                           showConfirmButton: false,
                           timer: 1500
                       })
                       let quantity = parseInt($('.quantity-' + product_size_id).text())
                       $('.quantity-' + product_size_id).text(quantity - parseInt(result.data
                           .quantity))
                       $('#closeUpdateColor').trigger('click')
                   },
                   error: function(error) {
                       console.log('www', error.responseJSON.message);
                       Swal.fire({
                           icon: 'error',
                           title: error.responseJSON.message,
                           showConfirmButton: false,
                           timer: 1500
                       })
                   }
               })
           })

           $(document).on('change', '.quantity-product-color', function() {
               $(this).parent().next().find('.update-quantity-color').attr('disabled', false)
           })

           $(document).on('click', '.update-quantity-color', function() {
               //    let product_size_id = $('#productSizeId').val()
               let id = $(this).attr('data-id')
               let quantity = $(this).parent().prev().find('.quantity-product-color').val()
               let obj = $(this)
               $.ajax({
                   url: "{{ route('admin.product.product_color.update') }}",
                   type: 'PUT',
                   data: {
                       "_token": "{{ csrf_token() }}",
                       //    product_size_id: product_size_id,
                       //    color_id: color_id,
                       id: id,
                       quantity: quantity
                   },
                   success: function(result) {
                       obj.attr('disabled', true)
                       $('.quantity-' + result['data']['id']).text(result['data']['quantity'])
                       Swal.fire({
                           icon: 'success',
                           title: 'Cập nhật thành công',
                           showConfirmButton: false,
                           timer: 1500
                       })
                   },
                   error: function(error) {
                       console.log('www', error);
                       Swal.fire({
                           icon: 'error',
                           title: 'Cập nhật thất bại',
                           showConfirmButton: false,
                           timer: 1500
                       })
                   }
               })
           })
           //update detail
           $(document).on('click', '.update-detail', function() {
               let id = $(this).attr('data-id')
               var url = '{{ route('admin.product.product_size.edit', ':id') }}';
               url = url.replace(':id', id);
               console.log(url)
               $.ajax({
                   url: url,
                   type: 'GET',
                   success: function(result) {
                       console.log(result);
                       $('.form-update-detail').empty();
                       $('.form-update-detail').append(result);
                   },
                   error: function(error) {
                       console.log('www', error);
                   }
               })
           })

           function removeImg(id, obj) {
               console.log('chayj nhasssss')
               $.ajax({
                   url: "{{ route('admin.product.product_size.detele_img') }}",
                   type: 'DELETE',
                   data: {
                       "_token": "{{ csrf_token() }}",
                       id: id,
                   },
                   success: function(result) {
                       console.log('ddd', result);
                       obj.closest('div').remove()
                       Swal.fire({
                           icon: 'success',
                           title: 'Xóa thành công',
                           showConfirmButton: false,
                           timer: 1500
                       })
                   },
                   error: function(error) {
                       console.log('www', error);
                   }
               })
           }
           $(document).on('click', '.remove-img', function() {
               removeImg(parseInt($(this).attr('data-id')), $(this))
           })
           $(document).on('click', '#update', function() {
               console.log('co chay nha')
               const obj = $('#formProductSize');
               let id = obj.find('.id-product').val()
               const formData = new FormData(obj[0]);
               $.ajax({
                   url: obj.attr('action'),
                   type: 'POST',
                   data: formData,
                   processData: false,
                   contentType: false,
                   async: false,
                   cache: false,
                   enctype: 'multipart/form-data',
                   success: function(result) {

                       $('#formProductSize').find('.error').text('')
                       $('#item-' + id).find('.item-size').text(obj.find(
                               '.size-update')
                           .val() + ' ' + $('#typeSize').find(":selected").text())
                       $('#item-' + id).find('.item-price_import').text(obj.find(
                           '.price_import-update').val())
                       $('#item-' + id).find('.item-price_sell').text(obj.find(
                           '.price_sell-update').val())
                       Swal.fire({
                           icon: 'success',
                           title: 'Cập nhật thành công',
                           showConfirmButton: false,
                           timer: 1500
                       })
                       $('#closeDetial').trigger('click')
                   },
                   error: function(error) {
                       $('#formProductSize').find('.error').text('')
                       console.log('www', error);
                       object = error.responseJSON ? error.responseJSON.errors : {}
                       for (const property in object) {
                           $('#formProductSize').find('.error-' + property).text(object[
                               property][0])
                           console.log(`${property}: ${object[property][0]}`);
                       }
                       Swal.fire({
                           icon: 'error',
                           title: 'Cập nhật thất bại',
                           showConfirmButton: false,
                           timer: 1500
                       })
                   }
               })
           })

           //remove product detail item
           $(document).on('click', '.remove', function() {

               const obj = $(this);
               let id = obj.attr('data-id')
               console.log('co chay nha', id)
               $.ajax({
                   url: "{{ route('admin.product.product_size.detele') }}",
                   type: 'DELETE',
                   data: {
                       "_token": "{{ csrf_token() }}",
                       id: id
                   },
                   success: function(result) {
                       obj.closest('tr').remove()
                       console.log(result)
                       console.log(result['data']['isEmpty'])
                       if (!result['data']['isEmpty']) {
                           let inner =
                               `<tr><td class="text-center" colspan="5">Không có dữ liệu</td></tr>`;
                           $('#list').append(inner);
                       }
                       Swal.fire({
                           icon: 'success',
                           title: 'Xóa thành công',
                           showConfirmButton: false,
                           timer: 1500
                       })
                   },
                   error: function(error) {
                       console.log('www', error);
                   }
               })
           })
       })
   </script>

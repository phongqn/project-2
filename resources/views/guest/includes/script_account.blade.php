 <script>
     $(document).ready(function() {
         $(document).on('click', '.detail', function() {
             let id = $(this).attr('data-id')
             var url = '{{ route('guest.order.detail', ':id') }}';
             url = url.replace(':id', id);
             console.log(url)
             $.ajax({
                 url: url,
                 type: 'GET',
                 success: function(result) {
                     $('.list-detail').empty();
                     $('.list-detail').append(result);
                 },
                 error: function(error) {
                     console.log('www', error);
                 }
             })
         })

         $(document).on('click', '.cancel', function() {
             let id = $(this).attr('data-id')
             let ele = $(this)
             $.ajax({
                 url: "{{ route('guest.order.cancel') }}",
                 type: 'POST',
                 data: {
                     "_token": "{{ csrf_token() }}",
                     id: id
                 },
                 success: function(result) {
                     ele.closest('.item-order').find('.status').text('Đã hủy')
                     ele.remove()
                     Swal.fire({
                         icon: 'success',
                         title: 'Hủy thành công',
                         showConfirmButton: false,
                         timer: 1500
                     })
                 },
                 error: function(error) {
                     console.log('www', error);
                     Swal.fire({
                         icon: 'error',
                         title: 'Hủy thất bại',
                         showConfirmButton: false,
                         timer: 1500
                     })
                 }
             })
         })
     })
 </script>

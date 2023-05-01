  <script>
      $(document).ready(function() {
          var listBrand = '';
          var listCategories = '';
          var name = '';
          showProduct()
          $(document).on('change', '.category', function() {
              console.log($(this).val())
              listCategories = $('.category:checked').val()
              showProduct()
          })
          $(document).on('change', '.brand', function() {
              listBrand = ''
              let i = 0;
              $(".brand:checked").each(function() {
                  if (i == 0) {
                      listBrand += $(this).val()
                      i++;
                  } else
                      listBrand += "-" + $(this).val()

              });
              console.log(listBrand)
              showProduct()
          })
          $(document).on('click', '.search', function() {
              name = $('#name').val().trim();
              console.log(name)
              showProduct()
          })

          function showProduct() {
              $.ajax({
                  url: "{{ route('guest.product.list_product') }}" + "?brands=" + listBrand +
                      "&categories=" + listCategories + "&name=" + name,
                  type: 'GET',
                  success: function(result) {
                      console.log('dddasfasd', result.length);
                      if (result.length > 0) {
                          $('#pagination').pagination({
                              dataSource: result,
                              pageSize: 6,
                              formatResult: function(data) {

                              },
                              callback: function(list, pagination) {
                                  let inner = ''
                                  console.log(result)
                                  list.forEach(element => {
                                      console.log(element.product_size)
                                      let name = element.name;
                                      let id = element.id
                                      let price = Intl.NumberFormat('en-VN')
                                          .format(
                                              element.product_size[0].price_sell)
                                      let img = element.img[0].path;
                                      let slug = element.slug;

                                      // let sizes = element.product_size.map(a =>
                                      //     a.size + ' ' + a.name_size).join(',');

                                      let index = 1;
                                      let sizes = element.product_size.map(
                                          function(a) {
                                              console.log(a)
                                              return `<div class="sc-item">
                                        <label for="sm-size" data-id=${a.id}
                                            data-price=${a.price_sell}
                                            data-url=${slug}/size:${a.size}-${a.type_size}/shop-detail
                                            data-img=${a.img[0]['path']}
                                            class="${index++==1?'active':''}">
                                            ${ a.size } ${a.name_size}</label>
                                    </div>`;
                                          }).join('');

                                      let ProductDetailFirst = element
                                          .product_size[
                                              0].id;
                                      let size = element.product_size[0]['size'];
                                      let typeSize = element.product_size[0][
                                          'type_size'
                                      ];
                                      //${sizes} <h7></h7>
                                      var url =
                                          `${slug}/size:${size}-${typeSize}/shop-detail`
                                      inner += `<div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                                <div class="card product-item border-0 mb-4 item-product">
                                    <div
                                        class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                        <img class="img-fluid w-100 img-product"
                                            src="{{ asset('storage/Product') }}/${img}"
                                            alt="">
                                    </div>
                                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3 item-info">
                                        <h6 class="text-truncate mb-3">${name}</h6>
                                        <div class="d-flex justify-content-center list-size">
                                           ${sizes}
                                        </div>
                                        <div class="d-flex justify-content-center price">
                                            <h6>${price} đ</h6>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-center bg-light border action">
                                        <a href="${url}" class="btn btn-sm text-dark p-0 detail"><i
                                                class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                    </div>
                                </div>
                            </div>`
                                  });
                                  $('.list-product').empty()
                                  $('.list-product').append(inner);
                              }
                          })
                      } else {
                          $('.list-product').empty()
                          $('.list-product').append('<div class="notData">Không có dữ liệu</div>');
                      }
                  },
                  error: function(error) {
                      console.log('www', error);
                  }
              })
          }
          // $(document).on('click', '.add-to-cart', function() {
          //     console.log($(this).closest('.action').prev().find('.active'))
          //     let id = $(this).closest('.action').prev().find('.active').attr('data-id')
          //     console.log(id)
          //     let url = `/cart/${id}/add-to-cart?quantity=1`;
          //     $.ajax({
          //         url: url,
          //         type: 'GET',
          //         success: function(result) {
          //             console.log(result);
          //         },
          //         error: function(error) {
          //             console.log('www', error);
          //         }
          //     })
          // })
          $(document).on('click', '.sc-item', function() {
              $(this).closest('.list-size').find('.active').removeClass('active')
              $(this).find('label').addClass('active')
              let elementActive = $(this).find('label').addClass('active')
              let url = elementActive.attr('data-url')
              console.log(url)
              console.log($(this).find('label').attr('data-price'))
              $(this).closest('.item-product').find('.action').find('.detail').attr('href', url)
              let price = Intl.NumberFormat('en-VN').format(parseFloat($(this).find('label').attr(
                  'data-price'))) + ' đ'
              $(this).closest('.item-info').find('.price').find('h6').text(price)
              let img = elementActive.attr('data-img')
              $(this).closest('.item-product').find('img').attr('src',
                  "{{ asset('storage/ProductSize') }}/" +
                  img)
          })

      });
  </script>

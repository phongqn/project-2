<script>
    $(document).ready(function() {

        function setValueSelect(e, data) {
            console.log(e.find("option[value='" + data + "']").length)
            if (e.find("option[value='" + data + "']").length) {
                e.val(data).trigger('change');
            }
        }

        $('.apply-discount').on('click', function() {
            let discount_code = $('.discount-code').val()
            $.ajax({
                url: "{{ route('guest.cart.discount') }}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    discount_code: discount_code
                },
                success: function(result) {
                    console.log(result)
                    $('.discount-price').text(Intl.NumberFormat('en-VN')
                        .format(result.discountPrice) + ' đ')
                    $('.total-price').text(Intl.NumberFormat('en-VN')
                        .format(parseInt(result.totalPrice) - parseInt(result
                            .discountPrice) + parseInt(result.ship)) +
                        ' đ')
                    $('.discount-code').val(result.discountCode)
                    $('#discountCode').val(result.discountCode)
                    Swal.fire({
                        icon: result.icon,
                        title: result.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                },
                error: function(error) {
                    console.log(error)
                    $('.discount-price').text(0 + ' đ')
                    $('.total-price').text(Intl.NumberFormat('en-VN')
                        .format(parseInt(error.responseJSON.data.totalPrice) - parseInt(
                            error.responseJSON.data.discountPrice) + parseInt(error
                            .responseJSON.data.ship)) +
                        ' đ')
                    $('.discount-code').val('')
                    Swal.fire({
                        icon: result.icon,
                        title: result.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            })
        })

        async function loadDistrict(path) {
            $(".district").empty()
            const response = await fetch('{{ asset('location/data') }}' + '/' + path);
            const districts = await response.json();
            let string = '';
            // const selectedValue = $(".district").val();
            const selectedValue = "{{ !empty(old('district')) ? old('district') : '' }}";
            console.log(path)
            $.each(districts.district, function(index, each) {
                if (each.pre === 'Quận' || each.pre === 'Huyện') {
                    string +=
                        `<option value='${each.name}' ${each.name==selectedValue?'selected':''}>${each.name}</option>`;
                }
            })
            $(".district").append(string);
            $('.district').val(null).trigger('change');
            let olddistric = "{{ !empty(old('district')) ? old('district') : '' }}"

            if (olddistric) {
                setValueSelect($('.district'), olddistric);
            } else if (district) {
                setValueSelect($('.district'), district);
            }

        }
        async function insertCity() {
            const response = await fetch('{{ asset('location/index.json') }}');
            const cities = await response.json();
            console.log(cities)
            $.each(cities, function(index, each) {
                $(".city").append(`
                    <option value='${index}' data-path='${each.file_path}'>${index}</option>`)
            })
            $('.city').val(null).trigger('change');
            let city = "{{ !empty(old('city')) ? old('city') : '' }}"
            if (city) {
                console.log(city, '  co nha')
                setValueSelect($('.city'), city)
            }
        }
        insertCity();
        $(".city").select2({
            tags: true
        });
        $(".district").select2({
            tags: true
        });
        $(document).on('change', '.city', function() {
            if ($(this).val()) {
                console.log($('.city').parent().find(".city option:selected").data('path'))
                let path = $('.city').parent().find(".city option:selected").data('path')
                let array = path.split("/");
                loadDistrict(array[2])
                // let location = 1;
                // if ($(this).val() != 'Hà Nội') {
                //     location = 2;
                // }

            } else {
                // $('.ship').val(10000)
                // $('.textship').text(Intl.NumberFormat('en-VN').format(10000))
                // console.log('ship la:', $('.ship').val())
            }
        })

        $(document).on('change', '.payment', function() {
            let data = $(this).val()
            console.log(data)
            if (data == 1) {
                $('.place-order').removeClass('d-none')
                $('.vnpay').addClass('d-none')
                $('#formdata').attr('action', "{{ route('guest.order.create') }}")
            } else {
                $('.vnpay').removeClass('d-none')
                $('.place-order').addClass('d-none')
                $('#formdata').attr('action', "{{ route('guest.order.vn_pay') }}")
            }
        })

    })
</script>

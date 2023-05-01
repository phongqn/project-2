<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard (CodeLean) created using build-in elements and components.">

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/my_style.css') }}" rel="stylesheet">
    @stack('css')
</head>

<body>

    <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">

        @include('admin.layout.header')

        <div class="app-main">
            @include('admin.layout.sidebar')

            <div class="app-main__outer">

                <!-- Main -->
                @yield('content')
                <!-- End Main -->

                @include('admin.layout.footer')
            </div>
        </div>

    </div>
    <div class="app-drawer-overlay d-none animated fadeIn"></div>
    @stack('modal')
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/my_script.js') }}"></script>
    <script>
                // Lắng nghe sự kiện submit của form
        document.querySelector('form').addEventListener('submit', function(event) {
        // Lấy giá trị của trường email và phone
        let emailInput = document.getElementById("email").value;
        let phoneInput = document.getElementById("phone").value;

        // Kiểm tra định dạng email
        if (!emailInput.includes("@")) {
            event.preventDefault(); // Ngăn chặn form được gửi đi nếu có lỗi
            document.querySelector("#v-email").textContent = "Địa chỉ Email không hợp lệ"
            return;
        }

        // Kiểm tra định dạng số điện thoại
        if (!isNaN(phoneInput) && phoneInput .length != 10) {
        console.log(phoneInput.length);

            event.preventDefault(); // Ngăn chặn form được gửi đi nếu có lỗi
            document.querySelector("#v-phone").textContent = "Số điện thoại không hợp lệ"
            return;
        }

        // Nếu không có lỗi, cho phép form được gửi đi
        return true;
        });
    </script>
    @stack('js')
    {!! Toastr::message() !!}
</body>

</html>
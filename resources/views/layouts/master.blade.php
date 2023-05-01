<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Store Everything</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('guest/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('guest/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('guest/css/my_acc.css') }}" rel="stylesheet">


    @stack('css')
    <link href="{{ asset('guest/css/my_acc.css') }}" rel="stylesheet">


</head>

<body>
    <!-- Topbar Start -->
    <x-header :quantityLiked=$quantityLiked />
    <!-- Topbar End -->
    <!-- Navbar Start -->
    <div class="container-fluid">
        <div class="row border-top px-xl-5">
            <x-sidebar :categories=$categories />
            <div class="col-lg-9">
                <x-navbar />
                @yield('slide')
            </div>
        </div>
    </div>
    <!-- Navbar End -->



    @yield('content')

    <!-- Footer Start -->
    <x-footer :notification=$notification />

    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    @stack('modal')
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('guest/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('guest/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Contact Javascript File -->
    <script src="{{ asset('guest/mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('guest/mail/contact.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('guest/js/main.js') }}"></script>
    @stack('js')
</body>

</html>
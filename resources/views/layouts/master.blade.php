
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>JOREB Store</title>
    <!-- Favicon -->
    <link href="/frontend/assets/img/favicon.png" rel="shortcut icon">

    <!-- Google Fonts - Jost -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom Font Icons -->
    {{-- <link href="/frontend/assets/vendor/icomoon/css/iconfont.min.css" rel="stylesheet"> --}}


    <!-- Vendor CSS -->
    <link href="/frontend/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/frontend/assets/vendor/dmenu/css/menu.css" rel="stylesheet">
    <link href="/frontend/assets/vendor/hamburgers/css/hamburgers.min.css" rel="stylesheet">
    <link href="/frontend/assets/vendor/mmenu/css/mmenu.min.css" rel="stylesheet">
    <link href="/frontend/assets/vendor/magnific-popup/css/magnific-popup.css" rel="stylesheet">
    <link href="/frontend/assets/vendor/float-labels/css/float-labels.min.css" rel="stylesheet">

    <!-- Main CSS -->
    <link href="/frontend/assets/css/style.css" rel="stylesheet">

    <style>

        @media all and (min-width: 480px) {
            .deskContent {display:block;}
            .phoneContent {display:none;}
        }

        @media all and (max-width: 479px) {
            .deskContent {display:none;}
            .phoneContent {display:block;}
        }
        .text-justify {
            text-align: justify;
        }
     </style>

    @livewireStyles
</head>

<body>

    <!-- Preloader -->
    <div id="preloader">
        <div data-loader="circle-side"></div>
    </div>
    <!-- Preloader End -->

    <!-- Page -->
    <div id="page">

        @include('layouts.header')

        <!-- Main -->
        <main>
            <div class="sub-header">
                <div class="container">
                    <h1>Pay on COD</h1>
                </div>
            </div>

            <!-- Order -->
            <div class="order">
                <!-- Container -->
                <div class="container">

                    @yield('content')
                    @include('scripts.sweet-alert')

                </div>
                <!-- Container End -->
            </div>
            <!-- Order End -->
        </main>
        <!-- Main End -->

        <!-- Footer -->
        <footer class="main-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <h5 class="footer-heading">Menu Links</h5>
                        <ul class="list-unstyled nav-links">
                            <li><i class="fa fa-angle-right"></i> <a href="https://ultimatewebsolutions.net/foodboard/" class="footer-link">Home</a></li>
                            <li><i class="fa fa-angle-right"></i> <a href="https://ultimatewebsolutions.net/foodboard/faq.html" class="footer-link">FAQ</a></li>
                            <li><i class="fa fa-angle-right"></i> <a href="https://ultimatewebsolutions.net/foodboard/contacts.html" class="footer-link">Contacts</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h5 class="footer-heading">Order Wizard</h5>
                        <ul class="list-unstyled nav-links">
                            <li><i class="fa fa-angle-right"></i> <a href="#" class="footer-link">Pay online</a></li>
                            <li><i class="fa fa-angle-right"></i> <a href="https://ultimatewebsolutions.net/foodboard/pay-with-cash-on-delivery/" class="footer-link">Pay with cash on delivery</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5 class="footer-heading">Contacts</h5>
                        <ul class="list-unstyled contact-links">
                            <li><i class="icon icon-map-marker"></i><a href="https://goo.gl/maps/vKgGyZe2JSRLDnYH6" class="footer-link" target="_blank">Address: 1234 Street Name, City Name, USA</a>
                            </li>
                            <li><i class="icon icon-envelope3"></i><a href="mailto:info@yourdomain.com" class="footer-link">Mail: info@yourdomain.com</a></li>
                            <li><i class="icon icon-phone2"></i><a href="tel:+3630123456789" class="footer-link">Phone: +3630123456789</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2">
                        <h5 class="footer-heading">Find Us On</h5>
                        <ul class="list-unstyled social-links">
                            <li><a href="https://facebook.com/" class="social-link" target="_blank"><i class="icon icon-facebook"></i></a></li>
                            <li><a href="https://twitter.com/" class="social-link" target="_blank"><i class="icon icon-twitter"></i></a></li>
                            <li><a href="https://instagram.com/" class="social-link" target="_blank"><i class="icon icon-instagram"></i></a></li>
                            <li><a href="https://pinterest.com/" class="social-link" target="_blank"><i class="icon icon-pinterest"></i></a></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-8">
                        <ul id="subFooterLinks">
                            <li>Coded with <i class="fa fa-heart pulse"></i> by <a href="https://joreb.net" target="_blank">  JOREB</a></li>
                            <li><a href="#" target="_blank">Terms and conditions</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <div id="copy">© 2022 FoodBoard</div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer End -->


    </div>
    <!-- Page End -->




    <!-- Back to top button -->
    <div id="toTop">
        <i class="fa fa-arrow-up"></i>
    </div>



    <!-- Vendor Javascript Files -->
    {{-- <script src="/frontend/assets/vendor/jquery/jquery.min.js"></script> --}}
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="/frontend/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="/frontend/assets/vendor/easing/js/easing.min.js"></script>
    <script src="/frontend/assets/vendor/parsley/js/parsley.min.js"></script>
    <script src="/frontend/assets/vendor/nice-select/js/jquery.nice-select.min.js"></script>
    <script src="/frontend/assets/vendor/price-format/js/jquery.priceformat.min.js"></script>
    <script src="/frontend/assets/vendor/theia-sticky-sidebar/js/ResizeSensor.min.js"></script>
    <script src="/frontend/assets/vendor/theia-sticky-sidebar/js/theia-sticky-sidebar.min.js"></script>
    <script src="/frontend/assets/vendor/mmenu/js/mmenu.min.js"></script>
    <script src="/frontend/assets/vendor/magnific-popup/js/jquery.magnific-popup.min.js"></script>
    <script src="/frontend/assets/vendor/float-labels/js/float-labels.min.js"></script>
    <script src="/frontend/assets/vendor/jquery-wizard/js/jquery-ui-1.8.22.min.js"></script>
    <script src="/frontend/assets/vendor/jquery-wizard/js/jquery.wizard.js"></script>
    <script src="/frontend/assets/vendor/isotope/js/isotope.pkgd.min.js"></script>
    <script src="/frontend/assets/vendor/scrollreveal/js/scrollreveal.min.js"></script>
    <script src="/frontend/assets/vendor/lazyload/js/lazyload.min.js"></script>
    <script src="/frontend/assets/vendor/sticky-kit/js/sticky-kit.min.js"></script>



    <!-- Main Javascript File -->
    <script src="/frontend/assets/js/scripts.js"></script>

    @livewireScripts

</body>


</html>

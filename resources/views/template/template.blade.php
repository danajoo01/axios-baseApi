<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Travel Ins - Asuransi Perjalanan (Travel)">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#0134d4">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Title -->
    <title>Travel Ins - Telkomsel</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <!-- Favicon -->
    <link rel="icon" href="{{ url('img/logo/icon-telkomsel.png')}}">
    <link rel="apple-touch-icon" href="{{ url('img/logo/icon-telkomsel.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ url('img/logo/icon-telkomsel.png')}}">
    <link rel="apple-touch-icon" sizes="167x167" href="{{ url('img/logo/icon-telkomsel.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('img/logo/icon-telkomsel.png')}}">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ url('css/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{ url('css/tiny-slider.css')}}">
    <link rel="stylesheet" href="{{ url('css/baguetteBox.min.css')}}">
    <link rel="stylesheet" href="{{ url('css/rangeslider.css')}}">
    <link rel="stylesheet" href="{{ url('css/vanilla-dataTables.min.css')}}">
    <link rel="stylesheet" href="{{ url('css/apexcharts.css')}}">
    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="{{ url('style.css')}}">
    <!-- Web App Manifest -->
    <link rel="manifest" href="manifest.json">
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
    </div>
    <!-- Internet Connection Status -->
    <!-- # This code for showing internet connection status -->
    <div class="internet-connection-status" id="internetStatus"></div>
    <div class="page-content-wrapper">

        <div class="container direction-rtl">
            <div class="card-shadow">
                <div class="card-body p-2">
                    <div class="card-body p-2">
                        <div class="d-flex align-items-center justify-content-between">
                            <img src="{{ url('img/logo/telkomsel.png')}}" width="30%">
                            <img src="{{ url('img/logo/tugu.png')}}" width="25%">
                        </div>
                    </div>
                </div>
            </div>
            <div class="pb-4"></div>
        </div>

            @yield('konten')
        </div>

    </div>

    <!-- Footer Nav -->
    <div class="footer-nav-area">
        <div class="container px-0">
            <!-- =================================== -->
            <!-- Paste your Footer Content from here -->
            <!-- =================================== -->
            <!-- Footer Content -->
            <div class="footer-nav text-center">
                <img src="{{ url('img/logo/ojk.png')}}" class="mb-2">
                <p>PT Asuransi Tugu Pratama Indonesia Tbk<br> terdaftar dan diawasi oleh Otoritas Jasa Keuangan (OJK)
                </p><br>
                <b>PT Asuransi Tugu Pratama Indonesia Tbk</b><br>
                <p>a member of PERTAMINA</p>
            </div>
        </div>
    </div>

    <!-- All JavaScript Files -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ url('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ url('js/slideToggle.min.js')}}"></script>
    <script src="{{ url('js/internet-status.js')}}"></script>
    <script src="{{ url('js/tiny-slider.js')}}"></script>
    <script src="{{ url('js/baguetteBox.min.js')}}"></script>
    {{-- <script src="{{ url('js/countdown.js')}}"></script> --}}
    <script src="{{ url('js/rangeslider.min.js')}}"></script>
    <script src="{{ url('js/vanilla-dataTables.min.js')}}"></script>
    <script src="{{ url('js/index.js')}}"></script>
    <script src="{{ url('js/magic-grid.min.js')}}"></script>
    <script src="{{ url('js/dark-rtl.js')}}"></script>
    <script src="{{ url('js/active.js')}}"></script>
    <!-- PWA -->
    <script src="{{ url('js/pwa.js')}}"></script>
    @stack('custom-scripts')
</body>

</html>

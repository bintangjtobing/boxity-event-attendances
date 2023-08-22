<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boxity | Event Has Ended</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- inject:css-->

    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/bootstrap/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/daterangepicker.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/fontawesome.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/footable.standalone.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/fullcalendar@5.2.0.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/jquery-jvectormap-2.0.5.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/jquery.mCustomScrollbar.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/leaflet.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/line-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/MarkerCluster.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/MarkerCluster.Default.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/slick.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/star-rating-svg.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/trumbowyg.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/wickedpicker.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- endinject -->

    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('brand/App icon - primary orange color.png') }}">
</head>

<body class="layout-light side-menu overlayScroll">
    <main class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Start: error page -->
                    <div class="min-vh-100 content-center">
                        <div class="error-page text-center">
                            <img src="{{ asset('img/svg/404.svg') }}" alt="404" class="svg">
                            <div class="error-page__title">400</div>
                            <h5 class="fw-500">Event Has Ended</h5>
                            {{-- <div class="content-center mt-30">
                                <a href="{{ route('dashboard_view_admin') }}"
                                    class="btn btn-primary btn-default btn-squared px-30">Return
                                    Home</a>
                            </div> --}}
                        </div>
                    </div>
                    <!-- End: error page -->
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="footer-copyright">
                            <p>Copyright &copy; 2023 All Rights Reserved by <a href="#">PT Boxity Central
                                    Indonesia</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </main>
    <div id="overlayer">
        <span class="loader-overlay">
            <div class="atbd-spin-dots spin-lg">
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
            </div>
        </span>
    </div>
    <div class="overlay-dark-sidebar"></div>

    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDduF2tLXicDEPDMAtC6-NLOekX0A5vlnY"></script>
    <!-- inject:js-->
    <script src="{{ asset('assets/vendor_assets/js/jquery/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/bootstrap/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/accordion.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/autoComplete.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/charts.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/drawer.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/dynamicBadge.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/dynamicCheckbox.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/footable.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/fullcalendar@5.2.0.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/google-chart.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery-jvectormap-2.0.5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery.filterizr.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery.mCustomScrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery.star-rating-svg.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/leaflet.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/leaflet.markercluster.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/loader.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/message.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/muuri.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/notification.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/popover.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/trumbowyg.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/wickedpicker.min.js') }}"></script>
    <script src="{{ asset('assets/theme_assets/js/drag-drop.js') }}"></script>
    <script src="{{ asset('assets/theme_assets/js/footable.js') }}"></script>
    <script src="{{ asset('assets/theme_assets/js/full-calendar.js') }}"></script>
    <script src="{{ asset('assets/theme_assets/js/googlemap-init.js') }}"></script>
    <script src="{{ asset('assets/theme_assets/js/icon-loader.js') }}"></script>
    <script src="{{ asset('assets/theme_assets/js/jvectormap-init.js') }}"></script>
    <script src="{{ asset('assets/theme_assets/js/leaflet-init.js') }}"></script>
    <script src="{{ asset('assets/theme_assets/js/main.js') }}"></script>
    <!-- endinject-->
</body>

</html>

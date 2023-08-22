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
<script src="{{ asset('assets/theme_assets/js/participant-filter.js') }}"></script>
<script src="{{ asset('assets/theme_assets/js/full-calendar.js') }}"></script>
<script src="{{ asset('assets/theme_assets/js/googlemap-init.js') }}"></script>
<script src="{{ asset('assets/theme_assets/js/icon-loader.js') }}"></script>
<script src="{{ asset('assets/theme_assets/js/jvectormap-init.js') }}"></script>
<script src="{{ asset('assets/theme_assets/js/leaflet-init.js') }}"></script>
<script src="{{ asset('assets/theme_assets/js/main.js') }}"></script>
<script>
    function realtimeClock() {
        var rtClock = new Date();

        var hours = rtClock.getHours();
        var minutes = rtClock.getMinutes();
        var seconds = rtClock.getSeconds();

        var ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12; // Convert 0 to 12

        hours = ("0" + hours).slice(-2);
        minutes = ("0" + minutes).slice(-2);
        seconds = ("0" + seconds).slice(-2);

        $('#clock').html(hours + ":" + minutes + ":" + seconds + " " + ampm);
        var jamnya = setTimeout(realtimeClock, 500);
    }
</script>
<!-- endinject-->

    <!doctype html>
<html class="fixed">
    <head>

        <!-- Basic -->
        <meta charset="UTF-8">

        <title>@yield('title')</title>
        <meta name="keywords" content="HTML5 Admin Template" />
        <meta name="description" content="JSOFT Admin - Responsive HTML5 Template">
        <meta name="author" content="JSOFT.net">

        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <!-- Web Fonts  -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

        <link rel="stylesheet" type="text/css" href="{{ asset('dist/sweetalert.css') }}">

        <!-- Vendor CSS -->
        <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="/assets/vendor/font-awesome/css/font-awesome.css" />
        <link rel="stylesheet" href="/assets/vendor/magnific-popup/magnific-popup.css" />
        <link rel="stylesheet" href="/assets/vendor/bootstrap-datepicker/css/datepicker3.css" />
        <link rel="stylesheet" href="/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />

        <!-- Specific Page Vendor CSS -->
        <link rel="stylesheet" href="/assets/vendor/select2/select2.css" />
        <link rel="stylesheet" href="/assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
        <link rel="stylesheet" href="/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
        <link rel="stylesheet" href="/assets/vendor/morris/morris.css" />


        <!-- Theme CSS -->
        <link rel="stylesheet" href="/assets/stylesheets/theme.css" />

        <!-- Skin CSS -->
        <link rel="stylesheet" href="/assets/stylesheets/skins/default.css" />

        <!-- Theme Custom CSS -->
        <link rel="stylesheet" href="/assets/stylesheets/theme-custom.css">

        <!-- Head Libs -->
        <script src="/assets/vendor/modernizr/modernizr.js"></script>

    </head>
    <body>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        @include('sweet::alert')
        <section class="body">

            <div class="inner-wrapper">
                <!-- start: sidebar -->
                @include('partial.sidebar')
                <!-- end: sidebar -->

                @include('partial.content_body')
            </div>
        </section>

        
        <!-- Vendor -->

        <script src="/assets/vendor/jquery/jquery.js"></script>
        <script src="/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
        <script src="/assets/vendor/bootstrap/js/bootstrap.js"></script>
        <script src="/assets/vendor/nanoscroller/nanoscroller.js"></script>
        <script src="/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="/assets/vendor/magnific-popup/magnific-popup.js"></script>
        <script src="/assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

        
        
        <!-- Specific Page Vendor -->
        <script src="/assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
        <script src="/assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
        <script src="/assets/vendor/jquery-appear/jquery.appear.js"></script>
        <script src="/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
        <script src="/assets/vendor/jquery-easypiechart/jquery.easypiechart.js"></script>
        <script src="/assets/vendor/flot/jquery.flot.js"></script>
        <script src="/assets/vendor/flot-tooltip/jquery.flot.tooltip.js"></script>
        <script src="/assets/vendor/flot/jquery.flot.pie.js"></script>
        <script src="/assets/vendor/flot/jquery.flot.categories.js"></script>
        <script src="/assets/vendor/flot/jquery.flot.resize.js"></script>
        <script src="/assets/vendor/jquery-sparkline/jquery.sparkline.js"></script>
        <script src="/assets/vendor/raphael/raphael.js"></script>
        <script src="/assets/vendor/morris/morris.js"></script>
        <script src="/assets/vendor/gauge/gauge.js"></script>
        <script src="/assets/vendor/snap-svg/snap.svg.js"></script>
        <script src="/assets/vendor/liquid-meter/liquid.meter.js"></script>
        <script src="/assets/vendor/jqvmap/jquery.vmap.js"></script>
        <script src="/assets/vendor/jqvmap/data/jquery.vmap.sampledata.js"></script>
        <script src="/assets/vendor/jqvmap/maps/jquery.vmap.world.js"></script>
        <script src="/assets/vendor/jqvmap/maps/continents/jquery.vmap.africa.js"></script>
        <script src="/assets/vendor/jqvmap/maps/continents/jquery.vmap.asia.js"></script>
        <script src="/assets/vendor/jqvmap/maps/continents/jquery.vmap.australia.js"></script>
        <script src="/assets/vendor/jqvmap/maps/continents/jquery.vmap.europe.js"></script>
        <script src="/assets/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js"></script>
        <script src="/assets/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js"></script>

        <!-- sweet allert -->
        <script src="{{ asset('dist/sweetalert.min.js') }}"></script>

        <!-- modal -->
            

        
        <!-- Theme Base, Components and Settings -->
        <script src="/assets/javascripts/theme.js"></script>
        
        <script src="/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
        <script src="/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>

        <script src="/assets/javascripts/format_harga/my.js"></script>
        
        <!-- Theme Custom -->
        <script src="/assets/javascripts/theme.custom.js"></script>
        
        <!-- Theme Initialization Files -->
        <script src="/assets/javascripts/theme.init.js"></script>
        


        @yield('js')


    </body>
</html>


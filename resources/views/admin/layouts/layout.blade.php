<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Shashikanta">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CSRF Token Ends -->
    <link rel="icon" href="{{ url('/') }}/admin/assets/images/favicon.jpg" type="image/x-icon">
    <link rel="shortcut icon" href="{{ url('/') }}/admin/assets/images/favicon.jpg" type="image/x-icon">
    <title>Administrator || {{ config('app.name', 'Laravel') }}</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/admin/assets/css/font-awesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/admin/assets/css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/admin/assets/css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/admin/assets/css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/admin/assets/css/vendors/feather-icon.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/admin/assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/admin/assets/css/vendors/animate.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/admin/assets/css/vendors/chartist.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/admin/assets/css/vendors/date-picker.css">

    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/admin/assets/css/vendors/datatables.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/admin/assets/css/vendors/owlcarousel.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/admin/assets/css/vendors/rating.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/admin/assets/css/vendors/dropzone.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/admin/assets/css/vendors/prism.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/admin/assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/admin/assets/css/style.css">
    <link id="color" rel="stylesheet" href="{{ url('/') }}/admin/assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/admin/assets/css/responsive.css">
  </head>
  <body onload="startTime()">
    <div class="loader-wrapper">
      <div class="loader-index"><span></span></div>
      <svg>
        <defs></defs>
        <filter id="goo">
          <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
          <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
        </filter>
      </svg>
    </div>
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        @include('admin/layouts/header')
        <!-- Page Header Ends -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            @include('admin/layouts/sidebar')
            <!-- Page Sidebar Ends-->
            @yield('content')
            <!-- footer start-->
            @include('admin/layouts/footer')
            <!-- footer ends -->
        </div>
    </div>
    <!-- latest jquery-->
    <script src="{{ url('/') }}/admin/assets/js/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap js-->
    <script src="{{ url('/') }}/admin/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- feather icon js-->
    <script src="{{ url('/') }}/admin/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- scrollbar js-->
    <script src="{{ url('/') }}/admin/assets/js/scrollbar/simplebar.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/scrollbar/custom.js"></script>
    <!-- Sidebar jquery-->
    <script src="{{ url('/') }}/admin/assets/js/config.js"></script>
    <!-- Plugins JS start-->
    <script src="{{ url('/') }}/admin/assets/js/sidebar-menu.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/chart/chartist/chartist.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/chart/chartist/chartist-plugin-tooltip.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/chart/knob/knob.min.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/chart/knob/knob-chart.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/chart/apex-chart/apex-chart.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/chart/apex-chart/stock-prices.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/prism/prism.min.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/clipboard/clipboard.min.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/counter/jquery.waypoints.min.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/counter/jquery.counterup.min.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/counter/counter-custom.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/custom-card/custom-card.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/notify/bootstrap-notify.min.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/dashboard/default.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/notify/index.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/datepicker/date-picker/datepicker.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/datepicker/date-picker/datepicker.en.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/datepicker/date-picker/datepicker.custom.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/typeahead/handlebars.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/typeahead/typeahead.bundle.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/typeahead/typeahead.custom.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/typeahead-search/handlebars.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/typeahead-search/typeahead-custom.js"></script>
    <!-- Plugins JS Ends-->
    <script src="{{ url('/') }}/admin/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/rating/jquery.barrating.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/rating/rating-script.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/owlcarousel/owl.carousel.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/ecommerce.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/product-list-custom.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/dashboard/dashboard_2.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/tooltip-init.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/dropzone/dropzone.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/dropzone/dropzone-script.js"></script>

    <!-- Theme js-->
    <script src="{{ url('/') }}/admin/assets/js/script.js"></script>
    <!-- <script src="{{ url('/') }}/admin/assets/js/theme-customizer/customizer.js"></script> -->
    <!-- login js-->
    <!-- Plugin used-->
  </body>
</html>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset(Config::get('constants.backend_address').'/assets/images/favicon.png') }}">
    <title>Matrix Template - The Ultimate Multipurpose admin template</title>
    <!-- Custom CSS -->
    
    <link href="{{ asset(Config::get('constants.backend_address').'/assets/libs/select2/dist/css/select2.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset(Config::get('constants.backend_address').'/assets/libs/flot/css/float-chart.css') }}" rel="stylesheet">
    <link href="{{ asset(Config::get('constants.backend_address').'/dist/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset(Config::get('constants.backend_address').'/assets/custom_assets/css/custom_ccs_style.css') }}" rel="stylesheet">
    <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800&display=swap" rel="stylesheet"> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">



    <?php
      // dd(Config::get('constants.frontend_address'));
    ?>

    @include ("layouts.adminLayout.admin_header")
    @include ("layouts.adminLayout.admin_sidebar")
    @include ("admin.delete_confirm_modal");


    @yield('content')

    @include ("layouts.adminLayout.admin_footer")

        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset(Config::get('constants.backend_address').'/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset(Config::get('constants.backend_address').'/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset(Config::get('constants.backend_address').'/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset(Config::get('constants.backend_address').'/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset(Config::get('constants.backend_address').'/assets/extra-libs/sparkline/sparkline.js') }}"></script>
    <script src="{{ asset(Config::get('constants.backend_address').'/assets/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    
    <!--Wave Effects -->
    <script src="{{ asset(Config::get('constants.backend_address').'/dist/js/waves.js') }}"></script>

    <!--Menu sidebar -->
    <script src="{{ asset(Config::get('constants.backend_address').'/dist/js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset(Config::get('constants.backend_address').'/dist/js/custom.min.js') }}"></script>

    <!-- <script src="{{ asset(Config::get('constants.backend_address').'/assets/libs/select2/dist/js/select2.full.min.js') }}"></script> -->
    <script src="{{ asset(Config::get('constants.backend_address').'/assets/libs/select2/dist/js/select2.min.js') }}"></script>
    
    <script src="{{ asset(Config::get('constants.backend_address').'/assets/custom_assets/js/adminChangePasswordValidation.js') }}"></script>
    <script src="{{ asset(Config::get('constants.backend_address').'/assets/custom_assets/js/markalar.js') }}"></script>

    <script>
      //***********************************//
      // For select 2
      //***********************************//
      $(".select2").select2();

      // /*colorpicker*/
      // $('.demo').each(function() {
      //     //
      //     // Dear reader, it's actually very easy to initialize MiniColors. For example:
      //     //
      //     //  $(selector).minicolors();
      //     //
      //     // The way I've done it below is just for the demo, so don't get confused
      //     // by it. Also, data- attributes aren't supported at this time...they're
      //     // only used for this demo.
      //     //
      //     $(this).minicolors({
      //         control: $(this).attr('data-control') || 'hue',
      //         position: $(this).attr('data-position') || 'bottom left',

      //         change: function(value, opacity) {
      //             if (!value) return;
      //             if (opacity) value += ', ' + opacity;
      //             if (typeof console === 'object') {
      //                 console.log(value);
      //             }
      //         },
      //         theme: 'bootstrap'
      //     });

      // });
      // /*datwpicker*/
      // jQuery('.mydatepicker').datepicker();
      // jQuery('#datepicker-autoclose').datepicker({
      //     autoclose: true,
      //     todayHighlight: true
      // });
      // var quill = new Quill('#editor', {
      //     theme: 'snow'
      // });
  </script>

</body>

</html>
<!DOCTYPE html>

<!--[if IE 8]>
<html lang="en"
      class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en"
      class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>{{ env('APP_NAME') }}</title>
    <meta http-equiv="X-UA-Compatible"
          content="IE=edge">
    <meta content="width=device-width, initial-scale=1"
          name="viewport"/>
    <meta content="Preview page of Metronic Admin Theme #1 for blank page layout"
          name="description"/>
    <meta content=""
          name="author"/>
    {{-- CSRF Token --}}
    <meta name="csrf-token"
          content="{{ csrf_token() }}">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all"
          rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}"
          rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/bootstrap/css/bootstrap.min.css') }}"
          rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}"
          rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/sweet-alert/sweetalert2.min.css') }}"
          rel="stylesheet">
    <link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}"
          rel="stylesheet"
          id="style_components"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}"
          rel="stylesheet"
          id="style_components"
          type="text/css"/>
    <link href="{{ asset('assets/global/css/components-md.min.css') }}"
          rel="stylesheet"
          id="style_components"
          type="text/css"/>
    <link href="{{ asset('assets/global/css/plugins-md.min.css') }}"
          rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/layouts/layout/css/layout.min.css') }}"
          rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/layouts/layout/css/themes/darkblue.min.css') }}"
          rel="stylesheet"
          type="text/css"
          id="style_color"/>
    @stack('stylesheets')
    <style>
        body {
            margin: 40px 10px;
            padding: 0;
            font-family: "Lucida Grande", Helvetica, Arial, Verdana, sans-serif;
            font-size: 14px;
        }
    </style>
    <link href="{{ asset('assets/layouts/layout/css/custom.min.css') }}"
          rel="stylesheet"
          type="text/css"/>
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon"
          href="{{ asset('img/stethoscope-icon.png') }}"/>
</head>
<!-- END HEAD -->

<body class="page-header-fixed page-footer-fixed page-sidebar-fixed page-content-white page-md">
<div class="page-wrapper">
    <!-- BEGIN HEADER -->
    <div class="page-header navbar navbar-fixed-top">
        <!-- BEGIN HEADER INNER -->
        <div class="page-header-inner ">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/layouts/layout/img/logo.png') }}"
                         alt="logo"
                         class="logo-default"/> </a>
                <div class="menu-toggler sidebar-toggler">
                    <span></span>
                </div>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;"
               class="menu-toggler responsive-toggler"
               data-toggle="collapse"
               data-target=".navbar-collapse">
                <span></span>
            </a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            @include ('../layouts.components.' . \App\Entities\User::getUserMiddleware() . '.top-navigation-admin')
        </div>
        <!-- END HEADER INNER -->
    </div>
    <!-- END HEADER -->
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"></div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
    @include ('../layouts.components.' . \App\Entities\User::getUserMiddleware() . '.side-bar-admin')
    <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
    @yield('content')
    <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <div class="page-footer">
        <div class="page-footer-inner"> 2016 &copy; Metronic Theme By
            <a target="_blank"
               href="http://keenthemes.com">Keenthemes</a> &nbsp;|&nbsp;
            <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes"
               title="Purchase Metronic just for 27$ and get lifetime updates for free"
               target="_blank">Purchase Metronic!</a>
        </div>

        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    </div>
    <!-- END FOOTER -->
</div>
<!-- BEGIN QUICK NAV -->

<div class="quick-nav-overlay"></div>
<!-- END QUICK NAV -->
<!--[if lt IE 9]>
<script src="{{ asset('assets/global/plugins/respond.min.js') }}"></script>
<script src="{{ asset('assets/global/plugins/excanvas.min.js') }}"></script>
<script src="{{ asset('assets/global/plugins/ie8.fix.min.js') }}"></script>
<![endif]-->
<script src="{{ asset('assets/global/plugins/jquery.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap/js/bootstrap.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/sweet-alert/sweetalert2.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/scripts/app.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/layouts/layout/scripts/layout.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/pages/scripts/components-select2.min.js') }}"
        type="text/javascript"></script>
@stack('scripts')
@include('sweet::alert')
</body>

</html>
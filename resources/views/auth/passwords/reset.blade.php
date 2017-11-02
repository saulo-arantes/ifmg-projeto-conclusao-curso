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
    <title>{{ env('APP_NAME') }} - Redefinir senha</title>
    <meta http-equiv="X-UA-Compatible"
          content="IE=edge">
    <meta content="width=device-width, initial-scale=1"
          name="viewport"/>
    <meta content="{{ env('APP_DESCRIPTION') }}"
          name="description"/>
    <meta content=""
          name="author"/>

    <!-- CSRF Token -->
    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all"
          rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}"
          rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/bootstrap/css/bootstrap.min.css') }}"
          rel="stylesheet"
          type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{ asset('assets/global/css/components-md.min.css') }}"
          rel="stylesheet"
          id="style_components"
          type="text/css"/>
    <link href="{{ asset('assets/global/css/plugins-md.min.css') }}"
          rel="stylesheet"
          type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ asset('assets/pages/css/login.min.css') }}"
          rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}"
          rel="stylesheet">
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon"
          href="{{ asset('assets/favicon.ico') }}"/>
</head>
<!-- END HEAD -->

<body class=" login">
<!-- BEGIN LOGO -->
<div class="logo">
    <a href="{{ url('/') }}">
        <img src="{{ asset('assets/pages/img/logo-big.png') }}"
             alt=""/>
    </a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form class="login-form"
          action="{{ route('password.request') }}"
          method="post">
        <h3 class="form-title font-green">Redefinir senha</h3>
        @if (session('status'))
            <div class="alert alert-success">
                <strong>Email enviado com sucesso</strong>
                <button class="close"
                        data-close="alert"></button>
                <span> </span>
            </div>
        @endif
        @if ($errors->has('email'))
            <div class="alert alert-danger">
                <strong>{{ $errors->first('email') }}</strong>
                <button class="close"
                        data-close="alert"></button>
                <span> </span>
            </div>
        @endif
        @if ($errors->has('password'))
            <div class="alert alert-danger">
                <strong>{{ $errors->first('password') }}</strong>
                <button class="close"
                        data-close="alert"></button>
                <span> </span>
            </div>
        @endif
        @if ($errors->has('password_confirmation'))
            <div class="alert alert-danger">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
                <button class="close"
                        data-close="alert"></button>
                <span> </span>
            </div>
        @endif
        @if ($errors->has('token'))
            <div class="alert alert-danger">
                <strong>{{ $errors->first('token') }}</strong>
                <button class="close"
                        data-close="alert"></button>
                <span> </span>
            </div>
        @endif
        <div class="form-body">
            {{ csrf_field() }}
            <input type="hidden"
                   name="token"
                   value="{{ $token }}">
            <div class="form-group">
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                <label class="control-label visible-ie8 visible-ie9">Email</label>
                <input class="form-control form-control-solid placeholder-no-fix"
                       autofocus
                       autocomplete="on"
                       placeholder="Email"
                       name="email"
                       value="{{ old('email') }}"
                       required/>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Senha</label>
                <input class="form-control form-control-solid placeholder-no-fix"
                       type="password"
                       autocomplete="off"
                       placeholder="Senha"
                       name="password"
                       required/>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Confirme a senha</label>
                <input class="form-control form-control-solid placeholder-no-fix"
                       type="password"
                       autocomplete="off"
                       placeholder="Confirme a senha"
                       name="password_confirmation"
                       required/>
            </div>
            <div class="form-actions">
                <button class="btn green uppercase pull-right">Redefinir a senha</button>
            </div>
        </div>
    </form>
    <!-- END LOGIN FORM -->
</div>
<div class="copyright">2017 &copy; CelulaWeb.</div>
<!--[if lt IE 9]>
<script src="{{ asset('assets/global/plugins/respond.min.js') }}"></script>
<script src="{{ asset('assets/global/plugins/excanvas.min.js') }}"></script>
<script src="{{ asset('assets/global/plugins/ie8.fix.min.js') }}"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="{{ asset('assets/global/plugins/jquery.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap/js/bootstrap.min.js') }}"
        type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}"
        type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{ asset('assets/global/scripts/app.min.js') }}"
        type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ asset('assets/pages/scripts/login.min.js') }}"
        type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<!-- END THEME LAYOUT SCRIPTS -->
<script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}"
        type="text/javascript"></script>
@include('sweet::alert')
</body>

</html>
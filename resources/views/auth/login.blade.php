<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">


<head>
    <meta charset="utf-8"/>
    <title>{{ env('APP_NAME') }} - Login</title>
    <meta http-equiv="X-UA-Compatible"
          content="IE=edge">
    <meta content="width=device-width, initial-scale=1"
          name="viewport"/>
    <meta content="{{ env('APP_DESCRIPTION') }}"
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
    <link href="{{ asset('assets/global/css/components-md.min.css') }}"
          rel="stylesheet"
          id="style_components"
          type="text/css"/>
    <link href="{{ asset('assets/global/css/plugins-md.min.css') }}"
          rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/pages/css/login.min.css') }}"
          rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}"
          rel="stylesheet">
    <link rel="shortcut icon"
          href="{{ asset('assets/favicon.ico') }}"/>
</head>

<body class=" login">
{{-- BEGIN LOGO --}}
<div class="logo">
    <a href="{{ url('/') }}">
        <img src="{{ asset('assets/pages/img/logo-big.png') }}"
             alt=""/>
    </a>
</div>
{{-- END LOGO --}}

{{-- BEGIN LOGIN --}}
<div class="content">
    {{-- BEGIN LOGIN FORM --}}
    <form class="login-form"
          action="{{ route('login') }}"
          method="post">
        <h3 class="form-title font-green">Entrar</h3>
        @if (session('status'))
            <div class="alert alert-success">
                <strong>Email enviado com sucesso</strong>
                <button class="close"
                        data-close="alert"></button>
                <span> </span>
            </div>
        @endif
        @if (!empty(session('mailError')))
            <div class="alert alert-danger">
                <strong>{{ session('mailError') }}</strong>
                <button class="close"
                        data-close="alert"></button>
                <span> </span>
				<?php session()->forget('mailError') ?>
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
            <div class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
                <button class="close"
                        data-close="alert"></button>
                <span> </span>
            </div>
        @endif
        <div class="form-body">
            {{ csrf_field() }}
            <div class="form-group">
                {{--ie8, ie9 does not support html5 placeholder, so we just show field title for that--}}
                <label class="control-label visible-ie8 visible-ie9">Email</label>
                <input class="form-control form-control-solid placeholder-no-fix"
                       autofocus
                       autocomplete="on"
                       placeholder="Email"
                       name="email"
                       value="{{ old('email') }}"/>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Senha</label>
                <input class="form-control form-control-solid placeholder-no-fix"
                       type="password"
                       autocomplete="off"
                       placeholder="Senha"
                       name="password"/>
            </div>
            <div class="form-actions">
                <button class="btn green uppercase">Entrar</button>
                <a href="javascript:"
                   id="forget-password"
                   class="forget-password">Esqueceu a senha?</a>
            </div>
        </div>
    </form>
    {{-- END LOGIN FORM --}}

    {{-- BEGIN FORGOT PASSWORD FORM --}}
    <form class="forget-form"
          action="{{ route('password.email') }}"
          method="post">
        <h3 class="font-green">Esqueceu a senha ?</h3>
        <p>Entre com seu email cadastrado para solicitar a redefinição de senha. </p>
        <div class="form-body">
            {{ csrf_field() }}
            <div class="form-group">
                <input class="form-control placeholder-no-fix"
                       autocomplete="off"
                       placeholder="Email"
                       name="email"/>
            </div>
            <div class="form-actions">
                <button type="button"
                        id="back-btn"
                        class="btn green btn-outline">Voltar
                </button>
                <button class="btn btn-success uppercase pull-right">Enviar link</button>
            </div>
        </div>
    </form>
    {{-- END FORGOT PASSWORD FORM --}}
</div>

<div class="copyright">2017 &copy; CelulaWeb.</div>

<!--[if lt IE 9]>
<script src="{{ asset('assets/global/plugins/respond.min.js') }}"></script>
<script src="{{ asset('assets/global/plugins/excanvas.min.js') }}"></script>
<script src="{{ asset('assets/global/plugins/ie8.fix.min.js') }}"></script>
<![endif]-->

<script src="{{ asset('assets/global/plugins/jquery.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap/js/bootstrap.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/scripts/app.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/pages/scripts/login.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}"
        type="text/javascript"></script>
@include('sweet::alert')
</body>

</html>
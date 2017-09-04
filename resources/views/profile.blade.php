@extends('layouts.app')

@push('stylesheets')
<link href="{{ asset('assets/global/plugins/dropzone/dropzone.min.css') }}"
      rel="stylesheet"
      type="text/css"/>
@endpush

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <span>Menu superior</span>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Meu perfil</span>
                    </li>
                </ul>
                @include('layouts.components.back')
            </div>
            <div class="row"
                 style="margin-top: 20px">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="portlet box blue-dark">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-edit"></i>
                                <span class="caption-subject bold uppercase"> Meu perfil</span>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#personalInfo"
                                       data-toggle="tab"
                                       aria-expanded="true">Informações pessoais</a>
                                </li>
                                <li class="">
                                    <a href="#changePassword"
                                       data-toggle="tab"
                                       aria-expanded="false">Alterar senha</a>
                                </li>
                            </ul>
                        </div>
                        <div class="portlet-body form">
                            <div class="tab-content">
                                <div class="tab-pane active"
                                     id="personalInfo">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-4 col-sm-4 col-xs-4"></div>
                                        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-4">

                                            @if(!empty($user['data']['photo']))
                                                <img src="{{ asset('uploads/' . $user['data']['photo']) }}"
                                                     style="width: 100%; margin: 20px 0">
                                            @else
                                                <img src="{{ asset('assets/global/img/avatar.png') }}"
                                                     style="width: 100%; margin: 20px 0">
                                            @endif
                                        </div>
                                        <div class="col-lg-5 col-md-4 col-sm-4 col-xs-4"></div>
                                    </div>
                                    <div id="avatar"
                                         class="dropzone"
                                         style="margin: 0 20px;">
                                        <div class="dz-default dz-message">
                                            Arraste e solte uma nova foto para o perfil ou clique <b>aqui</b> para
                                            escolher.<br><br>
                                            <small>Tamanho máximo da imagem: 2 Megabytes</small>
                                            <br>
                                            <small>Resolução mínima: 100x100</small>
                                            <br>
                                            <small>Resolução máxima: 3000x3000</small>
                                            <br>
                                            <small>Formatos de imagem aceitos: .jpg, .png</small>
                                        </div>
                                    </div>
                                    <form action="{{ url('/profile') }}"
                                          id="form_sample_2"
                                          method="post"
                                          class="horizontal-form"
                                          novalidate="novalidate">
                                        {{ csrf_field() }}
                                        <div class="form-body">
                                            <h4 class="form-section">Informações Básicas</h4>
                                            <div class="row">
                                                @include('layouts.components.name', ['data' => $user['data']])
                                                @include('layouts.components.email', ['data' => $user['data']])
                                            </div>
                                            <h4 class="form-section">Endereço</h4>
                                            <div class="row">
                                                @include('layouts.components.address', ['data' => $user['data']])
                                                @include('layouts.components.number', ['data' => $user['data']])
                                            </div>
                                            <div class="row">
                                                @include('layouts.components.neighborhood', ['data' => $user['data']])
                                                @include('layouts.components.complement', ['data' => $user['data']])
                                            </div>
                                            <div class="row">
                                                @include('layouts.components.zipcode', ['data' => $user['data']])
                                            </div>
                                            <h4 class="form-section">Contato</h4>
                                            @include('layouts.components.contact', ['contacts' => $user['data']['contacts']['data']])
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"></div>
                                                @include('layouts.components.required')
                                            </div>
                                        </div>
                                        @include('layouts.components.form-actions')
                                    </form>
                                </div>
                                <div class="tab-pane"
                                     id="changePassword">
                                    <form action="{{ url('/profile/password') }}"
                                          id="form_sample_2"
                                          method="post"
                                          class="horizontal-form"
                                          novalidate="novalidate">
                                        {{ csrf_field() }}
                                        <div class="form-body">
                                            <div class="row">
                                                @include('layouts.components.current-password')
                                            </div>
                                            <div class="row">
                                                @include('layouts.components.new-password')
                                                @include('layouts.components.password-confirmation')
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"></div>
                                                @include('layouts.components.required')
                                            </div>
                                        </div>
                                        @include('layouts.components.form-actions')
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    jQuery(document).ready(function () {
        Dropzone.autoDiscover = false;
        // Dropzone to upload avatar
        $('#avatar').dropzone({
            url: '/uploads/upload-avatar',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            method: 'post',
            maxFiles: 1,
            maxfilesexceeded: function (file) {
                this.removeFile(file);
            },

            error: function (file, responseText) {
                file.previewElement.classList.add('dz-error');
                swal('Erro :(', responseText, 'error')
            }
        });
    });
</script>
<script src="{{ asset('assets/global/plugins/dropzone/dropzone.min.js') }}" type="text/javascript"></script>
@endpush
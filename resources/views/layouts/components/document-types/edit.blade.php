@extends('layouts.app')

@push('stylesheets')
    <link href="{{ asset('assets/global/plugins/summernote/css/summernote.css') }}"
          rel="stylesheet"
          type="text/css"/>
    <style>
        @font-face {
            font-family: summernote;
            src: url({{ asset('assets/global/plugins/summernote/fonts/summernote.ttf') }});
            src: local('summernote.ttf');
            src: url({{ asset('assets/global/plugins/summernote/fonts/summernote.woff') }});
        }

        @media print {
            body {
                display: table;
                table-layout: fixed;
                padding: 2.5cm;
                height: auto;
            }
        }
    </style>
@endpush

@section('content')

    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <span>Menu</span>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Receituário</span>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <spam>Editar Tipo</spam>
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
                                <span class="caption-subject bold uppercase">
                                    <i class="fa fa-pencil-square-o"
                                       aria-hidden="true"></i>
                                    Listar Tipos
                                </span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <div class="tab-content">
                                <div class="tab-pane active"
                                     id="personalInfo">
                                    <form action="{{ url($extraData['middleware'] . '/document/types/' . $documentType['data']['id'] . '/edit') }}"
                                          data-toggle="validator"
                                          id="form_sample_2"
                                          class="horizontal-form"
                                          method="post"
                                          novalidate="novalidate">
                                        <div class="form-body">
                                            {{ method_field('PUT') }}
                                            {{ csrf_field() }}
                                            <div class="row">
                                                <div class="form-body">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="control-label"
                                                                   for="name">Nome do documento</label>
                                                            @include('layouts.components.asterisk')
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-book"
                                                                       aria-hidden="true"></i>
                                                                </span>
                                                                <input class="form-control"
                                                                       placeholder="Nome do documento"
                                                                       id="name"
                                                                       name="name"
                                                                       title="Nome do documento"
                                                                       maxlength="50"
                                                                       data-error="Campo obrigatório. Digite o nome do documento."
                                                                       value="{{ old('name') ?? $documentType['data']['name'] ?? null }}"
                                                                       required>
                                                            </div>
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                        <textarea class="summernote"
                                                                  id="description"
                                                                  name="description"
                                                                  title="Modelo de documento">
                                                            {!! $documentType['data']['description'] !!}
                                                        </textarea>
                                                        </div>
                                                    </div>
                                                </div>
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
    <script src="{{ asset('assets/global/plugins/summernote/js/validator.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/summernote/js/summernote.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/summernote/js/summernote-ext-print.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/summernote/js/summernote-pt-BR.js') }}"
            type="text/javascript"></script>
    <script>
        jQuery(document).ready(function () {
            $('#description').summernote(
                {
                    lang: 'pt-BR',
                    toolbar: [
                        ['style', ['style']],
                        ['fontsize', ['fontsize']],
                        ['font', ['bold', 'italic', 'underline']],
                        ['fontname', ['fontname']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                        ['table', ['table']],
                        ['misc', ['print']]
                    ]
                }
            );
        });
    </script>
@endpush
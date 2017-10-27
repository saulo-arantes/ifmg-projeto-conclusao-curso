@extends('layouts.app')

@push('stylesheets')
    <link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}"
          rel="stylesheet"
          type="text/css"/>
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
                padding: 40cm;
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
                        <span>Gerar Receita</span>
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
                                    <i class="fa fa-print"
                                       aria-hidden="true"></i>
                                    Gerar Receita
                                </span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <div class="tab-content">
                                <div class="tab-pane active"
                                     id="personalInfo">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="portlet light bordered"
                                                 id="form_wizard_1">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class=" icon-layers font-red"></i>
                                                        <span class="caption-subject font-blue-hoki bold uppercase"> Gerar Receita -
                                                            <span class="step-title"> Passo 1 de 3 </span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="portlet-body form">
                                                    <form class="form-horizontal"
                                                          action="#"
                                                          id="submit_form"
                                                          method="POST">
                                                        <div class="form-wizard">
                                                            <div class="form-body">
                                                                <ul class="nav nav-pills nav-justified steps">
                                                                    <li>
                                                                        <a href="#tab1"
                                                                           data-toggle="tab"
                                                                           class="step">
                                                                            <span class="number"> 1 </span>
                                                                            <span class="desc">
                                                                    <i class="fa fa-check"></i> Selecione o documento </span>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#tab2"
                                                                           data-toggle="tab"
                                                                           class="step">
                                                                            <span class="number"> 2 </span>
                                                                            <span class="desc">
                                                                    <i class="fa fa-check"></i> Preencha os dados </span>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#tab3"
                                                                           data-toggle="tab"
                                                                           class="step active">
                                                                            <span class="number"> 3 </span>
                                                                            <span class="desc">
                                                                    <i class="fa fa-check"></i> Edite e imprima o documento </span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                                <div id="bar"
                                                                     class="progress progress-striped"
                                                                     role="progressbar">
                                                                    <div class="progress-bar progress-bar-success"></div>
                                                                </div>
                                                                <div class="tab-content">
                                                                    <div class="alert alert-danger display-none">
                                                                        <button class="close"
                                                                                data-dismiss="alert"></button>
                                                                        Preencha todos os campos obrigatórios antes de prosseguir.
                                                                    </div>
                                                                    <div class="alert alert-success display-none">
                                                                        <button class="close"
                                                                                data-dismiss="alert"></button>
                                                                        Your form validation is successful!
                                                                    </div>

                                                                    {{-- STEP 1 --}}
                                                                    <div class="tab-pane active"
                                                                         id="tab1">
                                                                        <div class="form-group">
                                                                            <div class="col-md-12">
                                                                                <h4 align="center">Selecione o tipo de
                                                                                                   documento e um
                                                                                                   exemplo do modelo
                                                                                                   será apresentado
                                                                                                   abaixo.</h4>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <select id="document_type_id"
                                                                                            name="document_type_id"
                                                                                            class="form-control"
                                                                                            data-placeholder="Tipo de Documento"
                                                                                            onchange="updateDocumentExibition(this.value);"
                                                                                            title="Tipo de documento"
                                                                                            required>
                                                                                        <option value=""
                                                                                                selected>Selecionar o
                                                                                                         tipo de
                                                                                                         documento
                                                                                        </option>
                                                                                        @foreach ($extraData['documentTypes'] as $document)
                                                                                            <option value="{{ $document->description }}">{{ $document->name }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    <div class="help-block with-errors"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    {{-- STEP 2 --}}
                                                                    <div class="tab-pane"
                                                                         id="tab2">
                                                                        <div class="form-group">
                                                                            <div class="col-md-12">
                                                                                <h4 align="center">Preencha os
                                                                                                   dados</h4>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                                                                                <label class="control-label"
                                                                                       for="patient_id">Selecione o
                                                                                                        paciente</label>
                                                                                @include('layouts.components.asterisk')
                                                                                <div class="form-group">
                                                                                    <select id="patient_id"
                                                                                            name="patient_id"
                                                                                            class="form-control"
                                                                                            onchange="updatePatientInDocumentExibition(this.value);"
                                                                                            title="Paciente"
                                                                                            required>
                                                                                        <option value=""
                                                                                                selected>Selecionar o
                                                                                                         paciente
                                                                                        </option>
                                                                                        @foreach ($extraData['patients'] as $patient)
                                                                                            <option value="{{ $patient->name }}" {{ @$extraData['patient'] == $patient->name ? 'selected' : '' }}>{{ $patient->name }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    <div class="help-block with-errors"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            @include('layouts.components.document-date', ['extraData' => $extraData])
                                                                        </div>
                                                                    </div>

                                                                    {{-- STEP 3 --}}
                                                                    <div class="tab-pane"
                                                                         id="tab3">
                                                                        <div class="form-group">
                                                                            <div class="col-md-12">
                                                                                <h4 align="center">Edite e imprima o
                                                                                                   documento</h4>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                            <div class="form-group">
                                                                                <textarea class="summernote"
                                                                                          id="description"
                                                                                          name="description"
                                                                                          title="Modelo de documento">
                                                                                </textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-actions">
                                                                <div class="row">
                                                                    <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                                                                        <a href="javascript:;"
                                                                           class="btn default button-previous">
                                                                            <i class="fa fa-angle-left"></i> Voltar </a>
                                                                        <a href="javascript:;"
                                                                           class="btn btn-outline green button-next">
                                                                            Prosseguir
                                                                            <i class="fa fa-angle-right"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    <script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/summernote/js/summernote.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/summernote/js/summernote-ext-print.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/summernote/js/summernote-pt-BR.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/pages/scripts/form-wizard.min.js') }}"
            type="text/javascript"></script>
    <script>

        $('#date_input').on('change', function () {
            var dateInput = $('#date_input').val();
            $('.date').html(dateInput);
            $('.extensive_date').html(getExtensiveDate());
        });

        function updateDocumentExibition(value) {
            var description = $('#description');
            description.summernote('code', '');
            description.summernote('editor.pasteHTML', value);

            $('#documentExibition').html(value);
            setCurrentDateInDocumentExibition();
            $('.extensive_date').html(getExtensiveDate());
            $('.doctor').html('{{ $extraData['doctor'] }}');

            var patient = $('.patient').html();

            @if (!empty($extraData['patient']))
            $('.patient').html('{{ $extraData['patient'] }}');
            @endif
        }

        function updatePatientInDocumentExibition(value) {
            $('.patient').html(value);
        }

        function setCurrentDateInDocumentExibition() {
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1;
            var yyyy = today.getFullYear();

            if (dd < 10) {
                dd = '0' + dd;
            }

            if (mm < 10) {
                mm = '0' + mm;
            }

            today = dd + '/' + mm + '/' + yyyy;
            $('.date').html(today);
        }

        function getExtensiveDate() {
            var meses = [
                'Janeiro',
                'Fevereiro',
                'Março',
                'Abril',
                'Maio',
                'Junho',
                'Julho',
                'Agosto',
                'Setembro',
                'Outubro',
                'Novembro',
                'Dezembro'];

            var semana = [
                'Domingo',
                'Segunda-feira',
                'Terça-feira',
                'Quarta-feira',
                'Quinta-feira',
                'Sexta-feira',
                'Sábado'];

            var dateInput = $('#date_input').val();

            dateInput = dateInput.split('/');
            var dateInputYear = dateInput[2];
            var dateInputMonth = parseInt(dateInput[1]) - 1;
            var dateInputDay = parseInt(dateInput[0]);

            hoje = new Date(dateInputYear, dateInputMonth, dateInputDay);
            dia = hoje.getDate();
            dias = hoje.getDay();
            mes = hoje.getMonth();
            ano = hoje.getYear();

            if (navigator.appName === 'Netscape')
                ano = ano + 1900;

            diaext = semana[dias] + ', ' + dia + ' de ' + meses[mes]
                + ' de ' + ano;

            return diaext;
        }

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
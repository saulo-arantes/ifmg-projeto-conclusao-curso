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
                padding: 2.5cm;
                height: auto;
            }
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div id="wizard"
             class="form_wizard wizard_horizontal">
            <ul class="wizard_steps">
                <li>
                    <a href="#step-1">
                        <span class="step_no">1</span>
                        <span class="step_descr">
                        Passo 1<br/>
                        <small>Selecione o documento</small>
                    </span>
                    </a>
                </li>
                <li>
                    <a href="#step-2">
                        <span class="step_no">2</span>
                        <span class="step_descr">Passo 2<br/>
                          <small>Preencha os dados</small>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#step-3">
                        <span class="step_no">3</span>
                        <span class="step_descr">Passo 3<br/>
                        <small>Edite e imprima o documento</small>
                    </span>
                    </a>
                </li>
            </ul>

            {{-- STEP 1 --}}
            <div id="step-1"
                 style="height: 400px">
                <div class="row">
                    <div class="col-md-12">
                        <h4 align="center">Selecione o tipo de documento e um exemplo do modelo será apresentado
                                           abaixo.</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <select id="document_type_id"
                                    name="document_type_id"
                                    class="form-control"
                                    onchange="updateDocumentExibition(this.value);"
                                    title="Tipo de documento">
                                <option value=""
                                        selected>Selecionar o tipo de documento
                                </option>
                                @foreach ($extraData['documentTypes'] as $document)
                                    <option value="{{ $document->description }}">{{ $document->name }}</option>
                                @endforeach
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-sm-12">
                        <div id="documentExibition"
                             class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12"
                             style="margin-top: 20px; color: black"></div>
                    </div>
                </div>
            </div>

            {{-- STEP 2 --}}
            <div id="step-2">
                <div class="row">
                    <div class="col-md-12">
                        <h4 align="center">Preencha os dados</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                        <label class="control-label"
                               for="patient_id">Selecione o paciente</label>
                        @include('layouts.components.asterisk')
                        <div class="form-group">
                            <select id="patient_id"
                                    name="patient_id"
                                    class="form-control"
                                    onchange="updatePatientInDocumentExibition(this.value);"
                                    title="Paciente">
                                <option value=""
                                        selected>Selecionar o paciente
                                </option>
                                @foreach ($extraData['patients'] as $patient)
                                    <option value="{{ $patient->name }}" {{ @$extraData['patient'] == $patient->name ? 'selected' : '' }}>{{ $patient->name }}</option>
                                @endforeach
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @include('layouts.components.document-date', ['extraData' => $extraData])
                </div>
            </div>

            {{-- STEP 3 --}}
            <div id="step-3"
                 style="height: 400px">
                <div class="row">
                    <div class="col-md-12">
                        <h4 align="center">Edite e imprima o documento</h4>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <div class="summernote"
                             id="description"
                             title="Documento">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/global/plugins/select2/js/select2.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-smartWizard/js/jquery.smartWizard.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/summernote/js/summernote.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/summernote/js/summernote-ext-print.js') }}"
            type="text/javascript"></script>
    <script src="https://raw.githubusercontent.com/taalendigitaal/bootstrap-summernote/master/lang/summernote-pt-BR.js"
            type="text/javascript"></script>
    <script>
        $('select').select2();

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

        $(document).ready(function () {
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
                        ['misc', ['print']],
                    ],
                }
            );
        });
    </script>
@endpush
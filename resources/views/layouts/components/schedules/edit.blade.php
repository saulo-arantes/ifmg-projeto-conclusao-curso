@extends('layouts.app')

@push('stylesheets')

<link href="{{ asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}"
      rel="stylesheet"
      type="text/css"/>

<style>
    textarea {
        resize: none;
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
                        <i class="fa fa-circle"
                           aria-hidden="true"></i>
                    </li>
                    <li>
                        <span>Agenda e Compromissos</span>
                        <i class="fa fa-circle"
                           aria-hidden="true"></i>
                    </li>
                    <li>
                        <span>Editar Consulta</span>
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
                                    <i class="fa fa-wheelchair"
                                       aria-hidden="true"></i>
                                    Editar Consulta
                                </span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form action="{{ url($extraData['middleware'].'/schedules/'.$schedule['data']['id'].'/edit') }}">
                                id="form_sample_2"
                                method="post"
                                class="horizontal-form"
                                novalidate="novalidate">
                                <div class="form-body">
                                    {{ dd($schedule['data']['id']) }}
                                    {{ csrf_field() }}
                                    <div class="row">
                                        @include('layouts.components.doctor', ['data' => $schedule['data']])
                                        @include('layouts.components.patient', ['data' => $schedule['data']])
                                    </div>
                                    <div class="row">
                                        @include('layouts.components.start-at', ['data' => $schedule['data']])
                                        @include('layouts.components.finish-at', ['data' => $schedule['data']])
                                    </div>
                                    <div class="row">
                                        @include('layouts.components.description', ['data' => $schedule['data']])
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
@endsection

@push('scripts')
<script src="{{ asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.pt-BR.js') }}"
        type="text/javascript"></script>

<script>
    $("#patient").attr("data-placeholder", "Paciente");
    $("#patient").select2();
    $("#doctor").attr("data-placeholder", "Médico");
    $("#doctor").select2();
</script>

@endpush
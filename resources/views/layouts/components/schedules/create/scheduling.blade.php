@extends('layouts.app')

@push('stylesheets')
    <link href="{{ asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}"
          rel="stylesheet"
          type="text/css"/>
    <style>
        textarea {
            resize: none;
        }

        #dates{
            margin-bottom: 25px;
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
                        <span>Novo Compromisso</span>
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
                                    <i class="fa fa-calendar"
                                       aria-hidden="true"></i>
                                    Novo Compromisso
                                </span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form action="{{ url($extraData['middleware'].'/schedules/create/') }}"
                                  id="form_sample_2"
                                  method="post"
                                  class="horizontal-form"
                                  novalidate="novalidate">
                                <div class="form-body">
                                    {{ csrf_field() }}
                                    @if (App\Entities\User::getUserMiddleware() != App\Entities\User::DOCTOR)
                                        <div class="row">
                                            @include('layouts.components.doctor')
                                        </div>
                                    @endif
                                    <div class="row" id="dates">
                                        @include('layouts.components.start-at')
                                        @include('layouts.components.finish-at')
                                    </div>
                                    <div class="row">
                                        @include('layouts.components.description')
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
    <script src="{{ asset('assets/global/plugins/moment.min.js') }}"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"
            type="text/javascript"></script>
    <script type="text/javascript">
        $('#start_at').datetimepicker({
            inline: true,
            sideBySide: true,
            locale: 'pt-br'
        });
        $('#finish_at').datetimepicker({
            inline: true,
            sideBySide: true,
            locale: 'pt-br'
        });
    </script>
@endpush
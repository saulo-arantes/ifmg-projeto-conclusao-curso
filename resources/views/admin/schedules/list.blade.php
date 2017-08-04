@extends('layouts.app')

@push('stylesheets')

<link href="{{ asset('assets/global/plugins/datatables/DataTables-1.10.12/plugins/bootstrap/datatables.bootstrap.css') }}"
      rel="stylesheet">
<link href="{{ asset('assets/global/plugins/datatables/DataTables-1.10.12/plugins/buttons/dataTables.buttons.min.css') }}"
      rel="stylesheet">
<link href="{{ asset('assets/global/plugins/datatables/DataTables-1.10.12/plugins/responsive/dataTables.responsive.min.css') }}"
      rel="stylesheet">
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
                        <span>Agenda</span>
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
                                <i class="fa fa-calendar"
                                   aria-hidden="true"></i>
                                <span class="caption-subject bold uppercase">
                                    Agenda</span>
                            </div>
                        </div>

                        <div class="portlet-body form">
                            <div class="x_panel" style="padding: 10px 15px;">
                                <div class="nav navbar-right panel_toolbox" style="margin-bottom: 5px;">
                                    <a class="btn btn-success"
                                       href="{{ url('/manager/schedules/create/appointment') }}">
                                        <i class="fa fa-clock-o"
                                        ></i> Novo compromisso
                                    </a>
                                    <a class="btn btn-info"
                                       href="{{ url('/manager/schedules/create/scheduling') }}">
                                        <i class="fa fa-medkit"
                                        ></i> Nova consulta
                                    </a>
                                    <a class="btn btn-default"
                                       href="{{ url('/manager/schedules/calendar') }}"
                                        style="margin-right: 15px">
                                        <i class="fa fa-list"
                                        ></i> Formato Calendário
                                    </a>
                                </div>
                                <div class="clearfix"></div>
                            {!! $dataTable->table() !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h2>Legenda</h2>
                            <table>
                                <tr>
                                    <td style="padding:0 15px 0 15px;">
                                        <label class="label label-xs label-success">Verde</label></td>
                                    <td>Compromisso futuro</td>
                                </tr>
                                <tr>
                                    <td style="padding:0 15px 0 15px;">
                                        <label class="label label-xs alert-info">Azul</label></td>
                                    <td>Agendamento futuro</td>
                                </tr>
                                <tr>
                                    <td style="padding:0 15px 0 15px;">
                                        <label class="label label-xs label-default">Preto</label></td>
                                    <td>Passado</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('scripts')

<script src="{{ asset('assets/global/plugins/datatables/DataTables-1.10.12/plugins/jquery/dataTables.jquery.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/DataTables-1.10.12/plugins/bootstrap/datatables.bootstrap.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/DataTables-1.10.12/plugins/buttons/dataTables.buttons.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/DataTables-1.10.12/plugins/responsive/dataTables.responsive.min.js') }}"
        type="text/javascript"></script>


{!! $dataTable->scripts() !!}
@endpush
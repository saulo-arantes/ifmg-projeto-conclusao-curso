@extends('layouts.app')

@push('stylesheets')

<link href="{{ asset('assets/global/plugins/datatables/DataTables-1.10.12/plugins/bootstrap/datatables.bootstrap.css') }}"
      rel="stylesheet">
<link href="{{ asset('assets/global/plugins/datatables/DataTables-1.10.12/plugins/buttons/dataTables.buttons.min.css') }}"
      rel="stylesheet">
<link href="{{ asset('assets/global/plugins/datatables/DataTables-1.10.12/plugins/responsive/dataTables.responsive.min.css') }}"
      rel="stylesheet">
<style>
    .button {
        width: 200px;
        padding: 5px;
        margin: 3px;
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
                        <span>Tabela</span>
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
                                <span class="caption-subject bold uppercase"><i class="fa fa-table"
                                                                                aria-hidden="true"></i>
                                    Tabela</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="panel_toolbox"
                                 style="float: right; margin-bottom: 20px;">
                                <a class="btn btn-success button"
                                   href="{{ url(App\Entities\User::getUserMiddleware().'/schedules/create/scheduling') }}">
                                    <i class="fa fa-clock-o"></i> Novo compromisso
                                </a>
                                <a class="btn btn-info button"
                                   href="{{ url(App\Entities\User::getUserMiddleware().'/schedules/create/appointment') }}">
                                    <i class="fa fa-medkit"></i> Nova consulta
                                </a>
                                <a class="btn btn-default button"
                                   href="{{ url(App\Entities\User::getUserMiddleware().'/schedules/calendar') }}">
                                    <i class="fa fa-calendar"></i> Formato Calendário
                                </a>
                            </div>
                            {!! $dataTable->table() !!}
                            <h2>Legenda</h2>
                            <i class="fa fa-circle"
                               aria-hidden="true"
                               style="color: #36c6d3; font-size: 20px;"></i> Compromisso futuro<br>
                            <i class="fa fa-circle"
                               aria-hidden="true"
                               style="color: #659be0; font-size: 20px;"></i> Agendamento futuro<br>
                            <i class="fa fa-circle"
                               aria-hidden="true"
                               style="color: #333; font-size: 20px;"></i> Passado
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
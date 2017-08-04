@extends('layouts.app')

@push('stylesheets')
    <link href="{{ asset('css/datatables/dataTables.bootstrap.min.css') }}"
          rel="stylesheet">
    <link rel="stylesheet"
          href="{{ asset('css/datatables/dataTables.buttons.min.css') }}">
    <link href="{{ asset('css/datatables/dataTables.responsive.min.css') }}"
          rel="stylesheet">
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Agenda</h2>
                    <div class="nav navbar-right panel_toolbox">
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
                           href="{{ url('/manager/schedules/calendar') }}">
                            <i class="fa fa-list"
                            ></i> Formato Calendário
                        </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    {!! $dataTable->table() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <h2>Legenda</h2>
            <table>
                <tr>
                    <td style="padding:0 15px 0 15px;"><label class="label label-xs label-success">Verde</label></td><td>Compromisso futuro</td>
                </tr>
                <tr>
                    <td style="padding:0 15px 0 15px;"><label class="label label-xs alert-info">Azul</label></td><td>Agendamento futuro</td>
                </tr>
                <tr>
                    <td style="padding:0 15px 0 15px;"><label class="label label-xs label-default">Preto</label></td><td>Passado</td>
                </tr>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/datatables/dataTables.jquery.min.js') }}"></script>
    <script src="{{ asset('js/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    {!! $dataTable->scripts() !!}
@endpush
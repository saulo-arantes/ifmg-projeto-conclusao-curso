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
                        <spam>Listar Tipos</spam>
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
                                <span class="caption-subject bold uppercase"> Novo Tipo </span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            {!! $dataTable->table() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('assets/global/scripts/datatable.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/DataTables-1.10.12/datatables.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/DataTables-1.10.12/plugins/bootstrap/datatables.bootstrap.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/pages/scripts/table-datatables-buttons.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    {!! $dataTable->scripts() !!}
@endpush
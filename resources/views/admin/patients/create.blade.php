@extends('layouts.app')

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
                        <span>Pacientes</span>
                        <i class="fa fa-circle"
                           aria-hidden="true"></i>
                    </li>
                    <li>
                        <span>Adicionar</span>
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
                                <span class="caption-subject bold uppercase">Adicionar paciente</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form action="{{ url('/admin/users/create') }}"
                                  id="form_sample_2"
                                  method="post"
                                  class="horizontal-form"
                                  novalidate="novalidate">
                                <div class="form-body">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        @include('layouts.components.name')
                                        @include('layouts.components.sex')
                                    </div>
                                    <div class="row">
                                        @include('layouts.components.rg')
                                        @include('layouts.components.cpf')
                                    </div>
                                    <div class="row">
                                        @include('layouts.components.marital-status')
                                        @include('layouts.components.blood-type')
                                    </div>
                                    <div class="row">
                                        @include('layouts.components.address')
                                        @include('layouts.components.number')
                                    </div>
                                    <div class="row">
                                        @include('layouts.components.neighborhood')
                                        @include('layouts.components.complement')
                                    </div>
                                    <div class="row">
                                        @include('layouts.components.zipcode' )
                                    </div>
                                    <div class="row">
                                        @include('layouts.components.height')
                                        @include('layouts.components.weight')
                                    </div>
                                    <div class="row">
                                        @include('layouts.components.allergic')

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
    <script src="{{ asset('global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('pages/scripts/form-validation.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('global/plugins/jquery-validation/js/jquery.validate.min.js') }}"
            type="text/javascript"></script>
@endpush
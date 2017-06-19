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
                        <span>Administradores</span>
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
                                <span class="caption-subject bold uppercase">Adicionar administrador</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form action="{{ url('/admin/administrators/create') }}"
                                  id="form_sample_2"
                                  method="post"
                                  class="horizontal-form"
                                  novalidate="novalidate">
                                <div class="form-body">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        @include('layouts.components.name', ['data' => $user])
                                        @include('layouts.components.email', ['data' => $user])
                                    </div>
                                    <div class="row">
                                        @include('layouts.components.status', ['data' => $user])
                                    </div>
                                    <div class="row">
                                        @include('layouts.components.new-password')
                                        @include('layouts.components.password-confirmation')
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
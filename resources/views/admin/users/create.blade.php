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
                        <span>Usuários</span>
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

                                <span class="caption-subject bold uppercase">
                                    <i class="fa fa-user"
                                       aria-hidden="true"></i>
                                    Adicionar usuário
                                </span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form action="{{ url('/admin/users/create') }}"
                                  id="form_sample_2"
                                  method="post"
                                  data-toggle="validator"
                                  class="horizontal-form"
                                  novalidate="novalidate">
                                <div class="form-body">
                                    {{ csrf_field() }}
                                    <h4 class="form-section">Informações Básicas</h4>
                                    <div class="row">
                                        @include('layouts.components.name')
                                        @include('layouts.components.email')
                                    </div>
                                    <div class="row">
                                        @include('layouts.components.status')
                                        @include('layouts.components.role')
                                    </div>
                                    <h4 class="form-section">Endereço</h4>
                                    <div class="row">
                                        @include('layouts.components.address')
                                        @include('layouts.components.number')
                                    </div>
                                    <div class="row">
                                        @include('layouts.components.neighborhood')
                                        @include('layouts.components.complement')
                                    </div>
                                    <div class="row">
                                        @include('layouts.components.zipcode')
                                    </div>
                                    <h4 class="form-section">Contato</h4>
                                    @include('layouts.components.contact')
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
<script src="{{ asset('global/plugins/jquery-validation/js/jquery.validate.min.js') }}"
        type="text/javascript"></script>
@endpush
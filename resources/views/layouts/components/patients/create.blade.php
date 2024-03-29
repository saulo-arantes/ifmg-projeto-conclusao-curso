@extends('layouts.app')

@push('stylesheets')
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
                                <span class="caption-subject bold uppercase">
                                    <i class="fa fa-plus-square"
                                       aria-hidden="true"></i>
                                    Adicionar paciente
                                </span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form action="{{ url($extraData['middleware'].'/patients/create') }}"
                                  data-toggle="validator"
                                  id="form_sample_2"
                                  method="post"
                                  class="horizontal-form"
                                  novalidate="novalidate">
                                <div class="form-body">
                                    {{ csrf_field() }}
                                    <h4 class="form-section">Informações Básicas</h4>
                                    <div class="row">
                                        @include('layouts.components.doctors')
                                    </div>
                                    <div class="row">
                                        @include('layouts.components.name')
                                        @include('layouts.components.sex')
                                    </div>
                                    <div class="row">
                                        @include('layouts.components.rg')
                                        @include('layouts.components.cpf')
                                    </div>
                                    <div class="row">
                                        @include('layouts.components.birthday-date')
                                    </div>
                                    <h4 class="form-section">Contato</h4>
                                    @include('layouts.components.contact')
                                    <h4 class="form-section">Naturalidade</h4>
                                    <div class="row">
                                        @include('layouts.components.state')
                                        @include('layouts.components.naturalness')
                                    </div>
                                    <h4 class="form-section">Endereço</h4>
                                    <div class="row">
                                        @include('layouts.components.state', ['city' => true])
                                        @include('layouts.components.city')
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
                                        @include('layouts.components.zipcode')
                                    </div>
                                    <h4 class="form-section">Informações Adicionais</h4>
                                    <div class="row">
                                        @include('layouts.components.marital-status')
                                        @include('layouts.components.blood-type')
                                    </div>
                                    <div class="row">
                                        @include('layouts.components.height')
                                        @include('layouts.components.weight')
                                    </div>
                                    <div class="row">
                                        @include('layouts.components.allergic')
                                    </div>
                                    <div class="row">
                                        @include('layouts.components.observation')
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
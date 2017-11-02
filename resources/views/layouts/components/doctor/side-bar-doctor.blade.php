<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu page-header-fixed page-sidebar-menu-closed"
            data-keep-expanded="false"
            data-auto-scroll="true"
            data-slide-speed="200">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <li class="nav-item start {{ Request::is('profile') ? 'active' : '' }}">
                <a href="{{ url('/profile') }}"
                   class="nav-link ">
                    <i class="fa fa-home"
                       aria-hidden="true"></i>
                    <span class="title">Início</span>
                </a>
            </li>
            <li class="nav-item start {{ Request::is('doctor/patients') ? 'active' : '' }} {{ Request::is('doctor/patients/create') ? 'active' : '' }}">
                <a href="javascript:;"
                   class="nav-link nav-toggle">
                    <i class="fa fa-wheelchair"
                       aria-hidden="true"></i>
                    <span class="title">Paciente</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start {{ Request::is('doctor/patients/create') ? 'active' : '' }}">
                        <a href="{{ url('/doctor/patients/create') }}"
                           class="nav-link ">
                            <i class="fa fa-plus-square"
                               aria-hidden="true"></i>
                            <span class="title">Adicionar</span>
                        </a>
                    </li>
                    <li class="nav-item start {{ Request::is('doctor/patients') ? 'active' : '' }}">
                        <a href="{{ url('/doctor/patients') }}"
                           class="nav-link ">
                            <i class="fa fa-list"
                               aria-hidden="true"></i>
                            <span class="title">Listar</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item start {{ Request::is('doctor/schedules') ? 'active' : '' }} {{ Request::is('doctor/schedules/calendar') ? 'active' : '' }}">
                <a href="javascript:;"
                   class="nav-link nav-toggle">
                    <i class="fa fa-address-book"
                       aria-hidden="true"></i>
                    <span class="title">Agenda e Compromissos</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start {{ Request::is('doctor/schedules/calendar') ? 'active' : '' }}">
                        <a href="{{ url('/doctor/schedules/calendar') }}"
                           class="nav-link ">
                            <i class="fa fa-calendar"
                               aria-hidden="true"></i>
                            <span class="title">Calendário</span>
                        </a>
                    </li>
                    <li class="nav-item start {{ Request::is('doctor/schedules') ? 'active' : '' }}">
                        <a href="{{ url('/doctor/schedules') }}"
                           class="nav-link ">
                            <i class="fa fa-table"
                               aria-hidden="true"></i>
                            <span class="title">Tabela</span>
                        </a>
                    </li>
                </ul>
            <li class="nav-item start {{ Request::is('doctor/document/types') ? 'active' : '' }} {{ Request::is('doctor/document/types/create') ? 'active' : '' }}">
                <a href="javascript:;"
                   class="nav-link nav-toggle">
                    <i class="fa fa-file-text"
                       aria-hidden="true"></i>
                    <span class="title">Receituário</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start {{ Request::is('doctor/document/types/create') ? 'active' : '' }}">
                        <a href="{{ url('/doctor/document/types/create') }}"
                           class="nav-link ">
                            <i class="fa fa-plus-square"
                               aria-hidden="true"></i>
                            <span class="title">Adicionar Tipo</span>
                        </a>
                    </li>
                    <li class="nav-item start {{ Request::is('doctor/document/types') ? 'active' : '' }}">
                        <a href="{{ url('/doctor/document/types') }}"
                           class="nav-link ">
                            <i class="fa fa-list"
                               aria-hidden="true"></i>
                            <span class="title">Listar Tipo</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item start {{ Request::is('doctor/document') ? 'active' : '' }}">
                <a href="{{ url('/doctor/document') }}">
                    <i class="fa fa-print"
                       aria-hidden="true"></i>
                    <span class="title">Gerar Receita</span>
                </a>
            </li>
            </li>
        </ul>
    </div>
</div>
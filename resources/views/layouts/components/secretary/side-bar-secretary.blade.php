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
            <li class="nav-item start {{ Request::is('secretary/patients') ? 'active' : '' }} {{ Request::is('secretary/patients/create') ? 'active' : '' }}">
                <a href="javascript:;"
                   class="nav-link nav-toggle">
                    <i class="fa fa-wheelchair"
                       aria-hidden="true"></i>
                    <span class="title">Paciente</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start {{ Request::is('secretary/patients/create') ? 'active' : '' }}">
                        <a href="{{ url('/secretary/patients/create') }}"
                           class="nav-link ">
                            <i class="fa fa-plus-square"
                               aria-hidden="true"></i>
                            <span class="title">Adicionar</span>
                        </a>
                    </li>
                    <li class="nav-item start {{ Request::is('secretary/patients') ? 'active' : '' }}">
                        <a href="{{ url('/secretary/patients') }}"
                           class="nav-link ">
                            <i class="fa fa-list"
                               aria-hidden="true"></i>
                            <span class="title">Listar</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item start {{ Request::is('secretary/schedules') ? 'active' : '' }} {{ Request::is('secretary/schedules/calendar') ? 'active' : '' }}">
                <a href="javascript:;"
                   class="nav-link nav-toggle">
                    <i class="fa fa-address-book"
                       aria-hidden="true"></i>
                    <span class="title">Agenda e Compromissos</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start {{ Request::is('secretary/schedules/calendar') ? 'active' : '' }}">
                        <a href="{{ url('/secretary/schedules/calendar') }}"
                           class="nav-link ">
                            <i class="fa fa-calendar"
                               aria-hidden="true"></i>
                            <span class="title">Calendário</span>
                        </a>
                    </li>
                    <li class="nav-item start {{ Request::is('secretary/schedules') ? 'active' : '' }}">
                        <a href="{{ url('/secretary/schedules') }}"
                           class="nav-link ">
                            <i class="fa fa-table"
                               aria-hidden="true"></i>
                            <span class="title">Tabela</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
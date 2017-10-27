<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu page-header-fixed page-sidebar-menu-closed page-sidebar-menu-light hidden-sm hidden-xs"
            data-keep-expanded="false"
            data-auto-scroll="true"
            data-slide-speed="200"
            style="padding-top: 10px">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <li class="nav-item start {{ Request::is('profile') ? 'active' : '' }}">
                <a href="{{ url('/profile') }}"
                   class="nav-link ">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    <span class="title">Início</span>
                </a>
            </li>
            <li class="nav-item start {{ Request::is('admin/users/create') ? 'active' : '' }} {{ Request::is('admin/users') ? 'active' : '' }}">
                <a href="javascript:;"
                   class="nav-link nav-toggle">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span class="title">Usuário</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start {{ Request::is('admin/users/create') ? 'active' : '' }}">
                        <a href="{{ url('/admin/users/create') }}"
                           class="nav-link ">
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                            <span class="title">Adicionar</span>
                        </a>
                    </li>
                    <li class="nav-item start {{ Request::is('admin/users') ? 'active' : '' }}">
                        <a href="{{ url('/admin/users') }}"
                           class="nav-link ">
                            <i class="fa fa-list" aria-hidden="true"></i>
                            <span class="title">Listar</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item start {{ Request::is('admin/patients') ? 'active' : '' }} {{ Request::is('admin/patients/create') ? 'active' : '' }}">
                <a href="javascript:;"
                   class="nav-link nav-toggle">
                    <i class="fa fa-wheelchair" aria-hidden="true"></i>
                    <span class="title">Paciente</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start {{ Request::is('admin/patients/create') ? 'active' : '' }}">
                        <a href="{{ url('/admin/patients/create') }}"
                           class="nav-link ">
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                            <span class="title">Adicionar</span>
                        </a>
                    </li>
                    <li class="nav-item start {{ Request::is('admin/patients') ? 'active' : '' }}">
                        <a href="{{ url('/admin/patients') }}"
                           class="nav-link ">
                            <i class="fa fa-list" aria-hidden="true"></i>
                            <span class="title">Listar</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item start {{ Request::is('admin/schedules') ? 'active' : '' }} {{ Request::is('admin/schedules/calendar') ? 'active' : '' }}">
                <a href="javascript:;"
                   class="nav-link nav-toggle">
                    <i class="fa fa-address-book" aria-hidden="true"></i>
                    <span class="title">Agenda e Compromissos</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start {{ Request::is('admin/schedules/calendar') ? 'active' : '' }}">
                        <a href="{{ url('/admin/schedules/calendar') }}"
                           class="nav-link ">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <span class="title">Calendário</span>
                        </a>
                    </li>
                    <li class="nav-item start {{ Request::is('admin/schedules') ? 'active' : '' }}">
                        <a href="{{ url('/admin/schedules') }}"
                           class="nav-link ">
                            <i class="fa fa-table" aria-hidden="true"></i>
                            <span class="title">Tabela</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item start {{ Request::is('admin/document/types') ? 'active' : '' }} {{ Request::is('admin/document/types/create') ? 'active' : '' }}">
                <a href="javascript:;"
                   class="nav-link nav-toggle">
                    <i class="fa fa-file-text" aria-hidden="true"></i>
                    <span class="title">Receituário</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start {{ Request::is('admin/document/types/create') ? 'active' : '' }}">
                        <a href="{{ url('/admin/document/types/create') }}"
                           class="nav-link ">
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                            <span class="title">Adicionar Tipo</span>
                        </a>
                    </li>
                    <li class="nav-item start {{ Request::is('admin/document/types') ? 'active' : '' }}">
                        <a href="{{ url('/admin/document/types') }}"
                           class="nav-link ">
                            <i class="fa fa-list" aria-hidden="true"></i>
                            <span class="title">Listar Tipo</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item start {{ Request::is('admin/document') ? 'active' : '' }}">
                <a href="{{ url('/admin/document') }}">
                    <i class="fa fa-print" aria-hidden="true"></i>
                    <span class="title">Gerar Receita</span>
                </a>
            </li>
            <li class="nav-item start {{ Request::is('admin/audits') ? 'active' : '' }}">
                <a href="{{ url('/admin/audits') }}">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Auditoria</span>
                </a>
            </li>
        </ul>
    </div>
</div>
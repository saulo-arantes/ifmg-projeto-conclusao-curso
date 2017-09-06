<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-light"
            data-keep-expanded="false"
            data-auto-scroll="true"
            data-slide-speed="200"
            style="padding-top: 20px">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <li class="sidebar-search-wrapper">
                <form class="sidebar-search  sidebar-search-bordered"
                      action="page_general_search_3.html"
                      method="POST">
                    <a href="javascript:;"
                       class="remove">
                        <i class="icon-close"></i>
                    </a>
                    <div class="input-group">
                        <input type="text"
                               class="form-control"
                               placeholder="Search...">
                        <span class="input-group-btn">
                            <a href="javascript:;"
                               class="btn submit">
                                <i class="fa fa-search"></i>
                            </a>
                        </span>
                    </div>
                </form>
            </li>
            <li class="nav-item start {{ Request::is('profile') ? 'active' : '' }}">
                <a href="{{ url('/profile') }}"
                   class="nav-link ">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    <span class="title">Início</span>
                </a>
            </li>
            <li class="nav-item start {{ Request::is('doctor/patients') ? 'active' : '' }} {{ Request::is('doctor/patients/create') ? 'active' : '' }}">
                <a href="javascript:;"
                   class="nav-link nav-toggle">
                    <i class="fa fa-wheelchair" aria-hidden="true"></i>
                    <span class="title">Paciente</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start {{ Request::is('doctor/patients/create') ? 'active' : '' }}">
                        <a href="{{ url('/doctor/patients/create') }}"
                           class="nav-link ">
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                            <span class="title">Adicionar</span>
                        </a>
                    </li>
                    <li class="nav-item start {{ Request::is('doctor/patients') ? 'active' : '' }}">
                        <a href="{{ url('/doctor/patients') }}"
                           class="nav-link ">
                            <i class="fa fa-list" aria-hidden="true"></i>
                            <span class="title">Listar</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item start {{ Request::is('doctor/schedules') ? 'active' : '' }} {{ Request::is('doctor/schedules/calendar') ? 'active' : '' }}">
                <a href="javascript:;"
                   class="nav-link nav-toggle">
                    <i class="fa fa-address-book" aria-hidden="true"></i>
                    <span class="title">Agenda e Compromissos</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start {{ Request::is('doctor/schedules/calendar') ? 'active' : '' }}">
                        <a href="{{ url('/doctor/schedules/calendar') }}"
                           class="nav-link ">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <span class="title">Calendário</span>
                        </a>
                    </li>
                    <li class="nav-item start {{ Request::is('doctor/schedules') ? 'active' : '' }}">
                        <a href="{{ url('/doctor/schedules') }}"
                           class="nav-link ">
                            <i class="fa fa-table" aria-hidden="true"></i>
                            <span class="title">Tabela</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item start {{ Request::is('notifications') ? 'active' : '' }}">
                <a href="{{ url('/doctor/logs') }}">
                    <i class="fa fa-warning" aria-hidden="true"></i>
                    <span class="title">Log</span>
                </a>
            </li>
        </ul>
    </div>
</div>
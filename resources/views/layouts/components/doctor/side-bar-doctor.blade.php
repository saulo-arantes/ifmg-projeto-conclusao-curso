<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-light"
            data-keep-expanded="false"
            data-auto-scroll="true"
            data-slide-speed="200"
            style="padding-top: 20px">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <!-- END SIDEBAR TOGGLER BUTTON -->
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
            <li class="sidebar-search-wrapper">
                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
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
                                <i class="icon-magnifier"></i>
                            </a>
                        </span>
                    </div>
                </form>
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>
            <li class="nav-item start ">
                <a href="{{ url('/') }}"
                   class="nav-link ">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    <span class="title">Início</span>
                </a>
            </li>
            <li class="nav-item start ">
                <a href="javascript:;"
                   class="nav-link nav-toggle">
                    <i class="fa fa-wheelchair" aria-hidden="true"></i>
                    <span class="title">Paciente</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start ">
                        <a href="{{ url('/doctor/patients/create') }}"
                           class="nav-link ">
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                            <span class="title">Adicionar</span>
                        </a>
                    </li>
                    <li class="nav-item start ">
                        <a href="{{ url('/doctor/patients') }}"
                           class="nav-link ">
                            <i class="fa fa-list" aria-hidden="true"></i>
                            <span class="title">Listar</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item start ">
                <a href="{{ url('/doctor/logs') }}">
                    <i class="fa fa-calendar-times-o" aria-hidden="true"></i>
                    <span class="title">Log</span>
                </a>
            </li>
            <li class="heading">
                <h3 class="uppercase">Features</h3>
            </li>
            <li class="nav-item">
                <a href="javascript:;"
                   class="nav-link nav-toggle">
                    <i class="icon-folder"></i>
                    <span class="title">Multi Level Menu</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu"
                    style="display: none;">
                    <li class="nav-item">
                        <a href="javascript:;"
                           class="nav-link nav-toggle">
                            <i class="icon-settings"></i> Item 1
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu"
                            style="display: none;">
                            <li class="nav-item">
                                <a href="javascript:;"
                                   target="_blank"
                                   class="nav-link">
                                    <i class="icon-user"></i> Arrow Toggle
                                    <span class="arrow nav-toggle"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item">
                                        <a href="#"
                                           class="nav-link">
                                            <i class="icon-power"></i> Sample Link 1</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#"
                                           class="nav-link">
                                            <i class="icon-paper-plane"></i> Sample Link 1</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#"
                                           class="nav-link">
                                            <i class="icon-star"></i> Sample Link 1</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#"
                                   class="nav-link">
                                    <i class="icon-camera"></i> Sample Link 1</a>
                            </li>
                            <li class="nav-item">
                                <a href="#"
                                   class="nav-link">
                                    <i class="icon-link"></i> Sample Link 2</a>
                            </li>
                            <li class="nav-item">
                                <a href="#"
                                   class="nav-link">
                                    <i class="icon-pointer"></i> Sample Link 3</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:;"
                           target="_blank"
                           class="nav-link">
                            <i class="icon-globe"></i> Arrow Toggle
                            <span class="arrow nav-toggle"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item">
                                <a href="#"
                                   class="nav-link">
                                    <i class="icon-tag"></i> Sample Link 1</a>
                            </li>
                            <li class="nav-item">
                                <a href="#"
                                   class="nav-link">
                                    <i class="icon-pencil"></i> Sample Link 1</a>
                            </li>
                            <li class="nav-item">
                                <a href="#"
                                   class="nav-link">
                                    <i class="icon-graph"></i> Sample Link 1</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#"
                           class="nav-link">
                            <i class="icon-bar-chart"></i> Item 3 </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item start ">
                <a href="index.html"
                   class="nav-link ">
                    <i class="icon-bar-chart"></i>
                    <span class="title">Dashboard 1</span>
                </a>
            </li>
            <li class="nav-item start ">
                <a href="dashboard_2.html"
                   class="nav-link ">
                    <i class="icon-bulb"></i>
                    <span class="title">Dashboard 2</span>
                    <span class="badge badge-success">1</span>
                </a>
            </li>
            <li class="nav-item start ">
                <a href="dashboard_3.html"
                   class="nav-link ">
                    <i class="icon-graph"></i>
                    <span class="title">Dashboard 3</span>
                    <span class="badge badge-danger">5</span>
                </a>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
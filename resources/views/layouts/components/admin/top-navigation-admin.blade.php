<div class="top-menu">
    <ul class="nav navbar-nav pull-right">
        <li class="dropdown dropdown-extended dropdown-dark dropdown-notification"
            id="header_notification_bar">
            <a href="javascript:" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
               data-close-others="true">
                <i class="fa fa-bell-o"></i>
                <span class="badge badge-danger"> {{ session('notificationsNotVisualizedCount') ?? 0 }} </span>
            </a>
            <ul class="dropdown-menu">
                <li class="external">
                    <h3>
                        <span class="bold">{{ session('notificationsNotVisualizedCount') ?? 0 }} notificações</span> pendentes
                    </h3>
                    <a href="{{ route('notifications.index') }}">Ver</a>
                </li>
                <li>
                    <ul class="dropdown-menu-list scroller" style="height: 250px;"
                        data-handle-color="#637283">
                        @foreach(session('notificationsNotVisualized') as $notification)
                            <li>{!! $notification !!}</li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </li>
        <li class="dropdown dropdown-user">
            <a href="javascript:;"
               class="dropdown-toggle"
               data-toggle="dropdown"
               data-hover="dropdown"
               data-close-others="true">
                @if(!empty(Auth::user()->photo))
                    <img alt=""
                         class="img-circle"
                         src="{{ asset('uploads/' . Auth::user()->photo) }}">
                @else
                    <img alt=""
                         class="img-circle"
                         src="{{ asset('assets/global/img/avatar.png') }}">
                @endif
                <span class="username username-hide-on-mobile"> {{ Auth::user()->name }} </span>
                <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-default">
                <li>
                    <a href="{{ url('/profile') }}">
                        <i class="fa fa-user"></i> Meu perfil </a>
                </li>
                <li>
                    <a href="{{ url('admin/schedules/calendar') }}">
                        <i class="fa fa-calendar"></i> Calendário </a>
                </li>
                <li>
                    <a href="{{ url('admin/schedules/') }}">
                        <i class="fa fa-address-book-o"></i> Agenda
                        <span class="badge badge-success"> 7 </span>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="page_user_lock_1.html">
                        <i class="fa fa-lock"></i> Bloquear Tela </a>
                </li>
                <li>
                    <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out"></i> Sair
                    </a>
                    <form id="logout-form"
                          action="{{ url('/logout') }}"
                          method="POST"
                          style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</div>
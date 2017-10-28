<div class="top-menu">
    <ul class="nav navbar-nav pull-right">
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
                    <a href="{{ url('profile') }}">
                        <i class="fa fa-user-o"></i> Meu perfil </a>
                </li>
                <li>
                    <a href="{{ url('/secretary/schedules/calendar') }}">
                        <i class="fa fa-calendar"></i> Calendário </a>
                </li>
                <li>
                    <a href="{{ url('/secretary/schedules') }}">
                        <i class="fa fa-address-book-o"></i> Compromissos
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sing-out"></i> Sair
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
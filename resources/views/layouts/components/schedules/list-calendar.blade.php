@extends('layouts.app')

@push('stylesheets')
<link href="{{ asset('assets/global/plugins/fullcalendar/fullcalendar.min.css') }}"
      rel='stylesheet'/>
<link href="{{ asset('assets/global/plugins/fullcalendar/fullcalendar.print.min.css') }}"
      rel='stylesheet'
      media='print'/>
<style>

    #calendar {
        max-width: 900px;
        margin: 0 auto;
        padding: 10px;
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
                        <span>Agenda</span>
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
                                <i class="fa fa-calendar"
                                   aria-hidden="true"></i>
                                <span class="caption-subject bold uppercase">
                                    Agenda</span>
                            </div>
                        </div>

                        <div class="portlet-body form">
                            <div class="x_panel"
                                 style="padding: 10px 15px;">
                                <div class="nav navbar-right panel_toolbox"
                                     style="margin-bottom: 5px; margin-right: 10px;">
                                    <a class="btn btn-success"
                                       href="{{ url('/manager/schedules/create/appointment') }}">
                                        <i class="fa fa-clock-o"
                                        ></i> Novo compromisso
                                    </a>
                                    <a class="btn btn-info"
                                       href="{{ url('/manager/schedules/create/scheduling') }}">
                                        <i class="fa fa-medkit"
                                        ></i> Nova consulta
                                    </a>
                                    <a class="btn btn-default"
                                       href="{{ url(App\Entities\User::getUserMiddleware().'/schedules') }}">
                                        <i class="fa fa-list"></i> Formato Tabela
                                    </a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="page-content-inner">
                                    <div id="schedule" style="margin: 20px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
@endsection

@push('scripts')
<script src="{{ asset('assets/global/plugins/fullcalendar/lib/moment.min.js') }}"
        type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/fullcalendar/fullcalendar.min.js') }}"
        type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/fullcalendar/locale/pt-br.js') }}"
        type="text/javascript"></script>
<script>
    $('#schedule').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'listWeek,agendaDay,agendaWeek,month',
        },
        navLinks: true,
        editable: false,
        eventLimit: true,
        defaultView: 'agendaWeek',
        refetchResourcesOnNavigate: true,
        events: function (start, end, timezone, callback) {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: '/{{ $extraData['middleware'] }}/schedules/calendar-ajax',
                type: 'POST',
                dataType: 'json',
                data: {
                    start: start.unix(),
                    end: end.unix(),
                },
                success: function (response) {
                    var events = [];
                    var color;
                    var finish_at;
                    var now = new Date();

                    $.each(response, function (index, value) {
                        finish_at = new Date(value.finish_at.split(' ')[0]);

                        if (finish_at < now) {
                            color = '#777777';
                        } else if (value.patient !== null) {
                            color = '#60C0DC';
                        } else {
                            color = '#31B89A';
                        }

                        events.push({
                            title: value.description,
                            start: value.start_at,
                            end: value.finish_at,
                            url: value.id,
                            color: color,
                        });
                    });

                    callback(events);
                },
            });
        },
    });
</script>
@endpush
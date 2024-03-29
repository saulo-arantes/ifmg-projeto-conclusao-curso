@extends('layouts.app')

@push('stylesheets')
    <link href="{{ asset('assets/global/plugins/fullcalendar/fullcalendar.min.css') }}"
          rel='stylesheet'/>

    <style>

        .button {
            width: 200px;
            padding: 5px;
            margin: 3px;
        }

        .fc-today {
            background: #eff9ff !important;
            border: none !important;
            border-top: 1px solid #ddd !important;
            font-weight: bold;
        }

        #schedule .fc-content {
            color: #FFF;
            font-family: "Lucida Grande", Helvetica, Arial, Verdana, sans-serif;
            font-size: 100%;
            font-weight: bold;
        }

        #schedule .fc-event {
            box-shadow: 2px 2px 2px #706868;
        }

        #schedule .fc-event:hover {
            font-weight: bolder;
            transform: scale(1.02);
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
                        <span>Agenda e Compromissos</span>
                        <i class="fa fa-circle"
                           aria-hidden="true"></i>
                    </li>
                    <li>
                        <span>Calendário</span>
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

                                <span class="caption-subject bold uppercase"><i class="fa fa-calendar"
                                                                                aria-hidden="true"></i>
                                    Calendário</span>
                            </div>
                        </div>

                        <div class="portlet-body">
                            <div class="panel_toolbox"
                                 style="float: right; margin-bottom: 20px;">
                                <a class="btn btn-success button"
                                   href="{{ url(App\Entities\User::getUserMiddleware().'/schedules/create/scheduling') }}">
                                    <i class="fa fa-clock-o"></i> Novo compromisso
                                </a>
                                <a class="btn btn-info button"
                                   href="{{ url(App\Entities\User::getUserMiddleware().'/schedules/create/appointment') }}">
                                    <i class="fa fa-medkit"></i> Nova consulta
                                </a>
                                <a class="btn btn-default button"
                                   href="{{ url(App\Entities\User::getUserMiddleware().'/schedules') }}">
                                    <i class="fa fa-table"></i> Formato Tabela
                                </a>
                            </div>
                            <div id="schedule"
                                 style="display: inline-block;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/global/plugins/moment.min.js') }}"></script>
    <script src="{{ asset('assets/global/plugins/fullcalendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('assets/global/plugins/fullcalendar/fullcalendar-pt-br.min.js') }}"></script>
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
            eventRender: function (event, element) {
                $(element).tooltip({title: event.title});
            },
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
                                color = '#659be0';
                            } else {
                                color = '#36c6d3';
                            }

                            if (value.patient !== null) {
                                events.push({
                                    title: value.description,
                                    start: value.start_at,
                                    end: value.finish_at,
                                    url: value.id + '/edit/appointment',
                                    color: color
                                });
                            } else {
                                events.push({
                                    title: value.description,
                                    start: value.start_at,
                                    end: value.finish_at,
                                    url: value.id + '/edit/scheduling',
                                    color: color
                                });
                            }
                        });

                        callback(events);
                    },
                });
            },
        });
    </script>
@endpush
@extends('layouts.app')

@push('stylesheets')
    <link rel="stylesheet"
          href="{{ asset('css/fullcalendar.min.css') }}" />
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Agenda</h2>&nbsp;&nbsp;
                    <div class="nav navbar-right panel_toolbox">
                        <a class="btn btn-success"
                           href="{{ url('/manager/schedules/create/appointment') }}">
                            <i class="fa fa-clock-o"></i> Novo compromisso
                        </a>
                        <a class="btn btn-info"
                           href="{{ url('/manager/schedules/create/scheduling') }}">
                            <i class="fa fa-medkit"></i> Nova consulta
                        </a>
                        <a class="btn btn-default"
                           href="{{ url('/manager/schedules') }}">
                            <i class="fa fa-list"></i> Formato Tabela
                        </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="page-content-inner">
                        <div id="schedule"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('js/fullcalendar-pt-br.min.js') }}"></script>
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
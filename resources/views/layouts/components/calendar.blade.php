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
                                <span class="caption-subject bold uppercase">
                                    <i class="fa fa-calendar"
                                       aria-hidden="true"></i>
                                    Calendário</span>
                            </div>
                        </div>
                        <div class="portlet-body form">

                            <div id='calendar'></div>

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

    $(document).ready(function () {

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay,list'
            },
            defaultDate: '2017-05-12',
            navLinks: true, // can click day/week names to navigate views
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: [
                {
                    title: 'All Day Event',
                    start: '2017-05-01'
                },
                {
                    title: 'Long Event',
                    start: '2017-05-07',
                    end: '2017-05-10'
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: '2017-05-09T16:00:00'
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: '2017-05-16T16:00:00'
                },
                {
                    title: 'Conference',
                    start: '2017-05-11',
                    end: '2017-05-13'
                },
                {
                    title: 'Meeting',
                    start: '2017-05-12T10:30:00',
                    end: '2017-05-12T12:30:00'
                },
                {
                    title: 'Lunch',
                    start: '2017-05-12T12:00:00'
                },
                {
                    title: 'Meeting',
                    start: '2017-05-12T14:30:00'
                },
                {
                    title: 'Happy Hour',
                    start: '2017-05-12T17:30:00'
                },
                {
                    title: 'Dinner',
                    start: '2017-05-12T20:00:00'
                },
                {
                    title: 'Birthday Party',
                    start: '2017-05-13T07:00:00'
                },
                {
                    title: 'Click for Google',
                    url: 'http://google.com/',
                    start: '2017-05-28'
                }
            ]
        });

    });

</script>
@endpush
@push('stylesheets')
    <link href="{{ asset('assets/global/plugins/daterangerpicker/daterangerpicker.min.css') }}"
          rel="stylesheet">
@endpush
<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
    <div class="form-group">
        <label class="control-label"
               for="date_input">Data</label>
        @include('layouts.components.asterisk')
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
            <input class="form-control"
                   placeholder="Data de nascimento"
                   id="date_input"
                   name="date_input"
                   title="Data"
                   data-error="Campo obrigatório."
                   data-minlength="10"
                   maxlength="10"
                   value=""
                   required>
        </div>
        <div class="help-block with-errors"></div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('assets/global/plugins/moment.min.js') }}"></script>
    <script src="{{ asset('assets/global/plugins/daterangerpicker/daterangerpicker.min.js') }}"></script>
    <script>
        $('#date_input').daterangepicker({
            'singleDatePicker': true,
            'showDropdowns': true,
            'locale': {
                'format': 'DD/MM/YYYY',
                'separator': ' - ',
                'daysOfWeek': [
                    'Do',
                    'Se',
                    'Te',
                    'Qu',
                    'Qu',
                    'Se',
                    'Sa',
                ],
                'monthNames': [
                    'Janeiro',
                    'Fevereiro',
                    'Março',
                    'Abril',
                    'Maio',
                    'Junho',
                    'Julho',
                    'Agosto',
                    'Setembro',
                    'Outubro',
                    'Novembro',
                    'Dezembro',
                ],
                'firstDay': 1,
            },
        }, function(start, end, label) {
            console.log(
                'New date range selected: \' + start.format(\'YYYY-MM-DD\') + \' to \' + end.format(\'YYYY-MM-DD\') + \' (predefined range: \' + label + \')');
        });
    </script>
@endpush
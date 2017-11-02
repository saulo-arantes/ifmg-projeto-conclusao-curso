@push('stylesheets')
    <link href="{{ asset('assets/global/plugins/daterangerpicker/daterangerpicker.min.css') }}"
          rel="stylesheet">
@endpush
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label class="control-label"
               for="birthday_date">Data de nascimento</label>
        @include('layouts.components.asterisk')
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-birthday-cake"
                   aria-hidden="true"></i>
            </span>
            <input type="text"
                   class="form-control"
                   placeholder="Data de nascimento"
                   id="birthday_date"
                   name="birthday_date"
                   title="Data de nascimento"
                   data-minlength="10"
                   maxlength="10"
                   data-error="Campo obrigatório. Escolha uma data de nascimento."
                   value="{{ old('birthday_date') ?? $data['birthday_date'] ?? null }}"
                   required>
        </div>
        <div class="help-block with-errors"></div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('assets/global/plugins/moment.min.js') }}"></script>
    <script src="{{ asset('assets/global/plugins/daterangerpicker/daterangerpicker.min.js') }}"></script>
    <script>
        $('#birthday_date').daterangepicker({
            "singleDatePicker": true,
            "showDropdowns": true,
            "locale": {
                "format": "DD/MM/YYYY",
                "separator": " - ",
                "daysOfWeek": [
                    "Do",
                    "Se",
                    "Te",
                    "Qu",
                    "Qu",
                    "Se",
                    "Sa"
                ],
                "monthNames": [
                    "Janeiro",
                    "Fevereiro",
                    "Março",
                    "Abril",
                    "Maio",
                    "Junho",
                    "Julho",
                    "Agosto",
                    "Setembro",
                    "Outubro",
                    "Novembro",
                    "Dezembro"
                ],
                "firstDay": 1
            }
        }, function (start, end, label) {
            console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
        });
    </script>
@endpush
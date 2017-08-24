<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label for="start_at">Fim</label>
        @include('layouts.components.asterisk')
        <div class="input-group select2-bootstrap-prepend">
            <span class="input-group-addon">
                <i class="fa fa-clock-o"
                   aria-hidden="true"></i>
                </span>
            <div class="input-group date form_datetime form_datetime bs-datetime">
                <input type="text"
                       name="start_at"
                       placeholder="Data e hora de término"
                       size="60"
                       class="form-control"
                       title="Defina a data e a hora do término da consulta."
                       value="{{ old('finish_at') ?? $data['finish_at'] ?? null }}"
                       required>
                <span class="input-group-addon">
                    <button class="btn default date-set"
                            type="button">
                        <i class="fa fa-calendar"></i>
                    </button>
                </span>
            </div>
        </div>
    </div>
</div>
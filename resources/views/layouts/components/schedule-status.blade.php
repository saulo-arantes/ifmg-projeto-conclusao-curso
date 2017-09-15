<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label class="control-label"
               for="name">Status da Consulta</label>
        @include('layouts.components.asterisk')
        <div class="input-group">
            <div class="md-radio-inline"
                 title="Selecione a atual situação desta consulta.">

                @if(!empty($data['status']))

                    <div class="md-radio">
                        <input type="radio"
                               id="created"
                               name="status"
                               class="md-radiobtn"
                               value="1" {{ $data['status'] == \App\Entities\Schedule::CREATED ? 'checked' : '' }} >
                        <label for="created">
                            <span class="inc"></span>
                            <span class="check"></span>
                            <span class="box"></span> Criado </label>
                    </div>
                    <div class="md-radio">
                        <input type="radio"
                               id="confirmed"
                               name="status"
                               class="md-radiobtn"
                               value="2" {{ $data['status'] == \App\Entities\Schedule::CONFIRMED ? 'checked' : '' }} >
                        <label for="confirmed">
                            <span class="inc"></span>
                            <span class="check"></span>
                            <span class="box"></span> Confirmado </label>
                    </div>
                    <div class="md-radio">
                        <input type="radio"
                               id="realized"
                               name="status"
                               class="md-radiobtn"
                               value="3" {{ $data['status'] == \App\Entities\Schedule::ACCOMPLISHED ? 'checked' : '' }} >
                        <label for="realized">
                            <span class="inc"></span>
                            <span class="check"></span>
                            <span class="box"></span> Realizado </label>
                    </div>
                    <div class="md-radio">
                        <input type="radio"
                               id="canceled"
                               name="status"
                               class="md-radiobtn"
                               value="4" {{ $data['status'] == \App\Entities\Schedule::CANCELED ? 'checked' : '' }} >
                        <label for="canceled">
                            <span class="inc"></span>
                            <span class="check"></span>
                            <span class="box"></span> Cancelado </label>
                    </div>

                @else

                    <div class="md-radio">
                        <input type="radio"
                               id="created"
                               name="status"
                               class="md-radiobtn"
                               value="1" {{ old('status') == \App\Entities\Schedule::CREATED ? 'checked' : '' }} >
                        <label for="created">
                            <span class="inc"></span>
                            <span class="check"></span>
                            <span class="box"></span> Criado </label>
                    </div>
                    <div class="md-radio">
                        <input type="radio"
                               id="confirmed"
                               name="status"
                               class="md-radiobtn"
                               value="2" {{ old('status') == \App\Entities\Schedule::CONFIRMED ? 'checked' : '' }} >
                        <label for="confirmed">
                            <span class="inc"></span>
                            <span class="check"></span>
                            <span class="box"></span> Confirmado </label>
                    </div>
                    <div class="md-radio">
                        <input type="radio"
                               id="realized"
                               name="status"
                               class="md-radiobtn"
                               value="3" {{ old('status') == \App\Entities\Schedule::ACCOMPLISHED ? 'checked' : '' }} >
                        <label for="realized">
                            <span class="inc"></span>
                            <span class="check"></span>
                            <span class="box"></span> Realizado </label>
                    </div>
                    <div class="md-radio">
                        <input type="radio"
                               id="canceled"
                               name="status"
                               class="md-radiobtn"
                               value="4" {{ old('status') == \App\Entities\Schedule::CANCELED ? 'checked' : '' }} >
                        <label for="canceled">
                            <span class="inc"></span>
                            <span class="check"></span>
                            <span class="box"></span> Cancelado </label>
                    </div>

                @endif

            </div>
        </div>
        <div class="help-block with-errors"></div>
    </div>
</div>
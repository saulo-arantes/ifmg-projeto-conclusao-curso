<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label for="city_id">Cidade</label>
        @include('layouts.components.asterisk')
        <select id="city_id"
                name="city_id"
                class="form-control select2"
                data-placeholder="Cidade"
                tabindex="-1"
                aria-hidden="true"
                title="Cidade onde mora"
                data-error="Campo obrigatório. Preencha o estado e depois a cidade."
                required>
            <option value="">Selecionar cidade (selecione o estado primeiro)</option>
            @if(!empty($extraData['cities']))
                @foreach ($extraData['cities'] as $city)
                    @if(!empty($data['id']) && $city->id == $data['id'])
                        <option value="{{ $city->id }}"
                                selected>{{ $city->name }}</option>
                    @else
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endif
                @endforeach
            @endif
        </select>
        <div class="help-block with-errors"></div>
    </div>
</div>
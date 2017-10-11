<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label for="naturalness_id">Cidade natal</label>
        @include('layouts.components.asterisk')
        <select id="naturalness_id"
                name="naturalness_id"
                class="form-control select2"
                data-placeholder="Naturalidade"
                aria-hidden="true"
                title="Cidade natal"
                data-error="Campo obrigatório. Preencha o estado e depois a cidade."
                required>
            <option value="">Selecionar cidade natal (selecione o estado primeiro)</option>
            @if(!empty($extraData['naturalness']))
                @foreach ($extraData['naturalness'] as $city)
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
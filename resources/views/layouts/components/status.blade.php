<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label class="control-label"
               for="name">Status de Usuário</label>
        @include('layouts.components.asterisk')
        <div class="input-group">
            <div class="md-radio-inline">

                @if(!empty($user['data']))

                    <div class="md-radio">
                        <input type="radio"
                               id="active"
                               name="status"
                               class="md-radiobtn"
                               value="1" {{ $data['status'] == 1 ? 'checked' : '' }} >
                        <label for="active">
                            <span class="inc"></span>
                            <span class="check"></span>
                            <span class="box"></span> Ativo </label>
                    </div>
                    <div class="md-radio">
                        <input type="radio"
                               id="inactive"
                               name="status"
                               class="md-radiobtn"
                               value="0" {{ $data['status'] == 0 ? 'checked' : '' }} >
                        <label for="inactive">
                            <span class="inc"></span>
                            <span class="check"></span>
                            <span class="box"></span> Inativo </label>
                    </div>

                @else

                    <div class="md-radio">
                        <input type="radio"
                               id="active"
                               name="status"
                               class="md-radiobtn"
                               value="1" {{ old('status') == 1 ? 'checked' : '' }} >
                        <label for="active">
                            <span class="inc"></span>
                            <span class="check"></span>
                            <span class="box"></span> Ativo </label>
                    </div>
                    <div class="md-radio">
                        <input type="radio"
                               id="inactive"
                               name="status"
                               class="md-radiobtn"
                               value="0" {{ old('status') == 0 ? 'checked' : '' }} >
                        <label for="inactive">
                            <span class="inc"></span>
                            <span class="check"></span>
                            <span class="box"></span> Inativo </label>
                    </div>

                @endif

            </div>
        </div>
        <div class="help-block with-errors"></div>
    </div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label class="control-label"
               for="name">Tipo de Parto</label>
        <div class="input-group">
            <div class="md-radio-inline">

                @if(!empty($data['birth_type']))

                    <div class="md-radio">
                        <input type="radio"
                               id="normal"
                               name="birth_type"
                               class="md-radiobtn"
                               value="0" {{ $data['birth_type'] == 0 ? 'checked' : '' }} >
                        <label for="normal">
                            <span class="inc"></span>
                            <span class="check"></span>
                            <span class="box"></span> Normal </label>
                    </div>
                    <div class="md-radio">
                        <input type="radio"
                               id="cesaria"
                               name="birth_type"
                               class="md-radiobtn"
                               value="1" {{ $data['birth_type'] == 1 ? 'checked' : '' }} >
                        <label for="cesaria">
                            <span class="inc"></span>
                            <span class="check"></span>
                            <span class="box"></span> Cesária </label>
                    </div>

                @else

                    <div class="md-radio">
                        <input type="radio"
                               id="normal"
                               name="birth_type"
                               class="md-radiobtn"
                               value="0" {{ old('birth_type') == 0 ? 'checked' : '' }} >
                        <label for="normal">
                            <span class="inc"></span>
                            <span class="check"></span>
                            <span class="box"></span> Normal </label>
                    </div>
                    <div class="md-radio">
                        <input type="radio"
                               id="cesaria"
                               name="birth_type"
                               class="md-radiobtn"
                               value="1" {{ old('birth_type') == 1 ? 'checked' : '' }} >
                        <label for="cesaria">
                            <span class="inc"></span>
                            <span class="check"></span>
                            <span class="box"></span> Cesária </label>
                    </div>

                @endif

            </div>
        </div>
        <div class="help-block with-errors"></div>
    </div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label class="control-label"
               for="name">Alergico(a)</label>
        @include('layouts.components.asterisk')
        <div class="input-group">
            <div class="md-radio-inline">

                @if(!empty($data['allergic']))

                    <div class="md-radio">
                        <input type="radio" id="positive" name="allergic"
                               class="md-radiobtn" {{ $data['allergic'] === 0 ? 'checked' : '' }} >
                        <label for="positive">
                            <span class="inc"></span>
                            <span class="check"></span>
                            <span class="box"></span> Sim </label>
                    </div>
                    <div class="md-radio">
                        <input type="radio" id="negative" name="allergic"
                               class="md-radiobtn" {{ $data['allergic'] === 1 ? 'checked' : '' }} >
                        <label for="negative">
                            <span class="inc"></span>
                            <span class="check"></span>
                            <span class="box"></span> Não </label>
                    </div>

                @else

                    <div class="md-radio">
                        <input type="radio" id="positive" name="allergic"
                               class="md-radiobtn" {{ old('allergic') === 0 ? 'checked' : '' }} >
                        <label for="positive">
                            <span class="inc"></span>
                            <span class="check"></span>
                            <span class="box"></span> Sim </label>
                    </div>
                    <div class="md-radio">
                        <input type="radio" id="negative" name="allergic"
                               class="md-radiobtn" {{ old('allergic') === 1 ? 'checked' : '' }} >
                        <label for="negative">
                            <span class="inc"></span>
                            <span class="check"></span>
                            <span class="box"></span> Não </label>
                    </div>

                @endif

            </div>
        </div>
        <div class="help-block with-errors"></div>
    </div>
</div>
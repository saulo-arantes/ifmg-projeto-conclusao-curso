<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label class="control-label"
               for="name">Sexo</label>
        @include('layouts.components.asterisk')
        <div class="input-group">
            <div class="md-radio-inline">

                @if(!empty($data['sex']))

                    <div class="md-radio">
                        <input type="radio" id="male" name="sex"
                               class="md-radiobtn" {{ $data['sex'] == 0 ? 'checked' : '' }} >
                        <label for="male">
                            <span class="inc"></span>
                            <span class="check"></span>
                            <span class="box"></span> Masculino </label>
                    </div>
                    <div class="md-radio">
                        <input type="radio" id="female" name="sex"
                               class="md-radiobtn" {{ $data['sex'] == 1 ? 'checked' : '' }} >
                        <label for="female">
                            <span class="inc"></span>
                            <span class="check"></span>
                            <span class="box"></span> Feminino </label>
                    </div>

                @else

                    <div class="md-radio">
                        <input type="radio" id="male" name="sex"
                               class="md-radiobtn" {{ old('sex') == 0 ? 'checked' : '' }} >
                        <label for="male">
                            <span class="inc"></span>
                            <span class="check"></span>
                            <span class="box"></span> Masculino </label>
                    </div>
                    <div class="md-radio">
                        <input type="radio" id="female" name="sex"
                               class="md-radiobtn" {{ old('sex') == 1 ? 'checked' : '' }} >
                        <label for="female">
                            <span class="inc"></span>
                            <span class="check"></span>
                            <span class="box"></span> Feminino </label>
                    </div>

                @endif

            </div>
        </div>
        <div class="help-block with-errors"></div>
    </div>
</div>
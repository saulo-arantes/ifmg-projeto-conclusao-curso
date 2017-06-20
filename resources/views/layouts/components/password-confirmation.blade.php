<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label class="control-label"
               for="password_confirmation">Confirmar nova senha</label>
        @include('layouts.components.asterisk')
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-lock"
                   aria-hidden="true"></i>
            </span>
            <input type="password"
                   class="form-control"
                   placeholder="Confirmar nova senha"
                   id="password_confirmation"
                   name="password_confirmation"
                   title="Confirmar nova senha"
                   data-minlength="8"
                   maxlength="32"
                   data-error="Campo obrigatório. Confirme sua nova senha."
                   required>
        </div>
        <div class="help-block with-errors"></div>
    </div>
</div>
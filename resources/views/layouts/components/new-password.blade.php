<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label class="control-label"
               for="password">Nova senha</label>
        @include('layouts.components.asterisk')
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-unlock-alt"
                   aria-hidden="true"></i>
            </span>
            <input type="password"
                   class="form-control"
                   placeholder="Nova senha"
                   id="password"
                   name="password"
                   title="Nova senha"
                   data-minlength="8"
                   maxlength="32"
                   data-error="Campo obrigatório. Digite sua nova senha."
                   required>
        </div>
        <div class="help-block with-errors"></div>
    </div>
</div>
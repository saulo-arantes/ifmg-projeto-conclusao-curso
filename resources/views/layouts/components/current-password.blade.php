<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label class="control-label"
               for="current_password">Senha atual</label>
        @include('layouts.components.asterisk')
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-unlock"
                   aria-hidden="true"></i>
            </span>
            <input type="password"
                   class="form-control"
                   placeholder="Senha atual"
                   id="current_password"
                   name="current_password"
                   title="Senha atual"
                   data-minlength="8"
                   maxlength="32"
                   required>
        </div>
        <div class="help-block with-errors"></div>
    </div>
</div>
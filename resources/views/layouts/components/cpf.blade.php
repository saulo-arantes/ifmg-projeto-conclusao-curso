<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label class="control-label"
               for="name">CPF</label>
        @include('layouts.components.asterisk')
        <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-id-card"
                       aria-hidden="true"></i>
                </span>
            <input type="text"
                   class="form-control"
                   placeholder="CPF"
                   id="cpf"
                   name="cpf"
                   title="cpf"
                   maxlength="255"
                   data-error="Campo obrigatório. Digite um CPF válido."
                   value="{{ old('cpf') ?? $data['cpf'] ?? null }}"
                   required>
        </div>
        <div class="help-block with-errors"></div>
    </div>
</div>
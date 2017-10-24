<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label class="control-label"
               for="name">RG</label>
        @include('layouts.components.asterisk')
        <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-id-card"
                       aria-hidden="true"></i>
                </span>
            <input type="text"
                   class="form-control"
                   placeholder="RG"
                   id="rg"
                   name="rg"
                   title="RG"
                   maxlength="10"
                   data-error="Campo obrigatório. Digite um RG válido."
                   value="{{ old('rg') ?? $data['rg'] ?? null }}"
                   required>
        </div>
        <div class="help-block with-errors"></div>
    </div>
</div>
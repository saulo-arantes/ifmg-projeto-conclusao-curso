<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label class="control-label"
               for="name">Bairro</label>
        @include('layouts.components.asterisk')
        <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-building"
                       aria-hidden="true"></i>
                </span>
            <input type="text"
                   class="form-control"
                   placeholder="Bairro"
                   id="neighborhood"
                   name="neighborhood"
                   title="Neighborhood"
                   maxlength="255"
                   value="{{ old('neighborhood') ?? $data['data']['neighborhood'] ?? $data['data']['user']['data']['neighborhood'] ?? null }}"
                   required>
        </div>
        <div class="help-block with-errors"></div>
    </div>
</div>
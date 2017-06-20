<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label class="control-label"
               for="name">Complemento</label>
        @include('layouts.components.asterisk')
        <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-pencil-square-o"
                       aria-hidden="true"></i>
                </span>
            <input type="text"
                   class="form-control"
                   placeholder="Complemento"
                   id="complement"
                   name="complement"
                   title="Complement"
                   maxlength="255"
                   value="{{ old('complement') ?? $data['data']['complement'] ?? $data['data']['user']['data']['complement'] ?? null }}"
                   required>
        </div>
        <div class="help-block with-errors"></div>
    </div>
</div>
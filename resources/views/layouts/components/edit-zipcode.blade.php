<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label class="control-label"
               for="name">CEP</label>
        @include('layouts.components.asterisk')
        <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-pencil-square-o"
                       aria-hidden="true"></i>
                </span>
            <input type="text"
                   class="form-control"
                   placeholder="CEP"
                   id="zipcode"
                   name="zipcode"
                   title="Zipcode"
                   maxlength="255"
                   value="{{ old('zipcode') ?? $data['data']['zipcode'] ?? $data['data']['user']['data']['zipcode'] ?? null }}"
                   pattern="[0-9]{9}"
                   required>
        </div>
        <div class="help-block with-errors"></div>
    </div>
</div>
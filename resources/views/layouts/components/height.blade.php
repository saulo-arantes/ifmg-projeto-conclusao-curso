<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label class="control-label"
               for="name">Altura</label>
        <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-arrows-v"
                       aria-hidden="true"></i>
                </span>
            <input type="text"
                   class="form-control"
                   placeholder="Altura"
                   id="height"
                   name="height"
                   title="Altura"
                   maxlength="10"
                   value="{{ old('height') ?? $data['height'] ?? null }}">
        </div>
        <div class="help-block with-errors"></div>
    </div>
</div>
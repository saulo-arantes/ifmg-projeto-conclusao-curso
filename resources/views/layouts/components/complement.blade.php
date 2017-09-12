<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label class="control-label"
               for="name">Complemento</label>
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
                   title="Complemento"
                   maxlength="255"
                   value="{{ old('complement') ?? $data['complement'] ?? null }}">
        </div>
        <div class="help-block with-errors"></div>
    </div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label class="control-label"
               for="name">Peso</label>
        <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-arrows-h"
                       aria-hidden="true"></i>
                </span>
            <input type="text"
                   class="form-control"
                   placeholder="Peso"
                   id="weight"
                   name="weight"
                   title="Peso"
                   maxlength="10"
                   value="{{ old('weight') ?? $data['weight'] ?? null }}">
        </div>
        <div class="help-block with-errors"></div>
    </div>
</div>
<div class="col-xs-12">
    <div class="form-group">
        <label class="control-label"
               for="name">Descrição</label>
        <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-edit"
                       aria-hidden="true"></i>
                </span>
            <textarea class="form-control"
                      placeholder="Descrição"
                      id="description"
                      name="description"
                      title="Descrição"
                      value="{{ old('observation') ?? $data['observation'] ?? null }}"></textarea>
        </div>
        <div class="help-block with-errors"></div>
    </div>
</div>
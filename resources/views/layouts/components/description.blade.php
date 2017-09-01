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
                      onkeyup="adjustHeight(this)"
                      title="Descrição">{{ old('description') ?? $data['description'] ?? null }}</textarea>
        </div>
        <div class="help-block with-errors"></div>
    </div>
</div>

@push('scripts')
    <script>
        function adjustHeight(el){
            el.style.height = (el.scrollHeight > el.clientHeight) ? (el.scrollHeight)+"px" : "60px";
        }
    </script>
@endpush
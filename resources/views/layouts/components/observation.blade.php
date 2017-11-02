<div class="col-xs-12">
    <div class="form-group">
        <label class="control-label"
               for="name">Observações</label>
        <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-eye"
                       aria-hidden="true"></i>
                </span>
            <textarea class="form-control"
                      placeholder="Observações"
                      id="observation"
                      name="observation"
                      onkeyup="adjustHeight(this)"
                      style="resize: none;"
                      title="Observações"> {{ old('observation') ?? $data['observation'] ?? null }} </textarea>
        </div>
        <div class="help-block with-errors"></div>
    </div>
</div>
@push('scripts')
    <script>
        function adjustHeight(el) {
            el.style.height = (el.scrollHeight > el.clientHeight) ? (el.scrollHeight) + "px" : "60px";
        }
    </script>
@endpush
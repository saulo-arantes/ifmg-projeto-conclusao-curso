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
                   title="CEP"
                   maxlength="9"
                   minlength="9"
                   data-error="Campo obrigatório. Digite o CEP de seu endereço."
                   value="{{ old('zipcode') ?? $data['zipcode'] ?? null }}"
                   required>
        </div>
        <div class="help-block with-errors"></div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function () { 
        var $seuCampoZIP = $("#zipcode");
        $seuCampoZIP.mask('00000-000', {reverse: true});
    });
    </script>
@endpush
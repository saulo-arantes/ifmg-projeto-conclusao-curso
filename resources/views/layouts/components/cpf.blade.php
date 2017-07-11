<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label class="control-label"
               for="name">CPF</label>
        @include('layouts.components.asterisk')
        <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-pencil-square-o"
                       aria-hidden="true"></i>
                </span>
            <input type="text"
                   class="form-control"
                   placeholder="CPF"
                   id="cpf"
                   name="cpf"
                   title="cpf"
                   maxlength="255"
                   value="{{ old('cpf') ?? $data['cpf'] ?? null }}"
                   required>
        </div>
        <div class="help-block with-errors"></div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('assets/global/scripts/jquery-1.2.6.pack.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#cpf").mask("999.999.999-99");
    });
</script>
<script src="{{ asset('assets/global/scripts/jquery.maskedinput-1.1.4.pack.js') }}" type="text/javascript"></script>
@endpush
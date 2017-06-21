<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label class="control-label"
               for="name">Data de Nascimento</label>
        @include('layouts.components.asterisk')
        <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-pencil-square-o"
                       aria-hidden="true"></i>
                </span>
            <input type="text"
                   class="form-control"
                   placeholder="Data de Aniverssário"
                   id="birthday-date"
                   name="birthday-date"
                   title="BirthdayDate"
                   maxlength="255"
                   value="{{ old('zipcode') ?? $data['data']['zipcode'] ?? $data['data']['user']['data']['zipcode'] ?? null }}"
                   required>
        </div>
        <div class="help-block with-errors"></div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('assets/global/scripts/jquery-1.2.6.pack.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#birthday-date").mask("99/99/9999");
    });
</script>
<script src="{{ asset('assets/global/scripts/jquery.maskedinput-1.1.4.pack.js') }}" type="text/javascript"></script>
@endpush
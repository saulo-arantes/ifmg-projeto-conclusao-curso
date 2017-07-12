<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label class="control-label"
               for="name">Data de Nascimento</label>
        @include('layouts.components.asterisk')
        <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-calendar"
                       aria-hidden="true"></i>
                </span>
            <input type="text"
                   class="form-control"
                   placeholder="Data de Nascimento"
                   id="birthday-date"
                   name="birthday-date"
                   title="Data de Nascimento"
                   maxlength="255"
                   value="{{ old('birthday_date') ?? $data['birthday_date'] ?? null }}"
                   required>
        </div>
        <div class="help-block with-errors"></div>
    </div>
</div>

@push('scripts')

<script src="{{ asset('assets/global/scripts/jquery-1.2.6.pack.js') }}" type="text/javascript"></script>

@endpush
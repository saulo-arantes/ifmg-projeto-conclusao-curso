<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label class="control-label"
               for="name">Estado Civil</label>
        <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-users"
                       aria-hidden="true"></i>
                </span>
            <select class="form-control" id="marital_status" name="marital_status" title="Estado Civil">
                <option value="">Selecione o estado civil</option>
                @if(!empty($data['marital_status']))
                    <option value="0" {{ $data['marital_status'] == 0 ? 'selected' : '' }}>Solteiro</option>
                    <option value="1" {{ $data['marital_status'] == 1 ? 'selected' : '' }}>Casado</option>
                    <option value="2" {{ $data['marital_status'] == 2 ? 'selected' : '' }}>Divorciado</option>
                    <option value="3" {{ $data['marital_status'] == 3 ? 'selected' : '' }}>Viúvo</option>
                    <option value="4" {{ $data['marital_status'] == 4 ? 'selected' : '' }}>Separado</option>
                @else
                    <option value="0" {{ old('marital_status') == 0 ? 'selected' : '' }}>Solteiro</option>
                    <option value="1" {{ old('marital_status') == 1 ? 'selected' : '' }}>Casado</option>
                    <option value="2" {{ old('marital_status') == 2 ? 'selected' : '' }}>Divorciado</option>
                    <option value="3" {{ old('marital_status') == 3 ? 'selected' : '' }}>Viúvo</option>
                    <option value="4" {{ old('marital_status') == 4 ? 'selected' : '' }}>Separado</option>
                @endif
            </select>
        </div>
        <div class="help-block with-errors"></div>
    </div>
</div>

@push('scripts')

<script src="{{ asset('assets/global/scripts/jquery-1.2.6.pack.js') }}" type="text/javascript"></script>

@endpush
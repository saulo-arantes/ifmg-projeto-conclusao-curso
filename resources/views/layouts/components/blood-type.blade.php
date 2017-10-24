<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label class="control-label"
               for="name">Tipo Sanguíneo</label>
        <div class="input-group select2-bootstrap-prepend">
            <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-tint"
                           aria-hidden="true"></i>
                    </span>
                <select class="form-control select2"
                        id="blood_type"
                        name="blood_type"
                        data-placeholder="Tipo Sanguíneo"
                        title="Tipo Sanguíneo">
                    <option value="">Selecione o tipo sanguíneo</option>
                    @if(!empty($data['blood_type']))
                        <option value="A+" {{ $data['blood_type'] == 'A+' ? 'selected' : '' }} >A+</option>
                        <option value="A-" {{ $data['blood_type'] == 'A-' ? 'selected' : '' }} >A-</option>
                        <option value="B+" {{ $data['blood_type'] == 'B+' ? 'selected' : '' }} >B+</option>
                        <option value="B-" {{ $data['blood_type'] == 'B-' ? 'selected' : '' }} >B-</option>
                        <option value="AB+" {{ $data['blood_type'] == 'AB+' ? 'selected' : '' }} >AB+</option>
                        <option value="AB-" {{ $data['blood_type'] == 'AB-' ? 'selected' : '' }} >AB-</option>
                        <option value="O+" {{ $data['blood_type'] == 'O+' ? 'selected' : '' }} >O+</option>
                        <option value="O-" {{ $data['blood_type'] == 'O-' ? 'selected' : '' }} >O-</option>
                    @else
                        <option value="A+" {{ old('blood_type') == 'A+' ? 'selected' : '' }} >A+</option>
                        <option value="A-" {{ old('blood_type') == 'A-' ? 'selected' : '' }} >A-</option>
                        <option value="B+" {{ old('blood_type') == 'B+' ? 'selected' : '' }} >B+</option>
                        <option value="B-" {{ old('blood_type') == 'B-' ? 'selected' : '' }} >B-</option>
                        <option value="AB+" {{ old('blood_type') == 'AB+' ? 'selected' : '' }}>AB+</option>
                        <option value="AB-" {{ old('blood_type') == 'AB-' ? 'selected' : '' }}>AB-</option>
                        <option value="O+" {{ old('blood_type') == 'O+' ? 'selected' : '' }} >O+</option>
                        <option value="O-" {{ old('blood_type') == 'O-' ? 'selected' : '' }} >O-</option>
                    @endif
                </select>
            </div>
        </div>
        <div class="help-block with-errors"></div>
    </div>
</div>
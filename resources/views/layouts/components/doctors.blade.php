<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label for="city_id">Associar a médicos</label>
        @include('layouts.components.asterisk')
        <div class="input-group select2-bootstrap-prepend">
            <span class="input-group-addon">
                <i class="fa fa-user-md"
                   aria-hidden="true"></i>
            </span>
            <select id="doctors"
                    name="doctors[]"
                    class="form-control select2"
                    data-placeholder="Médicos"
                    multiple
                    required
                    title="Associe médicos a esse paciente">
                <option value="">Selecionar</option>

                @if(!empty($extraData['doctors']))
                    @if(!empty($extraData['doctor_patient']))
                        @foreach ($extraData['doctors'] as $doctor)
                            <option value="{{ $doctor->id }}"
                                    {{ in_array($doctor->id, $extraData['doctor_patient']) ? 'selected' : '' }}>{{ $doctor->user->name }}</option>
                        @endforeach
                    @else
                        @foreach ($extraData['doctors'] as $doctor)
                            <option value="{{ $doctor->id }}"> {{ $doctor->user->name }} </option>
                        @endforeach
                    @endif
                @endif
            </select>
        </div>
    </div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label for="city_id">Selecione um paciente</label>
        @include('layouts.components.asterisk')
        <div class="input-group select2-bootstrap-prepend">
            <span class="input-group-addon">
                <i class="fa fa-wheelchair"
                   aria-hidden="true"></i>
            </span>
            <select id="patient_id"
                    name="patient_id"
                    required
                    class="form-control select2"
                    title="Selecione um paciente para a consulta">
                <option value="">Selecionar</option>
                @if(!empty($extraData['patients']))
                    @foreach ($extraData['patients'] as $patient)
                        @if(!empty($data))
                            <option value="{{ $data['patient_id'] }}" {{ $patient->id == $data['patient_id'] ? 'selected' : '' }}> {{ $patient->name }}</option>
                        @else
                            <option value="{{ $patient->id }}"> {{ $patient->name }} </option>
                        @endif
                    @endforeach
                @endif
            </select>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $("#patient_id").attr("data-placeholder", "Paciente");
        $("#patient_id").select2();
    </script>
@endpush
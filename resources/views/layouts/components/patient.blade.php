<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label for="city_id">Selecione um paciente</label>
        @include('layouts.components.asterisk')
        <div class="input-group select2-bootstrap-prepend">
            <span class="input-group-addon">
                <i class="fa fa-wheelchair"
                   aria-hidden="true"></i>
            </span>
            <select id="patient"
                    name="patient"
                    required
                    class="form-control select2"
                    title="Selecione um paciente para a consulta">
                <option value="">Selecionar</option>
                        @foreach ($extraData['patients'] as $patient)
                            <option value="{{ $patient->id }}"> {{ $patient->name }} </option>
                        @endforeach
            </select>
        </div>
    </div>
</div>
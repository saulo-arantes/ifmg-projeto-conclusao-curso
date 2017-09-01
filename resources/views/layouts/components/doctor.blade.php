<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label for="city_id">Médico</label>
        @include('layouts.components.asterisk')
        <div class="input-group select2-bootstrap-prepend">
            <span class="input-group-addon">
                <i class="fa fa-user-md"
                   aria-hidden="true"></i>
            </span>
            <select id="doctor"
                    name="doctor"
                    class="form-control select2"
                    required
                    title="Selecione um médico para realizar a consuta.">
                <option value="">Selecionar</option>
                @if (!$extraData['doctors'])
                    @foreach ($extraData['doctors'] as $doctor)
                        @if (!$extraData['schedules_doctors'])
                            @foreach($extraData['schedules_doctors'] as $d)
                                <option value="{{ $d }}"
                                        {{ $d == $doctor->id ? 'selected' : '' }}>{{ $doctor->user->name }}
                                </option>
                            @endforeach
                        @else
                            <option value="{{ $doctor->id }}"> {{ $doctor->user->name }} </option>
                        @endif
                        @endforeach
                @endif
            </select>
        </div>
    </div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label for="state">Estado</label>
        @include('layouts.components.asterisk')
        <select id="state"
                name="state"
                class="form-control select2"
                tabindex="-1"
                aria-hidden="true"
                title="Estado de nascimento"
                data-error="Campo obrigatório. Preencha o estado e depois a cidade."
                @if(!empty($city))
                onchange="selectCitiesOfState(this.value, true)"
                @else
                onchange="selectCitiesOfState(this.value, false)"
                @endif
                required>
            <option value="">Selecionar</option>
            @foreach ($extraData['states'] as $state)
                @if (!empty
                ($data['id']))
                    @if ($state->id == $data['state']['id'])
                        <option value="{{ $state->id }}"
                                selected>{{
                        $state->name }}
                            - {{ $state->initials }}</option>
                    @else
                        <option value="{{ $state->id }}">{{ $state->name }}
                            - {{ $state->initials }}</option>
                    @endif
                @else
                    <option value="{{ $state->id }}" {{ $state->id == old('state') ? 'selected' : '' }}>{{ $state->name }}
                        - {{ $state->initials }}</option>
                @endif
            @endforeach
        </select>
        <div class="help-block with-errors"></div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">

    /** * Ajax function to get cities that corresponds to a state id, for naturalness
     */
    function selectCitiesOfState(stateID, isCity) {

        var baseurl = window.location.protocol + "//" + window.location.host + "/";
        var city;

        if (isCity) {
            city = $('#city_id');
        } else {
            city = $('#naturalness_id');
        }

        swal({
            title: 'Atualizando',
            text: 'Aguarde...',
            imageUrl: '/img/loading.svg',
            cancelButtonText: 'Cancelar',
            showCancelButton: true,
            showConfirmButton: false
        });

        $.ajax({
            type: 'POST',
            url: baseurl + 'get-cities/' + stateID,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: 'stateID=' + stateID,
            cache: false,
            error: function (response) {
                alert(response.responseText);
                swal('Oops :(', 'Houve um erro com a requisição, tente novamente.', 'error');
            },
            success: function (html) {
                swal.close();
                city.empty();
                city.append(html);
            }
        });
    }

</script>
@endpush
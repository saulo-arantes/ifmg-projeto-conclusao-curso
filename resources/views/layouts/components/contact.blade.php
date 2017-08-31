<div id="nextContact">
    @if(!empty($contacts))
        @foreach($contacts as $contact)
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="control-label">Tipo de contato</label>
                        @include('layouts.components.asterisk')
                        <div class="input-group"
                             style="width: 100%">
                            <select name="contact_type_id[]"
                                    class="form-control"
                                    required
                                    data-error="Campo obrigatório. Preencha um contato seu ou de um responsável."
                                    title="Preencha o tipo de contato">
                                <option value="">Selecione o tipo de contato</option>
                                @foreach ($extraData['contact_types'] as $c)
                                    <option value="{{ $c->id }}"
                                            {{ $c->id == $contact['contact_type_id'] ? 'selected' : '' }}>{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="control-label">Descrição</label>
                        @include('layouts.components.asterisk')
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-address-card"
                                   aria-hidden="true"></i>
                            </span>
                            <input type="text"
                                   class="form-control"
                                   placeholder="Ex: (DDD) 9 9999-9999 (Operadora)"
                                   name="description[]"
                                   value="{{ old('description.') ?? $contact['description'] ?? null }}"
                                   title="Preencha a descrição do contato"
                                   data-error="Campo obrigatório. Preencha um contato seu ou de um responsável."
                                   required>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="contact_type_id"
                           class="control-label">Tipo de contato</label>
                    @include('layouts.components.asterisk')
                    <div class="input-group"
                         style="width: 100%">
                        <select name="contact_type_id[]"
                                class="form-control"
                                required
                                data-error="Campo obrigatório. Preencha um contato seu ou de um responsável."
                                title="Preencha o tipo de contato">
                            <option value="">Selecione o tipo de contato</option>
                            @foreach ($extraData['contact_types'] as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class="control-label">Descrição</label>
                    @include('layouts.components.asterisk')
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-address-card"
                               aria-hidden="true"></i>
                        </span>
                        <input type="text"
                               class="form-control"
                               placeholder="Ex: (DDD) 9 9999-9999 (Operadora)"
                               name="description[]"
                               data-error="Campo obrigatório. Preencha um contato seu ou de um responsável."
                               title="Preencha a descrição do contato"
                               value="{{ old('description.') ?? $contact['description'] ?? null }}"
                               required>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
    @endif
</div>
<a class="btn btn-success"
   id="newContact">Adicionar <i class="fa fa-plus"
                                aria-hidden="true"></i></a>
&nbsp;
<a class="btn btn-danger"
   id="removeContact">Remover <i class="fa fa-remove"
                                 aria-hidden="true"></i></a>

@push('scripts')

<script>

    jQuery(document).ready(function () {

        $('#newContact').click(function () {
            try {
                $('.contactType').select2('destroy');
            } catch (e) {

            }

            $('#nextContact .row:last-child').clone().appendTo('#nextContact');
        });

        $('#removeContact').click(function () {
            const n = $('#nextContact .row').length;

            if (n >= 2) {
                $('#nextContact .row:last-child').remove();
            }
        });
    });

</script>

@endpush
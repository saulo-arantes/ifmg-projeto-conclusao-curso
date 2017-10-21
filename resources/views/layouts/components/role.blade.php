<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label class="control-label"
               for="name"> Nível </label>
        @include('layouts.components.asterisk')
        <div class="input-group">
            <div class="md-radio-inline">

                @if(!empty($data['role']))

                    <div class="md-radio">
                        <input type="radio"
                               id="admin"
                               name="role"
                               class="md-radiobtn"
                               value="admin"
                               {{ $data['role'] == \App\Entities\User::ADMIN ? 'checked' : '' }}
                               required>
                        <label for="admin">
                            <span class="inc"></span>
                            <span class="check"></span>
                            <span class="box"></span> Administrador </label>
                    </div>
                    <div class="md-radio">
                        <input type="radio"
                               id="doctor"
                               name="role"
                               class="md-radiobtn"
                               value="doctor" {{ $data['role'] == \App\Entities\User::DOCTOR ? 'checked' : '' }} >
                        <label for="doctor">
                            <span class="inc"></span>
                            <span class="check"></span>
                            <span class="box"></span> Médico </label>
                    </div>
                    <div class="md-radio">
                        <input type="radio"
                               id="secretary"
                               name="role"
                               class="md-radiobtn"
                               value="secretary" {{ $data['role'] == \App\Entities\User::SECRETARY ? 'checked' : '' }} >
                        <label for="secretary">
                            <span class="inc"></span>
                            <span class="check"></span>
                            <span class="box"></span> Secretário </label>
                    </div>

                @else

                    <div class="md-radio">
                        <input type="radio"
                               id="admin"
                               name="role"
                               class="md-radiobtn"
                               value="admin"
                               {{ old('role') == \App\Entities\User::ADMIN  ? 'checked' : '' }}
                               required>
                        <label for="admin">
                            <span class="inc"></span>
                            <span class="check"></span>
                            <span class="box"></span> Administrador </label>
                    </div>
                    <div class="md-radio">
                        <input type="radio"
                               id="doctor"
                               name="role"
                               class="md-radiobtn"
                               value="doctor" {{ old('role') == \App\Entities\User::DOCTOR ? 'checked' : '' }} >
                        <label for="doctor">
                            <span class="inc"></span>
                            <span class="check"></span>
                            <span class="box"></span> Médico </label>
                    </div>
                    <div class="md-radio">
                        <input type="radio"
                               id="secretary"
                               name="role"
                               class="md-radiobtn"
                               value="secretary" {{ old('role') == \App\Entities\User::SECRETARY ? 'checked' : '' }} >
                        <label for="secretary">
                            <span class="inc"></span>
                            <span class="check"></span>
                            <span class="box"></span> Secretário </label>
                    </div>

                @endif

            </div>
        </div>
        <div class="help-block with-errors"></div>
    </div>
</div>
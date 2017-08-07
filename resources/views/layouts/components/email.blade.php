<?php
/**
 * Created by PhpStorm.
 * User: saulo
 * Date: 07/06/17
 * Time: 09:24
 */
?>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label class="control-label"
               for="email">E-mail</label>
        @include('layouts.components.asterisk')
        <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-envelope"
                       aria-hidden="true"></i>
                </span>
            <input type="email"
                   class="form-control"
                   placeholder="E-mail"
                   id="email"
                   name="email"
                   title="E-mail"
                   maxlength="255"
                   value="{{ old('email') ?? $data['email'] ?? null }}"
                   required>
        </div>
        <div class="help-block with-errors"></div>
    </div>
</div>

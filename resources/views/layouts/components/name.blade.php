<?php
/**
 * Created by PhpStorm.
 * User: saulo
 * Date: 07/06/17
 * Time: 09:32
 */
?>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label class="control-label"
               for="name">Nome</label>
        @include('layouts.components.asterisk')
        <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-user"
                       aria-hidden="true"></i>
                </span>
            <input type="text"
                   class="form-control"
                   placeholder="Nome"
                   id="name"
                   name="name"
                   title="Name"
                   maxlength="255"
                   value="{{ old('name') ?? $data['name'] ?? null }}"
                   required>
        </div>
        <div class="help-block with-errors"></div>
    </div>
</div>

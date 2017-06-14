<?php
/**
 * Created by PhpStorm.
 * User: saulo
 * Date: 07/06/17
 * Time: 09:42
 */

/*
    var password = document.getElementById("password"), confirm_password = document.getElementById("confirm_password");
    function validatePassword(){
      if(password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Passwords Don't Match");
      } else {
        confirm_password.setCustomValidity('');
      }
    }
    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
*/
?>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label class="control-label"
               for="password">Password</label>
        @include('layouts.components.asterisk')
        <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-lock"
                       aria-hidden="true"></i>
                </span>
            <input type="password"
                   class="form-control"
                   placeholder="Password"
                   id="password"
                   name="password"
                   title="Password"
                   maxlength="255"
                   value=""
                   required>
            <input type="password"
                   class="form-control"
                   placeholder="Confirm Password"
                   id="confirmPassword"
                   name="confirmPassword"
                   title="Confirm Password"
                   maxlength="255"
                   value=""
                   required>
        </div>
        <div class="help-block with-errors"></div>
    </div>
</div>



<?php
/**
 * Created by PhpStorm.
 * User: flash
 * Date: 26/07/2019
 * Time: 15:19
 */
?>
<div class="modal-content">
    <h4>Nuevo Cliente</h4><i class="large material-icons" id="close">close</i>
    <div class="row">
        <div class="input-field col s12">
            <input type="text" name="fullName" id="fullName">
            <label for="fullName">Nombre Completo</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s6">
            <input type="text" name="phone" id="phone">
            <label for="phone">Teléfono</label>
        </div>
        <div class="input-field col s6">
            <input type="text" name="mail" id="mail">
            <label for="mail">Correo</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <input type="text" name="address" id="address">
            <label for="address">Dirección</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s6">
            <input type="text" name="city" id="city">
            <label for="city">Ciudad</label>
        </div>
        <div class="input-field col s6">
            <input type="text" name="country" id="country">
            <label for="country">País</label>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <input type="text" name="cp" id="cp">
                <label for="cp">Código Postal</label>
            </div>
            <div class="input-field col s6">
                <input type="text" name="nif" id="nif">
                <label for="nif">DNI/CIF</label>
            </div>
        </div>

    </div>
</div>
<div class="modal-footer">
    <a href="#!" onclick="newCustomer()" class="modal-action modal-close waves-effect waves-green btn-flat">Registrar</a>
</div>

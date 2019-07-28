<?php
/**
 * Created by PhpStorm.
 * User: flash
 * Date: 26/07/2019
 * Time: 19:28
 */

require_once $_SERVER["DOCUMENT_ROOT"]. '/core/config.php';

$user = new users();
$userData = $user->myProfile($_SESSION["id"])[0];

?>
<div class='module myProfile'>
    <h4>Mi Perfil</h4>
    <div class="row">
        <div class="col s12">
            <label>Nombre Completo</label>
            <input type="text" name="fullName" id="fullName" value="<?php echo $userData["fullName"];?>">
        </div>
    </div>
    <div class="row">
        <div class="col s6">
            <label>Teléfono</label>
            <input type="text" name="phone" id="phone" value="<?php echo $userData["phone"];?>">
        </div>
        <div class="col s6">
            <label>Correo Electrónico</label>
            <input type="text" name="mail" id="mail" value="<?php echo $userData["email"];?>">
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <label>Dirección Completa</label>
            <input type="text" name="address" id="address" value="<?php echo $userData["address"];?>">
        </div>
    </div>
    <div class="row">
        <div class="col s6">
            <label>Ciudad</label>
            <input type="text" name="city" id="city" value="<?php echo $userData["city"];?>">
        </div>
        <div class="col s6">
            <label>País</label>
            <input type="text" name="country" id="country" value="<?php echo $userData["country"];?>">
        </div>
        <div class="row">
            <div class="col s6">
                <label>Código Postal</label>
                <input type="text" name="cp" id="cp" value="<?php echo $userData["cp"];?>">
            </div>
            <div class="col s6">
                <label>NIF/DNI</label>
                <input type="text" name="nif" id="nif" value="<?php echo $userData["nif"];?>">
            </div>
        </div>
    </div>
    <h5>Configuración de Factura</h5>
    <div class="row">
        <div class="col s3">
            <label>IVA</label>
            <input type="text" name="rate" id="rate" value="<?php echo $userData["rate"];?> %" >
        </div>
        <div class="col s3">
            <label>Prefijo de factura</label>
            <input type="text" name="prefixInv" id="prefixInv" value="<?php echo $userData["prefixInv"];?>">
        </div>
        <div class="col s3">
            <label>¿Año en facturación?</label>
            <select name="yearInv">
                <option value="si">Sí</option>
                <option value="no"<?php if ($userData["yearInv"]== 0){echo "selected";}?>>No</option>
            </select>
        </div>
        <div class="col s3">
            <label>Número actual</label>
            <input type="text" name="numberInv" id="numberInv" value="<?php echo $userData["numberInv"];?>" disabled>
        </div>
        <div class="col s12">
            <label>Numeración actual</label>
            <span><?php echo $userData["prefixInv"];?>/<?php if ($userData["yearInv"]== 1){echo date("Y")."/";} else {echo "";};?><?php echo $userData["numberInv"];?></span>
        </div>
    </div>
    <a href="#!" onclick="saveProfile(<?php echo $_SESSION["id"];?>)" class="modal-action modal-close waves-effect waves-green btn-flat">Guardar</a>
</div>


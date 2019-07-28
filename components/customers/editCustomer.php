<?php
/**
 * Created by PhpStorm.
 * User: flash
 * Date: 26/07/2019
 * Time: 15:19
 */

require_once $_SERVER["DOCUMENT_ROOT"]. '/core/config.php';
$customers = new customers();
$customer = $customers->getCustomer($_POST["id"]);
?>
<div class="modal-content">
    <h4>Editar Cliente</h4><i class="large material-icons" id="close">close</i>
    <div class="row">
        <div class="input-field col s12">
            <input type="text" name="fullName" id="fullName" value="<?php echo $customer["fullName"];?>">
        </div>
    </div>
    <div class="row">
        <div class="input-field col s6">
            <input type="text" name="phone" id="phone" value="<?php echo $customer["phone"];?>">
        </div>
        <div class="input-field col s6">
            <input type="text" name="mail" id="mail" value="<?php echo $customer["mail"];?>">
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <input type="text" name="address" id="address" value="<?php echo $customer["address"];?>">
        </div>
    </div>
    <div class="row">
        <div class="input-field col s6">
            <input type="text" name="city" id="city" value="<?php echo $customer["city"];?>">
        </div>
        <div class="input-field col s6">
            <input type="text" name="country" id="country" value="<?php echo $customer["country"];?>">
        </div>
        <div class="row">
            <div class="input-field col s6">
                <input type="text" name="cp" id="cp" value="<?php echo $customer["cp"];?>">
            </div>
            <div class="input-field col s6">
                <input type="text" name="nif" id="nif" value="<?php echo $customer["nif"];?>">
            </div>
        </div>

    </div>
</div>
<div class="modal-footer">
    <a href="#!" onclick="saveCustomer(<?php echo $_POST["id"];?>)" class="modal-action modal-close waves-effect waves-green btn-flat">Guardar</a>
</div>

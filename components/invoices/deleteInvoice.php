<?php
/**
 * Created by PhpStorm.
 * User: flash
 * Date: 27/07/2019
 * Time: 12:29
 */
?>
<div class="modal-content">
    <i class="large material-icons" id="close">close</i>
    <p>¿Está seguro que quiere borrar la factura con numero <?php echo $_POST["fullName"]; ?></p>
    <a onclick="deleteInvoice(<?php echo $_POST["id"]; ?>)" style="margin-right: 10px" class="btn">Sí</a><a goTo="close" class="btn">No</a>

</div>

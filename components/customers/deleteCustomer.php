<?php
/**
 * Created by PhpStorm.
 * User: flash
 * Date: 26/07/2019
 * Time: 15:23
 */

?>
<div class="modal-content">
    <i class="large material-icons" id="close">close</i>
    <p>¿Está seguro que quiere borrar al cliente <?php echo $_POST["fullName"]; ?></p>
    <a onclick="deleteUser(<?php echo $_POST["id"]; ?>)" style="margin-right: 10px" class="btn">Sí</a><a goTo="close" class="btn">No</a>

</div>

<?php
/**
 * Created by PhpStorm.
 * User: flash
 * Date: 26/07/2019
 * Time: 15:19
 */
require_once $_SERVER["DOCUMENT_ROOT"]. '/core/config.php';
$customers = new customers();
$customersName = $customers->getCustomers();
$users = new users();
$user = $users->myProfile($_SESSION["id"]);
$year = ($user[0]["yearInv"] == 0) ? "" : date("Y") . "/";
$newNumber = $user[0]["numberInv"] +1;
$newNumber = substr("00000".$newNumber, -5);

$numberInv = $user[0]["prefixInv"] . "/" . $year . $newNumber;

?>
<div class="modal-content">
    <h4>Nueva Factura</h4><i class="large material-icons" id="close">close</i>
    <div class="row">
        <div class="col s3">
            <label for="phone">Número de Factura</label>
            <input type="text" name="number" id="number" value="<?php echo $numberInv ?>" disabled>
        </div>
        <div class="col s5 offset-s1">
            <label>Cliente</label>
            <select name="customer">
                <?php
                foreach($customersName as $c){
                    echo "<option idCustomer='" . $c["id"] . "'>" .$c["fullName"] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="col s2 offset-s1">
            <label>IVA</label>
            <input type="text" name="rate" id="rate" value="<? echo $user[0]["rate"] ?> %" disabled>
        </div>
    </div>
    <div class="detailsInvoice">

        <input type="hidden" name="idElement" id="idElement" value="1" disabled>
        <div class="row">
            <div class="col s1">
                <label for="id">ID</label>
            </div>
            <div class="col s2">
                <label for="quantity">Cantidad</label>
            </div>
            <div class="col s7">
                <label for="detail">Descripción</label>
            </div>
            <div class="col s2">
                <label for="price">Precio</label>
            </div>
        </div>
        <div class="row" detail="row" copy="copy" style="display: none;">
            <div class="input-field col s1">
                <input type="text" name="id" id="id" value="1" disabled>
            </div>
            <div class="input-field col s2">
                <input type="number" name="quantity" id="quantity">
            </div>
            <div class="input-field col s7">
                <input type="text" name="detail" id="detail">
            </div>
            <div class="input-field col s2">
                <input type="text" name="price" id="price">
            </div>
        </div>
        <div class="row" detail="row">
            <div class="input-field col s1">
                <input type="text" name="id" id="id" value="1" disabled>
            </div>
            <div class="input-field col s2">
                <input type="number" name="quantity" id="quantity">
            </div>
            <div class="input-field col s7">
                <input type="text" name="detail" id="detail">
            </div>
            <div class="input-field col s2">
                <input type="text" name="price" id="price">
            </div>
        </div>
    </div>
    <a class="modal-trigger waves-effect waves-tomato btn-floating btn-small" onclick="moreDetail()"><i class="large material-icons tomato">add</i></a>
    <a class="modal-trigger waves-effect waves-tomato btn-floating btn-small" onclick="removeDetail()"><i class="large material-icons tomato">remove</i></a>

    <div class="row">
        <div class="col s4">
            <a  style="display:block;" class="btn-small" onclick="recalculate()">Recalcular factura</a>
        </div>
        <div class="col s4 offset-s4">
            <div class="col s6">
                <p>Total Imp. Excl.</p>
            </div>
            <div class="col s6">
                <input type="text" name="totals" value="0 €" disabled>
            </div>
        </div>
        <div class="col s4 offset-s8">
            <div class="col s6">
                <p>IVA <? echo $user[0]["rate"] ?> %</p>
            </div>
            <div class="col s6">
                <input type="text" name="rateTotal" value="0 €" disabled>
            </div>
        </div>
        <div class="col s4 offset-s8">
            <div class="col s6">
                <p><b>Total Fra.</b></p>
            </div>
            <div class="col s6">
                <input type="text" name="totalFra" value="0 €" disabled>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <textarea name="comment" id="comment" class="materialize-textarea"></textarea>
            <label for="comment">Comentario</label>
        </div>

    </div>
</div>
<div class="modal-footer">
    <a href="#!" onclick="newInvoice()" class="modal-action modal-close waves-effect waves-green btn-flat">Crear Factura</a>
</div>

<script>


</script>

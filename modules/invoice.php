<?php
/**
 * Created by PhpStorm.
 * User: flash
 * Date: 26/07/2019
 * Time: 0:00
 */

require_once $_SERVER["DOCUMENT_ROOT"]. '/core/config.php';

$invoices = new invoices();


?>

<div class="module">
    <h4>Facturas</h4><a class="modal-trigger waves-effect waves-tomato btn-floating btn-small" href="#modal1"><i class="large material-icons tomato">add</i></a>
    <div id="modal1" class="modal">

    </div>
    <table class="striped">
        <thead>
        <tr>
            <th data-field="id">Nº Factura</th>
            <th data-field="id">Fecha</th>
            <th data-field="price">NIF</th>
            <th data-field="name">Cliente</th>
            <th data-field="name">Importe</th>
            <th data-field="name">IVA</th>
            <th data-field="price">Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($invoices->getInvoices() as $invoice){
            ?>
            <tr customer="<?php echo $invoice["number"] ?>">
                <td name="date"><?php echo $invoice["number"]; ?></td>
                <td name="date"><?php echo $invoice["date"]; ?></td>
                <td><?php echo $invoice["nif"]; ?></td>
                <td><?php echo $invoice["customer"]; ?></td>
                <td><?php echo $invoice["total"]; ?></td>
                <td><?php echo $invoice["rate"]; ?></td>
                <td><i invoice="<?php echo $invoice["id"] ?>" onclick="editInvoice(this)" class="large material-icons customerIcon">edit</i><i invoice="<?php echo $invoice["id"] ?>" onclick="modalDeleteInvoice(this)" class="large material-icons customerIcon">delete</i><a title="Descargar Factura" target="_blank" href="/controllers/generateInvoice.php?invoice=<?php echo $invoice["id"] ?>"><i class="large material-icons customerIcon">description</i></a></td>
            </tr>
            <?php
        }
        ?>
        </tbody>

    </table>
</div>

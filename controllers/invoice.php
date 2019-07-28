<?php
/**
 * Created by PhpStorm.
 * User: flash
 * Date: 26/07/2019
 * Time: 23:39
 */

require_once $_SERVER["DOCUMENT_ROOT"]. '/core/config.php';

$invoices = new invoices();

switch ($_POST["action"]){
    case "newInvoice":
        newInvoice($invoices);
        break;
    case "deleteInvoice":
        deleteInvoice($invoices, $_POST["id"]);
        break;
}

function newInvoice($invoices){

    $number = $invoices->nextNumerInvoice($_SESSION["id"]);
    $dataInvoice = array(
        "number" => $number,
        "customer" => $_POST["customerId"],
        "rate" => $_POST["rate"],
        "comment" => $_POST["comment"],
        "userId" => $_SESSION["id"]
    );

    $idInvoice = $invoices->newInvoice($dataInvoice);

    if(!$idInvoice){
        die();
    }


    $details = $_POST["details"];

    $res = array();

    foreach($details as $detail) {
        if(empty($detail)){
            continue;
        }

        $data = array(
            "idInvoice" => $idInvoice,
            "quantity" => $detail["quantity"],
            "detail" => $detail["detail"],
            "price" => $detail["price"]

        );

        if($invoices->registerDetail($data))
            $res[] = true;
        else
            $res[] = false;
    }
    $res = in_array(false, $res);


    if(!$res){
        echo "<span id='notice' style=\"width: 100%;border: 1px solid #0dbd0d;display: block;padding: 10px;border-radius: 6px;color: #0dbd0d;\">Se ha añadido la factura con Exito</span>";
    }
}

function deleteInvoice($invoices, $id) {
    if($invoices->deleteInvoice($id)){
        echo "<span id='notice' style=\"width: 100%;border: 1px solid #0dbd0d;display: block;padding: 10px;border-radius: 6px;color: #0dbd0d;\">Se ha eliminado la factura con exito</span>";
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: flash
 * Date: 26/07/2019
 * Time: 1:01
 */

require_once $_SERVER["DOCUMENT_ROOT"]. '/core/config.php';

$customers = new customers();

$action = $_POST["action"];

switch ($action){
    case 'newCustomer':
        newCustomer($customers);
        break;
    case 'deleteCustomer':
        deleteCustomer($customers, $_POST["id"]);
        break;
    case 'saveCustomer':
        saveCustomer($customers);
}

function newCustomer($customers){
    $data = array(
        "fullName" => $_POST["fullName"],
        "address" => $_POST["address"],
        "cp" => $_POST["cp"],
        "city" => $_POST["city"],
        "nif" => $_POST["nif"],
        "country" => $_POST["country"],
        "phone" => $_POST["phone"],
        "mail" => $_POST["mail"],
    );
    if($customers->newCustomer($data)){
        echo "<span id='notice' style=\"width: 100%;border: 1px solid #0dbd0d;display: block;padding: 10px;border-radius: 6px;color: #0dbd0d;\">Se ha registrado con Exito</span>";
    }
}

function deleteCustomer($customers,$id){
    if($customers->deleteCustomer($id)){
        echo "<span id='notice' style=\"width: 100%;border: 1px solid #0dbd0d;display: block;padding: 10px;border-radius: 6px;color: #0dbd0d;\">Se ha eliminado con exito</span>";
    }
}

function saveCustomer($customers){
    $data = array(
        "fullName" => $_POST["fullName"],
        "address" => $_POST["address"],
        "cp" => $_POST["cp"],
        "city" => $_POST["city"],
        "nif" => $_POST["nif"],
        "country" => $_POST["country"],
        "phone" => $_POST["phone"],
        "mail" => $_POST["mail"],
        "id"=> $_POST["id"]
    );
//    var_dump($data);
    if($customers->saveCustomer($data)){
        echo "<span id='notice' style=\"width: 100%;border: 1px solid #0dbd0d;display: block;padding: 10px;border-radius: 6px;color: #0dbd0d;\">Se ha modificado con exito</span>";
    }
}



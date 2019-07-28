<?php
/**
 * Created by PhpStorm.
 * User: flash
 * Date: 26/07/2019
 * Time: 19:56
 */

require_once $_SERVER["DOCUMENT_ROOT"]. '/core/config.php';

$profile = new users();

$action = $_POST["action"];

switch ($action){
    case 'saveProfile':
        saveProfile($profile);
        break;
}

function saveProfile($profile){
    $data = array(
        "fullName" => $_POST["fullName"],
        "address" => $_POST["address"],
        "cp" => $_POST["cp"],
        "city" => $_POST["city"],
        "nif" => $_POST["nif"],
        "country" => $_POST["country"],
        "phone" => $_POST["phone"],
        "email" => $_POST["email"],
        "prefixInv" => $_POST["prefixInv"],
        "yearInv" => $_POST["yearInv"],
        "rate" => $_POST["rate"],
        "userId" => $_SESSION["id"]
    );
    if($profile->saveProfile($data)){
        echo "<span id='notice' style=\"width: 100%;border: 1px solid #0dbd0d;display: block;padding: 10px;border-radius: 6px;color: #0dbd0d;\">Se ha modificado con exito</span>";
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: flash
 * Date: 28/07/2019
 * Time: 3:09
 */


require_once $_SERVER["DOCUMENT_ROOT"]. '/core/config.php';

$data = array(
    "user" => $_POST["user"],
    "pass" => $_POST["pass"],
    "email" => $_POST["email"]
);

$users = new users();
if($users->registerUser($data)){
    echo "<span id='notice' style=\"width: 100%;border: 1px solid #0dbd0d;display: block;padding: 10px;border-radius: 6px;color: #0dbd0d;\">Se ha registrado con Exito</span>";
}

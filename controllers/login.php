<?php
/**
 * Created by PhpStorm.
 * User: flash
 * Date: 25/07/2019
 * Time: 23:14
 */

require_once $_SERVER["DOCUMENT_ROOT"]. '/core/config.php';

//var_dump($_POST);
$user = $_POST["user"];
$pass = hash('sha256', $_POST["pass"]);

$users = new users();

var_dump($users->login($user,$pass));

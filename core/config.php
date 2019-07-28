<?php
$_SESSION["status"] = false;
session_start();


require $_SERVER["DOCUMENT_ROOT"].'vendor/autoload.php';

spl_autoload_register(function ($nombre_clase) {
    include $_SERVER["DOCUMENT_ROOT"]. "/core/lib/" . $nombre_clase . '.php';
});

function get_header(){
    include_once $_SERVER["DOCUMENT_ROOT"] . '/views/header.php';
}

function guay($e){
    echo "<pre>";
    var_dump($e);
    echo "</pre>";
}

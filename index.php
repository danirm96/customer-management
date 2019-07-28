<?php
require_once 'core/config.php';

get_header();

if(!isset($_SESSION["status"])){
    include_once 'views/login.php';
} else {
    include_once 'views/dashboard.php';
}

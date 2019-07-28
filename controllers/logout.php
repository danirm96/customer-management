<?php
/**
 * Created by PhpStorm.
 * User: flash
 * Date: 26/07/2019
 * Time: 14:22
 */

require_once $_SERVER["DOCUMENT_ROOT"]. '/core/config.php';
if($_POST["action"])
    session_destroy();

<?php
/**
 * Created by PhpStorm.
 * User: flash
 * Date: 25/07/2019
 * Time: 23:08
 */

class db_connect{
    public $db;

    public function __construct() {
        $user = "root";
        $pass = "";
        $connect = new PDO('mysql:host=localhost;dbname=dpcrm',$user,$pass);

        $this->db = $connect;


    }
}

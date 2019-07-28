<?php
/**
 * Created by PhpStorm.
 * User: flash
 * Date: 26/07/2019
 * Time: 0:01
 */

class customers extends db_connect{

    public function __construct()
    {
        parent::__construct();
    }

    public function newCustomer($data){
        $sql = $this->db->prepare("INSERT INTO customers (fullName, address, cp, city, nif, country,phone, mail) VALUES (:fullName, :address, :cp, :city, :nif, :country, :phone, :mail)");
        $sql->bindParam(":fullName", $data["fullName"]);
        $sql->bindParam(":address", $data["address"]);
        $sql->bindParam(":cp", $data["cp"]);
        $sql->bindParam(":city", $data["city"]);
        $sql->bindParam(":nif", $data["nif"]);
        $sql->bindParam(":country", $data["country"]);
        $sql->bindParam(":mail", $data["mail"]);
        $sql->bindParam(":phone", $data["phone"]);
        if($sql->execute()){
            return true;
        } else {
            $sql->errorInfo();
        }
    }

    public function getCustomers(){
        $sql = $this->db->prepare("SELECT * FROM customers LIMIT 20");
        $sql->execute();
        $ret = $sql->fetchAll(2);
        return $ret;

    }
    public function deleteCustomer($id){
        $sql = $this->db->prepare("DELETE FROM customers WHERE id = ". $id);
        if($sql->execute()){
            return true;
        }
    }

    public function getCustomer($id){

        $sql = $this->db->prepare("SELECT * FROM customers WHERE id = ". $id);
        $sql->execute();
        $ret =$sql->fetchAll(2)[0];
        return $ret;

    }

    public function saveCustomer($data){
        $sql = $this->db->prepare("UPDATE customers SET fullName = :fullName, address = :address, cp = :cp, city = :city, nif = :nif, country = :country,phone = :phone, mail = :mail WHERE id = ". $data["id"]);
        $sql->bindParam(":fullName", $data["fullName"]);
        $sql->bindParam(":address", $data["address"]);
        $sql->bindParam(":cp", $data["cp"]);
        $sql->bindParam(":city", $data["city"]);
        $sql->bindParam(":nif", $data["nif"]);
        $sql->bindParam(":country", $data["country"]);
        $sql->bindParam(":mail", $data["mail"]);
        $sql->bindParam(":phone", $data["phone"]);
        if($sql->execute()){
            return true;
        } else {
            return $sql->errorInfo();
        }
    }
}

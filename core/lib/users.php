<?php
/**
 * Created by PhpStorm.
 * User: flash
 * Date: 25/07/2019
 * Time: 23:08
 */

class users extends db_connect {

    public function __construct()
    {
        parent::__construct();
    }

    public function registerUser($data){
        $pass = hash('sha256', $data["pass"]);
        $sql = $this->db->prepare("INSERT INTO users (user, pass,email) VALUES (:user,:pass,:email)");
        $sql->bindParam(":pass", $pass);
        $sql->bindParam(":user", $data["user"]);
        $sql->bindParam(":email", $data["email"]);
        if($sql->execute()){
            $ret = $this->db->lastInsertId();
        } else {
            $ret = $sql->errorInfo();
        }

        return $ret;

    }

    public function login($user,$pass){
        $sql = $this->db->prepare("SELECT id FROM users WHERE user = :user AND pass = :pass");
        $sql->bindParam(":user", $user);
        $sql->bindParam(":pass", $pass);
        if($sql->execute()){
            $_SESSION["id"] = $sql->fetchAll(2)[0]["id"];
            $_SESSION["status"] = true;
            return true;
        } else {
            return $sql->errorInfo();
        }
    }
    public function myProfile($id){
        $sql = $this->db->prepare("SELECT * from users WHERE id = :id");
        $sql->bindParam(":id", $id);
        if($sql->execute()){
            $ret = $sql->fetchAll(2);
        } else {
            $ret = $sql->errorInfo();
        }
        return $ret;
    }
    public function saveProfile($data){
        $yearInv = $data["yearInv"] === "no" ? 0 : 1;

        $rate = intval(str_replace(" %","",$data["rate"]));
        $sql = $this->db->prepare("UPDATE users SET fullName = :fullName, address = :address, cp = :cp, city = :city, nif = :nif, country = :country,phone = :phone, email = :email, prefixInv = :prefixInv, yearInv = :yearInv, rate = :rate WHERE id = ". $data["userId"]);
        $sql->bindParam(":fullName", $data["fullName"]);
        $sql->bindParam(":address", $data["address"]);
        $sql->bindParam(":cp", $data["cp"]);
        $sql->bindParam(":city", $data["city"]);
        $sql->bindParam(":nif", $data["nif"]);
        $sql->bindParam(":country", $data["country"]);
        $sql->bindParam(":email", $data["email"]);
        $sql->bindParam(":phone", $data["phone"]);
        $sql->bindParam(":prefixInv", $data["prefixInv"]);
        $sql->bindParam(":rate", $rate);
        $sql->bindParam(":yearInv", $yearInv);
        if($sql->execute()){
            return true;
        } else {
            return $sql->errorInfo();
        }
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: flash
 * Date: 26/07/2019
 * Time: 20:27
 */

use Spipu\Html2Pdf\Html2Pdf;

class invoices extends db_connect {

    public function __construct()
    {
        parent::__construct();
    }

    public function newInvoice($data){
        $date = date("d/m/Y");
        $number = $data["number"];
        $sql = $this->db->prepare("INSERT INTO invoices(userId,number,customer,rate,comment, date) VALUES (:userId, :number, :customer, :rate, :comment, :date)");
        $sql->bindParam(":number",$data["number"]);
        $sql->bindParam(":customer", $data["customer"]);
        $sql->bindParam(":rate", $data["rate"]);
        $sql->bindParam(":comment", $data["comment"]);
        $sql->bindParam(":userId", $data["userId"]);
        $sql->bindParam(":date", $date);
        if($sql->execute()){
            $ret = $this->db->lastInsertId();
            $number = $this->currentNumberInvoice($data["userId"]);
            $number = floatval($number)+1;
            $number = $this->saveNumberInvioce($data["userId"], $number);
        } else{
            $ret = $sql->errorInfo();
        }

        return $ret;
    }

    public function nextNumerInvoice($id){
        $sql = $this->db->prepare("SELECT numberInv, yearInv, prefixInv  FROM users WHERE id = ".$id);
        if($sql->execute()){
            $res = $sql->fetchAll(2)[0];
            $number = floatval($res["numberInv"])+1;
            $number = substr("00000".$number, -5);

            $year = ($res["yearInv"] == 0) ? "" : date("Y") . "/";

            $prefix = $res["prefixInv"];

            $ret = $prefix . "/" . $year . $number;

        } else{
            $ret = $sql->errorInfo();
        }

        return $ret;
    }

    public function currentNumberInvoice($id){
        $sql = $this->db->prepare("SELECT numberInv FROM users WHERE id = ".$id);
        if($sql->execute()){
            $ret = $sql->fetchAll(2)[0]["numberInv"];
        } else{
            $ret = $sql->errorInfo();
        }

        return $ret;
    }

    public function saveNumberInvioce($id,$number){
        $sql = $this->db->prepare("UPDATE users SET numberInv = " .$number . " WHERE id = " .$id);
        if($sql->execute()){
            $ret = true;
        } else {
            $ret = $sql->errorInfo();
        }

        return $ret;
    }

    public function registerDetail($data){


        $sql = $this->db->prepare("INSERT INTO rel_invoices (idInvoice, detail,quantity,price) VALUES (:idInvoice, :detail, :quantity, :price)");
        $sql->bindParam(":idInvoice", $data["idInvoice"]);
        $sql->bindParam(":quantity", $data["quantity"]);
        $sql->bindParam(":detail", $data["detail"]);
        $sql->bindParam(":price", $data["price"]);
        if($sql->execute()){
            $ret = true;
        } else {
            $ret = $sql->errorInfo();
        }
        return $ret;
    }

    public function getInvoices(){
        $sql = $this->db->prepare("SELECT * FROM invoices");
        $sql->execute();
        $inv = $sql->fetchAll(2);

        $invoices = array();

        foreach ($inv as $item){
            $sql = $this->db->prepare("SELECT * FROM customers WHERE id = ". $item["customer"]);
            $sql->execute();
            $customer = $sql->fetchAll(2)[0];
            $total = $this->totalInvoice($item["id"],$item["userId"]);

            $invoices[] = array(
                "id" => $item["id"],
                "number" => $item["number"],
                "date" => $item["date"],
                "nif" => $customer["nif"],
                "customer" => $customer["fullName"],
                "total" => $total["totalFra"],
                "rate" => $total["rate"]

            );
        }
        return $invoices;
    }

    public function totalInvoice($id,$idUser){
        $sql = $this->db->prepare("SELECT price,quantity FROM rel_invoices WHERE idInvoice = " . $id);
        $sql->execute();
        $ret = $sql->fetchAll(2);

        $rate = $this->db->prepare("SELECT rate FROM users WHERE id = ".$idUser);
        $rate->execute();
        $rate = floatval($rate->fetchAll(2)[0]["rate"]);
        $total = 0;

        foreach($ret as $r){
            $total = $total + (floatval($r["price"]) * floatval($r["quantity"]));
        }

        $iva = $total * ($rate / 100);

        $totals = array(
            "total" => $total,
            "rate" => $iva,
            "totalFra" => $total + $iva
        );
        return $totals;
    }

    public function deleteInvoice($id) {
        $sql = $this->db->prepare("DELETE FROM invoices WHERE id = " .$id);
        if($sql->execute()){
            $sql = $this->db->prepare("DELETE FROM rel_invoices WHERE idInvoice = ". $id);
            if($sql->execute()){
                $ret = true;
            } else {
                $ret = $sql->errorInfo();
            }
        } else {
            $ret = $sql->errorInfo();
        }

        return $ret;
    }


    public function getInvoice($id,$userId){
        $sql = $this->db->prepare("SELECT * FROM invoices WHERE id = " .$id);
        $sql->execute();
        $inv = $sql->fetchAll(2);


        $invoices = array();

        foreach ($inv as $item){
            $sql = $this->db->prepare("SELECT * FROM customers WHERE id = ". $item["customer"]);
            $sql->execute();
            $customer = $sql->fetchAll(2)[0];
            $total = $this->totalInvoice($item["id"],$item["userId"]);

            $sql = $this->db->prepare("SELECT * FROM rel_invoices WHERE idInvoice = " . $id);
            $sql->execute();
            $details = $sql->fetchAll(2);
            $sql = $this->db->prepare("SELECT * FROM users WHERE id = ". $userId);
            $sql->execute();
            $user = $sql->fetchAll(2)[0];


            $invoices[] = array(
                "id" => $item["id"],
                "number" => $item["number"],
                "date" => $item["date"],
                "user" => array(
                    "fullName" => $user["fullName"],
                    "address" => $user["address"],
                    "city" => $user["city"],
                    "country" => $user["country"],
                    "cp" => $user["cp"],
                    "nif" => $user["nif"],
                ),
                "customer" => array(
                    "customer" => $customer["fullName"],
                    "nif" => $customer["nif"],
                    "address" => $customer["address"],
                    "cp" => $customer["cp"],
                    "city" => $customer["city"],
                    "country" => $customer["country"],
                ),
                "total" => $total["totalFra"],
                "rate" => $total["rate"],
                "comment" => $item["comment"],
                "details" => $details

            );


        }
        return $invoices;
    }
}

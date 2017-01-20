<?php

require_once 'model/DB.php';
require_once 'model/AbstractDB.php';


class OsebaDB {

    public static function getUser($email, $geslo) {
       
        $dbh = DBInit::getInstance();
        $stmt = $dbh->prepare("SELECT id, ime, priimek, email, geslo, naslov FROM stranka WHERE email = :email");
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        
        $user = $stmt->fetch();
        
        if (password_verify($geslo, $user["geslo"])) {
            unset($user["geslo"]);
            return $user;
        } else {    
            return false;
        }
    }
    public static function getAdmin($email, $geslo) {

        $dbh = DBInit::getInstance();
        $stmt = $dbh->prepare("SELECT id, email, geslo FROM admin WHERE email = :email");
        $stmt->bindValue(":email", $email);
        $stmt->execute();

        $user = $stmt->fetch();
            
        if (password_verify($geslo, $user["geslo"])) {
            unset($user["geslo"]);
            return $user;
        } else {
            return false;
        }
    }
    
    public static function dodaj($ime, $priimek, $email, $geslo, $naslov) {
        $sql = "INSERT INTO stranka (ime, priimek, email, geslo, naslov)"
                . " VALUES (:ime, :priimek, :email, :geslo, :naslov)";
        $stmt = DBInit::getInstance()->prepare($sql);
        $stmt->bindValue(':ime', $ime);
        $stmt->bindValue(':priimek', $priimek);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':geslo', password_hash($geslo, PASSWORD_BCRYPT));
        $stmt->bindValue(':naslov', $naslov);
        $stmt->execute();
    }
    public static function update(array $params) {
        return AbstractDB::modify("UPDATE stranka SET ime = :ime, priimek = :priimek, "
                        . "elektronski_naslov = :elektronski_naslov, naslov = :naslov, telefonska = :telefonska"
                        . " WHERE idstranka = :id", $params);
    }
    
    public static function updateStranka($id, $ime, $priimek, $email, $geslo, $naslov) {
        $geslo = password_hash($geslo, PASSWORD_BCRYPT);
        $sql = "UPDATE stranka SET ime = '$ime', priimek = '$priimek', email = '$email', geslo = '$geslo', naslov = '$naslov' WHERE id = '$id';";
        $stmt = DBInit::getInstance()->prepare($sql);
        $stmt->execute();        
    }
    
    public static function getStranka(array $id){
        
        $stranka = AbstractDB::query("SELECT id, ime, priimek, email, naslov"
                        . " FROM stranka"
                        . " WHERE id = :id", $id);

        if (count($stranka) == 1) {
            return $stranka[0];
        } else {
            throw new InvalidArgumentException("Ta stranka ne obstaja.");
        }
        
    }

}

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'model/AbstractDB.php';
require_once 'model/DB.php';

class VozicekDB {
    
    public static function dodajNarocilo($idstranka, $total) {
        $sql = "INSERT INTO narocilo (status, idstranka, total) VALUES (0, :idstranka, :total)";
        $stmt = DBInit::getInstance()->prepare($sql);
        $stmt->bindValue(':idstranka', $idstranka);
        $stmt->bindValue(':total', $total);
        $stmt->execute();
        
        $_SESSION["vozicek"]["id"] = AbstractDB::getConnection()->lastInsertId();
        return $_SESSION["vozicek"]["id"];
    }
    
    public static function dodajIzdelkeVNarocilo($idnarocilo, $idizdelek, $quantity) {
        
        $sql = "INSERT INTO vozicek (idnarocilo, idizdelek, quantity) VALUES (:idnarocilo, :idizdelek, :quantity)";
        $stmt = DBInit::getInstance()->prepare($sql);
        $stmt->bindValue(':idnarocilo', $idnarocilo);
        $stmt->bindValue(':idizdelek', $idizdelek);
        $stmt->bindValue(':quantity', $quantity);
        $stmt->execute();
        
    }
    
    public static function povecajStanje($id){
        
        $sql = "UPDATE narocilo SET status = status + 1 WHERE id = :id";
        $stmt = DBInit::getInstance()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        
    }
    
    public static function getById(array $id){
        $sql = "SELECT id, status, idstranka, total FROM narocilo WHERE id = :id";
        $stmt = DBInit::getInstance()->prepare($sql);
        $stmt->bindValue(':id', $id["id"]);
        $stmt->execute();
        
        $narocilo = $stmt->fetchAll();
        
        if (count($narocilo) == 1) {
            return $narocilo[0];
        } else {
            throw new InvalidArgumentException("To naročilo ne obstaja.");
        }
    }
    
    public static function getNarociloByStatus($status){
        
        $sql = "SELECT id, status, idstranka, total FROM narocilo WHERE status = :status";
        $stmt = DBInit::getInstance()->prepare($sql);
        $stmt->bindValue(':status', $status);
        $stmt->execute();
        
        $narocilo = $stmt->fetchAll();
        
        if (count($narocilo) != 0) {
            return $narocilo;
        } else {
            throw new InvalidArgumentException("Ni naročil v čakalni vrsti.");
        }
    }

    public static function getIzdelkiNarocila($id){
        
        $sql = "SELECT id, idnarocilo, idizdelek, quantity FROM vozicek WHERE idnarocilo = :idnarocilo";
        $stmt = DBInit::getInstance()->prepare($sql);
        $stmt->bindValue(':idnarocilo', $id);
        $stmt->execute();
        
        $izdelki = $stmt->fetchAll();
        
        return $izdelki;
    }
    
}

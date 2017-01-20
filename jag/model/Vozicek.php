<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once("model/IzdelekDB.php");

class Vozicek {

    public static function getAll() {
        if (!isset($_SESSION["vozicek"]) || empty($_SESSION["vozicek"])) {
            return [];
        }

        $ids = array_keys($_SESSION["vozicek"]);
        $vozicek = IzdelekDB::getForIds($ids);

        // Adds a quantity field to each book in the list
        foreach ($vozicek as &$izdelek) {
            $izdelek["quantity"] = $_SESSION["vozicek"][$izdelek["id"]];
        }

        return $vozicek;
    }

    public static function add($id) {
        $izdelek = IzdelekDB::get(["id" => $id]);
        
        print_r($izdelek);
        
        if ($izdelek != null) {
            if (isset($_SESSION["vozicek"][$id])) {
                $_SESSION["vozicek"][$id] += 1;
            } else {
                $_SESSION["vozicek"][$id] = 1;
            }            
        }
    }

    public static function update($id, $quantity) {
        $izdelek = IzdelekDB::get(["id" => $id]);
        $quantity = intval($quantity);

        if ($izdelek != null) {
            if ($quantity <= 0) {
                unset($_SESSION["vozicek"][$id]);
            } else {
                $_SESSION["vozicek"][$id] = $quantity;
            }
        }
    }

    public static function purge() {
        unset($_SESSION["vozicek"]);
    }

    public static function total() {
        return array_reduce(self::getAll(), function ($total, $izdelek) {
            return $total + $izdelek["cena"] * $izdelek["quantity"];
        }, 0);
    }
    
    public static function narociloPlusPlus($vozicekId) {
        
        VozicekDB::povecajStanje($vozicekId);
    }
    
}


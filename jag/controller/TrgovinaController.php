<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once("model/IzdelekDB.php");
require_once("model/Vozicek.php");
require_once("model/VozicekDB.php");
require_once("model/OsebaDB.php");
require_once("ViewHelper.php");

class TrgovinaController {

    public static function index() {
        $vars = [
            "izdelki" => IzdelekDB::getAll(),
            "vozicek" => Vozicek::getAll(),
            "total" => Vozicek::total()
        ];

        echo ViewHelper::render("view/trgovina-index.php", $vars);
    }

    public static function addToCart() {
        $id = isset($_POST["id"]) ? intval($_POST["id"]) : null;
        
        if ($id !== null) {
            Vozicek::add($id);
        }
        
        echo ViewHelper::redirect(BASE_URL . "trgovina");
    }

    public static function updateCart() {
        $id = (isset($_POST["id"])) ? intval($_POST["id"]) : null;
        $quantity = (isset($_POST["quantity"])) ? intval($_POST["quantity"]) : null;

        if ($id !== null && $quantity !== null) {
            Vozicek::update($id, $quantity);
        }

        echo ViewHelper::redirect(BASE_URL . "trgovina");
    }

    public static function purgeCart() {
        Vozicek::purge();

        echo ViewHelper::redirect(BASE_URL . "trgovina");
    }
    
    public static function kupiVozicek() {
        
        $idstranke = $_SESSION["user"]["id"];
        $total = Vozicek::total();
        $idnarocila = VozicekDB::dodajNarocilo($idstranke, $total);
        
        $ids = array_keys($_SESSION["vozicek"]);
        $vozicek = IzdelekDB::getForIds($ids);
        
        foreach ($vozicek as &$izdelek){
            $quantity = $_SESSION["vozicek"][$izdelek["id"]];
            VozicekDB::dodajIzdelkeVNarocilo($idnarocila, $izdelek["id"], $quantity);
        }
        
        echo ViewHelper::redirect(BASE_URL . "trgovina/vozicek");
    }
    
    public static function predracun(){
        
        $vars = [
            "vozicek" => Vozicek::getAll(),
            "total" => Vozicek::total()
        ];
        
        echo ViewHelper::render("view/predracun.php", $vars);
        
    }
    
    public static function uspesenNakup(){
        $vozicekId = $_SESSION["vozicek"]["id"];
        Vozicek::narociloPlusPlus($vozicekId);
        
        $vozicek = Vozicek::getAll();
        $datum = date("Y/m/d");
        $sporocilo = "[$datum] Uporabnik " . Oseba::getElektronski() . " je naročil ";
        foreach($vozicek as $izdelek){
            $sporocilo = $sporocilo . $izdelek["quantity"] . " X " . $izdelek["ime"] . ", ";
        }
        
        error_log("$sporocilo\n", 3, "/home/ep/NetBeansProjects/jag/doc/narocila.log");
        
        Vozicek::purge();
        echo ViewHelper::render("view/uspesen-nakup.php");
        
    }
    
    public static function narocilaNepregledana(){
        
        $narocila = VozicekDB::getNarociloByStatus(1);
        $vars = array();
        $i = 0;
        
        #print_r($narocila);echo"....";
        
        foreach ($narocila as $narocilo) {
            $izdelkiNarocila[$narocilo["id"]] = VozicekDB::getIzdelkiNarocila($narocilo["id"]);
            
            #print_r($izdelkiNarocila[$narocilo["id"]]);echo"---";
            
            foreach ($izdelkiNarocila[$narocilo["id"]] as $izdelek) {
                $izdelek["idizdelek"] = IzdelekDB::get(["id" => $izdelek["idizdelek"]]);
                $izdelek["idnarocilo"] = VozicekDB::getById(["id" => $izdelek["idnarocilo"]]);
                $izdelek["idnarocilo"]["idstranka"] = OsebaDB::getStranka(["id" => $izdelek["idnarocilo"]["idstranka"]]);
                $vars[$i] = $izdelek;
                $i = $i + 1;
                #print_r($izdelek);echo ".:::.";
            }
        }
        
        #print_r($vars);echo ".:::.";
        
        echo ViewHelper::render("view/narocila-nepregledana.php", ["seznam" => $vars]);
    }
    
    public static function potrjenoNarocilo($id){
        Vozicek::narociloPlusPlus($id);
        echo ViewHelper::redirect(BASE_URL . "narocila");
    }

}

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once("model/OsebaDB.php");
require_once("model/Oseba.php");
require_once("ViewHelper.php");
require_once("view/AdminForm.php");

class OsebaController{
    
    public static function loginForm() {
        echo ViewHelper::render("view/prijava.php", ["formAction" => "prijava"]);
    }
    public static function login() {
        $rules = [
            "email" => ["filter" => FILTER_SANITIZE_SPECIAL_CHARS],
            "geslo" => ["filter" => FILTER_SANITIZE_SPECIAL_CHARS]
        ];

        $data = filter_input_array(INPUT_POST, $rules);
        
        #$user = OsebaDB::get(["email" => $data["email"], "geslo" => $data["geslo"]]);
        $user = OsebaDB::getUser($data["email"], $data["geslo"]);
        
        $admin = OsebaDB::getAdmin($data["email"], $data["geslo"]);
        
        $errorMessage =  empty($data["email"]) || $user == null ? "Napacno geslo ali uporabnisko ime." : "";
        $errorMessageAdmin =  empty($data["email"]) || $admin == null ? "Napacno geslo ali uporabnisko ime." : "";
        
        if (empty($errorMessage)) {
            Oseba::login($user);
            
            $vars = [
                "email" => $data["email"],
                #"geslo" => $data["geslo"]
            ];
            echo ViewHelper::render("view/izdelek-list.php", [$vars, "izdelki" => IzdelekDB::getAll()]);
        }elseif(empty($errorMessageAdmin)){
            Oseba::login($admin);
            $_SESSION["admin"] = TRUE;

             $vars = [
                "email" => $data["email"],
                #"geslo" => $data["geslo"]
            ];

            echo ViewHelper::render("view/izdelek-list.php", [$vars, "izdelki" => IzdelekDB::getAll()]);
        }else{
            echo ViewHelper::render("view/prijava.php", [
                "errorMessage" => $errorMessage,
                "formAction" => "prijava"
            ]);
        }
    }
    public static function logout() {
        Oseba::logout();

        ViewHelper::redirect(BASE_URL . "izdelki");
    }
    public static function registerForm(){
        echo ViewHelper::render("view/registracija.php");
    }
    public static function register(){
        echo ViewHelper::render("view/registracija.php");
    }
    
    public static function nastavitveStranka(){
        echo viewHelper::render("view/nastavitveStranka.php");
    }
    
}
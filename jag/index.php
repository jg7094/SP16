<?php

// enables sessions for the entire app
session_start();

require_once("controller/IzdelekController.php");
require_once("controller/OsebaController.php");
require_once("controller/TrgovinaController.php");

define("BASE_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php"));
define("IMAGES_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/images/");
define("CSS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/css/");
define("JS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/js/");

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

$urls = [
    "/^$/" => function () {
        ViewHelper::redirect(BASE_URL . "izdelki");
    },
    "/^izdelki\/?(\d+)?$/" => function ($method, $id = null) {
        if ($id == null) {
            IzdelekController::index();
        } else {
            IzdelekController::get($id);
        }
    },
    "/^izdelki\/uredi\/(\d+)$/" => function ($method, $id) {
        if (Oseba::isLoggedIn() && Oseba::isAdmin()){
            if ($method == "POST") {
                IzdelekController::edit($id);
            } else {
                IzdelekController::editForm($id);
            }
        }else{
            ViewHelper::redirect(BASE_URL . "izdelki");
        }
    },    
    "/^izdelki\/dodaj/" => function ($method) {
        if (Oseba::isLoggedIn() && Oseba::isAdmin()){
            if ($method == "POST") {
                IzdelekController::add();
            } else {
                IzdelekController::addForm();
            }
        }else{
            ViewHelper::redirect(BASE_URL . "izdelki");
        }
    },
    "/^izdelki\/zbrisi\/(\d+)$/" => function ($method, $idizdelek) {
        if (Oseba::isLoggedIn() && Oseba::isAdmin()){    
            if ($method == "POST") {
                IzdelekController::delete($idizdelek);
            }
        }else{
            ViewHelper::redirect(BASE_URL . "izdelki");
        }
    },
            
    "/^prijava$/" => function ($method) {
        if ($method == "POST") {
            OsebaController::login();
        } else {
            OsebaController::loginForm();
        }
    },
    "/^odjava$/" => function () {
        OsebaController::logout();
    },       
    "/^registracija$/" => function ($method) {
        if ($method == "POST") {
            OsebaController::register();
        }else{
            OsebaController::registerForm();
        }
    },

    "/^trgovina$/" => function () {
        if (Oseba::isLoggedIn()){
            TrgovinaController::index();
        }else{
            ViewHelper::redirect(BASE_URL . "izdelki");
        }
    },
    "/^trgovina\/add-to-vozicek$/" => function ($method) {
        if (Oseba::isLoggedIn()){    
            TrgovinaController::addToCart();
        }else{
            ViewHelper::redirect(BASE_URL . "izdelki");
        }
    },
    "/^trgovina\/update-vozicek$/" => function () {
        if (Oseba::isLoggedIn()){
            TrgovinaController::updateCart();
        }else{
            ViewHelper::redirect(BASE_URL . "izdelki");
        }
    },
    "/^trgovina\/purge-vozicek$/" => function () {
        if (Oseba::isLoggedIn()){    
            TrgovinaController::purgeCart();
        }else{
            ViewHelper::redirect(BASE_URL . "izdelki");
        }
    },
    "/^trgovina\/kupi-vozicek$/" => function () {
        if (Oseba::isLoggedIn()){
            TrgovinaController::kupiVozicek();
        }else{
            ViewHelper::redirect(BASE_URL . "izdelki");
        }
    },
    "/^trgovina\/vozicek$/" => function () {
        if (Oseba::isLoggedIn()){    
            TrgovinaController::predracun();
        }else{
            ViewHelper::redirect(BASE_URL . "izdelki");
        }
    },
    "/^trgovina\/uspesen-nakup$/" => function () {
        if (Oseba::isLoggedIn()){
            TrgovinaController::uspesenNakup();
        }else{
            ViewHelper::redirect(BASE_URL . "izdelki");
        }
    },       
            
    "/^nastavitve$/" => function ($method) {
        if (Oseba::isLoggedIn() && !Oseba::isAdmin()){
            OsebaController::nastavitveStranka();
        }else{
            ViewHelper::redirect(BASE_URL . "izdelki");
        }
    }, 
    "/^narocila$/" => function () {
        if (Oseba::isLoggedIn() && Oseba::isAdmin()){
            TrgovinaController::narocilaNepregledana();
        }else{
            ViewHelper::redirect(BASE_URL . "izdelki");
        }
    },       
     "/^narocila\/potrdi\/(\d+)$/" => function ($method, $idnarocilo){
        if (Oseba::isLoggedIn() && Oseba::isAdmin()){
            TrgovinaController::potrjenoNarocilo($idnarocilo);
        }else{
            ViewHelper::redirect(BASE_URL . "izdelki");
        }
    },
            
    "/^o-nas$/" => function () {
        echo ViewHelper::render("view/onas.php");
    },
            
            
];

foreach ($urls as $pattern => $controller) {
    if (preg_match($pattern, $path, $params)) {
        try {
            $params[0] = $_SERVER["REQUEST_METHOD"];
            $controller(...$params);
        } catch (InvalidArgumentException $e) {
            ViewHelper::error404();
        } catch (Exception $e) {
            ViewHelper::displayError($e, true);
        }

        exit();
    }
}

ViewHelper::displayError(new InvalidArgumentException("No controller matched."), true);

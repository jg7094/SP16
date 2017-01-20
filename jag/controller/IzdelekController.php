<?php

require_once("model/IzdelekDB.php");
require_once("ViewHelper.php");
require_once("view/AdminForm.php");
require_once("model/OsebaDB.php");

class IzdelekController {

    public static function get($id) {
        echo ViewHelper::render("view/izdelek-detail.php", IzdelekDB::get(["id" => $id]));
    }

    public static function index() {
        echo ViewHelper::render("view/izdelek-list.php", [
            "izdelki" => IzdelekDB::getAll()
        ]);
    }

    public static function addForm($values = [
        "ime" => "",
        "model" => "",
        "barva" => "",
        "opis" => "",
        "cena" => ""
    ]) {
        echo ViewHelper::render("view/izdelek-dodaj.php", $values);
    }

    public static function add() {
        $data = filter_input_array(INPUT_POST, self::getRules());

        if (self::checkValues($data)) {
            $id = izdelekDB::insert($data);
            echo ViewHelper::redirect(BASE_URL . "izdelki/" . $id);
        } else {
            self::addForm($data);
        }
    }

    public static function editForm($params) {
        if (is_array($params)) {
            $values = $params;
        } else if (is_numeric($params)) {
            $values = IzdelekDB::get(["id" => $params]);
        } else {
            throw new InvalidArgumentException("Cannot show form.");
        }
        
        echo ViewHelper::render("view/izdelek-edit.php", $values);
    }

    public static function edit($id) {
        $data = filter_input_array(INPUT_POST, self::getRules());
        
        print_r($data);
        
        if (self::checkValues($data)) {
            $data["id"] = $id;
            IzdelekDB::update($data);
            ViewHelper::redirect(BASE_URL . "izdelki/" . $data["id"]);
        } else {
            self::editForm($data);
        }
    }

    public static function delete($id) {
        $data = filter_input_array(INPUT_POST, [
            'delete_confirmation' => FILTER_REQUIRE_SCALAR
        ]);
        if (self::checkValues($data)) {
            IzdelekDB::delete(["id" => $id]);
            $url = BASE_URL . "izdelki";
        } else {
            $url = BASE_URL . "izdelki/uredi/" . $id;
        }

        ViewHelper::redirect($url);
    }
    
    
    /**
     * Returns TRUE if given $input array contains no FALSE values
     * @param type $input
     * @return type
     */
    public static function checkValues($input) {
        if (empty($input)) {
            return FALSE;
        }

        $result = TRUE;
        foreach ($input as $value) {
            $result = $result && $value != false;
        }

        return $result;
    }

    /**
     * Returns an array of filtering rules for manipulation books
     * @return type
     */
    public static function getRules() {
        return [
            'ime' => FILTER_SANITIZE_SPECIAL_CHARS,
            'opis' => FILTER_SANITIZE_SPECIAL_CHARS,
            'barva' => FILTER_SANITIZE_SPECIAL_CHARS,
            'model' => FILTER_SANITIZE_SPECIAL_CHARS,
            'cena' => FILTER_VALIDATE_FLOAT,
            
        ];
    }

}

<?php

require_once 'model/AbstractDB.php';

class IzdelekDB extends AbstractDB {

    public static function insert(array $params) {
        return parent::modify("INSERT INTO izdelek (ime, opis, cena, model, barva) "
                        . " VALUES (:ime, :opis, :cena, :model, :barva)", $params);
    }

    public static function update(array $params) {
        return parent::modify("UPDATE izdelek SET ime = :ime, opis = :opis, "
                        . "cena = :cena, model = :model, barva = :barva"
                        . " WHERE id = :id", $params);
    }

    public static function delete(array $id) {
        return parent::modify("DELETE FROM izdelek WHERE id = :id", $id);
    }

    public static function get(array $id) {
        $izdelek = parent::query("SELECT id, ime, opis, cena, model, barva"
                        . " FROM izdelek"
                        . " WHERE id = :id", $id);
        
        if (count($izdelek) == 1) {
            return $izdelek[0];
        } else {
            throw new InvalidArgumentException("Izdelek ne obstaja");
        }
    }

    public static function getAll() {
        return parent::query("SELECT id, ime, opis, cena, model, barva"
                        . " FROM izdelek"
                        . " ORDER BY id ASC");
    }

public static function getForIds($ids) {
        $db = DBInit::getInstance();

        $id_placeholders = implode(",", array_fill(0, count($ids), "?"));

        $statement = $db->prepare("SELECT id, ime, opis, cena, model, barva FROM izdelek 
            WHERE id IN (" . $id_placeholders . ")");
        $statement->execute($ids);

        return $statement->fetchAll();
    }
}

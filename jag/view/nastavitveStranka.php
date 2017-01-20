<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Nastavitve</title>
</head>

<?php 
require_once 'view/NastavitveForm.php';
require_once 'model/OsebaDB.php';


$form = new AdminForm('spremeniPodatke');

?>
  <body>
    <?php
    if ($form->validate()) {
        try {
            $data = $form->getValue();
            OsebaDB::updateStranka($_SESSION["user"]["id"], $data['ime'], $data['priimek'], $data['email'], $data['geslo'], $data['naslov']);
            ViewHelper::redirect(BASE_URL . "izdelki/");
        
        } catch (PDOException $exc) {
            echo "Napaka pri posodabljanju.";
            var_dump($exc);
        }
    } else {
        echo $form;
    }


include("view/noga2.php"); 

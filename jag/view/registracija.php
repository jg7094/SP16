<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'view/AdminForm.php';
require_once 'model/OsebaDB.php';

#$url = basename(__FILE__);
include("view/glava.php");
$form = new AdminForm('registracija');
?>
<!doctype html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Registracija novega uporabnika</title>
</head>
<body>
    <?php
    if ($form->validate()) {
        try {
            $data = $form->getValue();
            OsebaDB::dodaj($data['ime'], $data['priimek'], $data['email'], $data['geslo'], $data['naslov']);
            ViewHelper::redirect(BASE_URL . "izdelki/");
        
        } catch (PDOException $exc) {
            echo "Napaka pri registraciji.";
            var_dump($exc);
        }
    } else {
        echo $form;   
           
    }
    ?>
</body>


<?php include("view/noga.php");  ?>
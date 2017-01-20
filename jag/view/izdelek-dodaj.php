
<?php include("view/glava.php");  ?>

<div class="urediizd">
    <h2>Dodaj</h2>
    <form action="<?= BASE_URL . "izdelki/dodaj" ?>" method="post">
        <p><label>Ime: <input type="text" name="ime" value="<?= $ime ?>" autofocus /></label></p>
        <p><label>Model: <input type="text" name="model" value="<?= $model ?>" /></label></p>
        <p><label>Barva: <input type="text" name="barva" value="<?= $barva ?>" /></label></p>
        <p><label>Opis izdelka: <br/><textarea name="opis" cols="70" rows="10"><?= $opis ?></textarea></label></p>
        <p><label>Cena: <input type="number" name="cena" value="<?= $cena ?>" /> €</label></p> 
        <p><button>Vstavi</button></p>
    </form>
    
</div>
    
<?php include("view/noga2.php");  ?>
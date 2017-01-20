
<?php include("view/glava.php");  ?>

<div class="urediizd">
    <h2>Uredi</h2>
    <form action="<?= BASE_URL . "izdelki/uredi/" . $id ?>" method="post">
        <input type="hidden" name="id" value="<?= $id ?>"  />
        <p><label>Ime: <input type="text" name="ime" value="<?= $ime ?>" autofocus /></label></p>
        <p><label>Model: <input type="text" name="model" value="<?= $model ?>" /></label></p>
        <p><label>Barva: <input type="text" name="barva" value="<?= $barva ?>" /></label></p>
        <p><label>Opis: <textarea name="opis" cols="70" rows="10"/><?= $opis ?></textarea></p>
        <p><label>Cena: <br/><input  type="number" name="cena" value="<?= $cena ?>" > €</label></p>
        <p><button>Posodobi</button></p>
    </form>

    <form action="<?= BASE_URL . "izdelki/zbrisi/" . $id ?>" method="post">
        <label>Briši? <input type="checkbox" name="delete_confirmation" /></label>
        <button type="submit" class="important">Zbrisi</button>
    </form>
</div>
<?php include("view/noga2.php");  ?>
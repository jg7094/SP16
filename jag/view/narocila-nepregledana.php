<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Naročila</title>

<?php include("view/glava.php");  ?>

<div class="urediizd">

<?php $prevjsnjeNarocilo=""; foreach ($seznam as $vrstica): ?>
    
    <div class="narocilo">
        <?php if($prevjsnjeNarocilo != $vrstica["idnarocilo"]): ?>
            <hr>
            
            <form action="<?= BASE_URL . "narocila/potrdi/" . $vrstica["idnarocilo"]["id"]?>" method="post">
                <p><button>Izdelki poslani</button></p>
            </form>
            <div class="">
                <p>Uporabnik: <?= $vrstica["idnarocilo"]["idstranka"]["email"] ?> </p>
                <p>Naslovnik: </p>
                <div class="nslv">
                    <p> <?= $vrstica["idnarocilo"]["idstranka"]["ime"] ?> <?= $vrstica["idnarocilo"]["idstranka"]["priimek"] ?> </p>
                    <p> <?= $vrstica["idnarocilo"]["idstranka"]["naslov"] ?> </p>
                </div>
            </div>
            <p> Skupna cena: <?= $vrstica["idnarocilo"]["total"] ?> € </p>
            <p>Izdelki:</p>
            
        <?php endif; ?>
        
        <p>
            <?= $vrstica["quantity"] ?> &times; <?= $vrstica["idizdelek"]["ime"] ?> ( <?= $vrstica["idizdelek"]["cena"] ?> € ) ->
            <?= $vrstica["idizdelek"]["opis"] ?>
        </p>
        
    <?php $prevjsnjeNarocilo = $vrstica["idnarocilo"] ?>
    </div>
    
<?php endforeach; ?>
    
</div>
	</body>
</html>
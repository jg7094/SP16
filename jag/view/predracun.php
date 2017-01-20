
<?php include("view/glava.php");  ?>

<div class="prva">
                <?php #if (!empty($vozicek)): ?>
			<div class="kosara">
                            <h2>Izdelki v košari</h2>
                            <?php foreach ($vozicek as $izdelek): ?>
                                <hr>
				<p>
                                    <span name="id" hidden ><?= $izdelek["id"] ?> </span>
                                    <span name="quantity" ><?= $izdelek["quantity"] ?> &times; <?= $izdelek["ime"] ?>  </span> 
                                </p>
                                <p>
                                    <span name="opis" ><?= $izdelek["opis"] ?> </span>
                                </p>
                                
                            <?php endforeach; ?>
                            <hr>
                            <p>Skupaj: <label class="cena2"> <?= number_format($total, 2) ?> EUR</label></p>
			</div>
			
			<div class="kosara">
                                <h2>Podatki naslovnika</h2>
				<form class="article-comment" action="<?= BASE_URL . "trgovina/uspesen-nakup" ?>" method="post">
                                        <label class="dta">Email: </label> <label class="dtalev"><?= Oseba::getElektronski() ?></label> 
                                        <label class="dta">Ime in priimek: </label><label class="dtalev"><?= Oseba::getUsername() ?></label> 
					<label class="dta">Naslov: </label><label class="dtalev"><?= Oseba::getNaslov() ?></label> 
					<span>
						<label id="gmb" > <input class="gumbek2" type="submit" value="Potrdi nakup"></label>
					</span>
				</form>
			</div>
                    <?php #endif; ?>
		</div>



<?php include("view/noga2.php");  ?>


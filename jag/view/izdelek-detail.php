
<?php include("view/glava.php");  ?>


<div id="main" class="prva">
			<div class="oiz">
			<div class="slika">
				<img src="<?= IMAGES_URL . "aggestrup.jpg" ?>" alt="slika izdelka" />
			</div>
			<div class="izdelek">
				<h1><?= $ime ?></h1>
				<form class="izbira" method="POST" action="#">
                                        <p><label>Model: </label><span><?= $model ?></span></p>
					<p><label>Barva: </label>
					<input type="color" name="favcolor" value="<?= $barva ?>"></p>
					<p><label>Količina: </label>
					<input id="quantity" type="number" name="quantity" min="1" max="42" value="1" oninput="racunaj()"></p>
					<p><label>Cena: </label>
					<span class="price"><span id="cena"><?= $cena ?></span> €</span></p>
					<!--button type="button" onclick="dodajvkosaro()">Kupi</button-->
				</form>
				<div class="opis">
					<h2> Opis </h2>
                                        <p><?= $opis ?></p>
				</div>
                                <?php if (Oseba::isAdmin()): ?>
                                    <p>
                                    <form action="<?= BASE_URL . "izdelki/uredi/" . $id ?>">
                                        <input class="admingmb" type="submit" value="Uredi" />
                                    </form>
                                    </p>
                                <?php endif; ?>
				<!--div class="opis">
					<h2> Komentarji </h2>
					<span  id="novkomentar">
						<p>Z izdelkom sem zelo zadovoljen</p>
					</span>
					<div class="dodajkoment">
						<button onclick="dodajkomentar()">+ Dodaj komentar +</button>
						<div><textarea id="novvnos" rows="4" cols="50"></textarea></div>
					</div>
				</div-->
			</div>
			</div>
		</div>




<?php include("view/noga.php");  ?>

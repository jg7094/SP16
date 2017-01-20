
<?php include("view/glava.php");  ?>

                <div id="main">
			<nav>
				<form>
					<p><h3>Model</h3>
						<input type="checkbox" name="pisarniskis" value="item1" checked> Pisarniški stoli<br/>
						<input type="checkbox" name="pifarniskis" value="item2" checked> Pisarniški fotelji<br/>
						<input type="checkbox" name="konferencni" value="item3" checked> Konferenčni stoli<br/>
						<input type="checkbox" name="jedilnice" value="item4" checked> Stoli za jedilnice<br/>
						<input type="checkbox" name="oblazinjeno" value="item5" checked> Oblazinjeno pohištvo<br/>
					</p>
					<p><h3>Barva</h3>
						<input type="color" name="favcolor" value="#0000ff"></br>
					</p>
					<p><h3>Cena</h3>
						<label>Od:</label><input class="cena" type="number" name="minCena" min="0" max="999" value="0"> €
						<label>Do:</label><input class="cena" type="number" name="maxCena" min="1" max="1000" value="1000"> €
					</p>
				</form>
			</nav>
			<div class="sect">
				<!--div class="kategorije">
					<ul>
						<li><a href="#">Pisarniški stoli</a></li> 
						<li><a href="#">Pisarniški fotelji</a></li> 
						<li><a href="#">Konferenčni stoli</a></li> 
						<li><a href="#">Stoli za jedilnice</a></li> 
						<li><a href="#">Oblazinjeno pohištvo</a></li>
					</ul>
				</div-->
				<article>
                                    <?php foreach ($izdelki as $izdelek): ?>
					<div class="item-grid">
                                            <form action="<?= BASE_URL . "trgovina/add-to-vozicek" ?>" method="post" />
                                            <input type="hidden" name="id" value="<?= $izdelek["id"] ?>" />
						<h2><?= $izdelek["ime"] ?></h2>
						<a><img src="<?= IMAGES_URL . "aggestrup.jpg" ?>" alt="slika izdelka" /></a>
						<h4><?= $izdelek["opis"] ?></h4>
						<div class="item-do">
							<!--span id="komentar">
								<img src ="./img/comment.png" alt="komentar" onmouseover="pokazi komentarje"/>
								<span id="popup" class="skrit">z izdelkom sem zelo zadovoljen</span>
							</span>
							<button type="button" onclick="dodajizdelek()">Kupi</button-->
							<button>Kupi</button>
                                                        <label class="cena"><?= number_format($izdelek["cena"], 2) ?> €</label>
                                                        
						</div>
                                            </form>
					</div>
                                    <?php endforeach; ?>
				</article>
			</div>
		</div>




<?php if (!empty($vozicek)): ?>

    <div id="vozicek2">
        <h3>Nakupovalni vozicek</h3>
        <?php foreach ($vozicek as $izdelek): ?>

            <form action="<?= BASE_URL . "trgovina/update-vozicek" ?>" method="post">
                <input type="hidden" name="id" value="<?= $izdelek["id"] ?>" />
                <input type="number" name="quantity" value="<?= $izdelek["quantity"] ?>" class="update-cart" />
                &times; <?= $izdelek["ime"] ?> 
                <button>Posodobi</button> 
            </form>

        <?php endforeach; ?>

        <p>Skupno: <b><?= number_format($total, 2) ?> EUR</b></p>

        <form action="<?= BASE_URL . "trgovina/purge-vozicek" ?>" method="post">
            <p><button>Izprazni voziček</button></p>
        </form>
        <form action="<?= BASE_URL . "trgovina/kupi-vozicek" ?>" method="post">
            <p><button>Naprej na nakup</button></p>
        </form>
    </div>    

<?php endif; ?>

<?php include("view/noga2.php");  ?>



<?php include("view/glava.php");  ?>

            <div id="main">
			<noscript>TA STRAN NE DELUJE PRAVILNO BREZ UPORABE JAVASCRIP</noscript>
			<div class="prva">
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
						<h2><?= $izdelek["ime"] ?></h2>
						<a href="<?= BASE_URL . "izdelki/" . $izdelek["id"] ?>"><img src="<?= IMAGES_URL . "aggestrup.jpg" ?>" alt="slika izdelka" /></a>
						<h4><?= $izdelek["opis"] ?></h4>
						<div >
							<!--span id="komentar">
								<img src ="./img/comment.png" alt="komentar" onmouseover="pokazi komentarje"/>
								<span id="popup" class="skrit">z izdelkom sem zelo zadovoljen</span>
							</span>
						
							<button type="button" onclick="dodajizdelek()">Kupi</button-->
							<label class="cena2"><?= $izdelek["cena"] ?> €</label>
						</div>
					</div>
                                    <?php endforeach; ?>
				</article>
			</div>
		</div>

<?php include("view/noga.php");  ?>

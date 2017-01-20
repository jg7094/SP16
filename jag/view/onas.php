<?php include("view/glava.php");  ?>

		<div id="main" class="prva">
			<div class="podatki">
				<div class="inf">
					<h1>Sedež podjetja</h1>
					<h3>Storžiška 6, 4000 Kranj</h3>
					<h1>Telefon</h1>
					<h3>040420420</h3>
					<h1>Email</h1>
					<h3>info@jag.si</h3>
					<h1>Davčna</h1>
					<h3>0756234065463</h3>
					<h1>TRR</h1>
					<h3>SI56 4205 9386 0174 927</h3>
					<h1>Ažurna pomoč</h1>
					<h3>"video pogovor"</h3>
				</div>
				<div class="zemljevid">
					<h1>Kako do nas</h1>
					<button id="map" onclick="getLocation()">Pokaži pot</button>
					<div id="maps">
						<img src="<?= IMAGES_URL . "map.jpg" ?>" />
					</div>
				</div>
			</div>
		</div>
		
<?php include("view/noga.php");  ?>


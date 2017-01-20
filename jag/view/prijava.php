<?php include("view/glava.php");  ?>

                <div class="prva">
			<div class="login">
				<form class="article-comment" method="post" action="<?= BASE_URL . $formAction ?>">
                                        <?php if (!empty($errorMessage)): ?>
                                            <p class="important"><?= $errorMessage ?></p>
                                        <?php endif; ?>
					<label>Email: </label> <input type="email" title="vpiši veljaven email naslov" name="email" autocomplete="off" required autofocus />
					<label>Geslo: </label> <input type="password" name="geslo" placeholder="geslo" pattern=".{6,}" title="6 ali več znakov" required />
					<label><input class="gumbek" type="submit" value="Prijava" /></label>
				</form>
			</div>

		</div>


<?php include("view/noga2.php");  ?>
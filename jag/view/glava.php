<!DOCTYPE html>
<html>
	<head>
		<title>JAG</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
		<script type="text/javascript" src="<?= JS_URL . "javascript.js" ?>" defer></script>
	</head>
        <body>
                <header>
			<div class="centered-content">
				<div class="meniji">
				<ul>
					<li><img src="<?= IMAGES_URL . "logo.svg" ?>" alt="Logotip" /></li>
					<span class="resp">
						
						<li><a href="<?= BASE_URL . "izdelki" ?>">Domov</a></li>
						<li><a href="<?= BASE_URL . "o-nas" ?>">O nas</a></li>
						
                                                <?php if (Oseba::isLoggedIn()): ?>
                                                <li><a class="desna-stran" href="<?= BASE_URL . "odjava" ?>">Odjava <?php if (!Oseba::isAdmin()): ?>(<?= Oseba::getUsername() ?>)<?php endif; ?></a></li>
    
                                                <?php if (Oseba::isAdmin()): ?>
                                                    <li><a href="<?= BASE_URL . "izdelki/dodaj/" ?>">Dodaj izdelek</a></li>
                                                    <li><a class="desna-stran" href="<?= BASE_URL . "narocila" ?>">Naročila</a></li>
                                                <li><?php else: ?>
                                                    <a href="<?= BASE_URL . "trgovina" ?>">Trgovina</a>
                                                <?php endif; ?></li>
                                                <?php else: ?>
                                                    <li><a class="desna-stran" href="<?= BASE_URL . "registracija" ?>">Registracija</a></li>
                                                    <li><a class="desna-stran" href="<?= BASE_URL . "prijava" ?>">Prijava</a></li>
                                                <?php endif; ?>	
					</span>
					<li><a id="icon" href="javascript:void(0);" onclick="odpriMeni()">&#9776;</a></li>
					<li><span class="isci">Išči <input type="text"></span></li>
					</ul>
				</div>
			</div>
		</header>
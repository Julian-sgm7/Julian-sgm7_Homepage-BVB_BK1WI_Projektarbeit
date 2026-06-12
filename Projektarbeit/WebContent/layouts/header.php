<!DOCTYPE html>
<html lang="de">

<?php include 'head.php'; ?>

<body>
	<header>
		<div class="header-top">
			<img class="logo" src="../img/BVB_Logo.png" alt="Logo" width="85" height="73">
			<h1><?php echo $titel; ?></h1>
		</div>
		<nav>
			<div class="nav-box">
				<a href="shop.php">Shop</a>
				<span class="divider">|</span>
				<a href="tickets.php">Tickets</a>
				<span class="divider">|</span>
				<a href="mannschaften.php">Mannschaften</a>
				<span class="divider">|</span>
				<a href="warenkorb.php">Warenkorb</a>
				<span class="divider">|</span>
				<a href="service.php">Service</a>
				<div class="search-container">
					<div class="search-wrapper">
						<input type="text" class="search-input" placeholder="Suchen..." autocomplete="off">
						<span class="search-icon">🔍</span>
						<button class="search-clear" title="Löschen">✕</button>
						<div class="search-results"></div>
					</div>
				</div>
				<a href="../index.php">
				<img src="../img/Home_Zeichen.png" alt="Home" width="70" height="50">
				</a>
			</div>
		</nav>
	</header>
<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>BVB-Homepage</title>
	<link rel="stylesheet" href="css/styles.css">
</head>

<body>
	<header>
		<div class="header-top">
			<img class="logo" src="img/BVB_Logo.png" alt="Logo" width="85" height="73">
			<h1>BVB-Homepage</h1>
		</div>
		<nav>
			<div class="nav-box">
				<a href="layouts/shop.php">Shop</a>
				<span class="divider">|</span>
				<a href="layouts/tickets.php">Tickets</a>
				<span class="divider">|</span>
				<a href="layouts/mannschaften.php">Mannschaften</a>
				<span class="divider">|</span>
				<a href="layouts/service.php">Service</a>
				<div class="search-container">
					<div class="search-wrapper">
						<input type="text" class="search-input" placeholder="Suchen..." autocomplete="off">
						<span class="search-icon">🔍</span>
						<button class="search-clear" title="Löschen">✕</button>
						<div class="search-results"></div>
					</div>
				</div>
				<a href="index.php"><img src="img/Home_Zeichen.png" alt="Home" width="70" height="50"></a>
			</div>
		</nav>
	</header>

	<main class="homepage">
		<section class="hero">
			<div class="hero-copy">
				<span class="eyebrow">Willkommen beim BVB</span>
				<h2>Der Ballspielverein Borussia 09 e. V. Dortmund</h2>
				<p>Der Ballspielverein Borussia 09 e. V. Dortmund ist ein Sportverein aus Dortmund, der am 19. Dezember 1909 gegründet wurde. Borussia ist der neulateinische Name für Preußen. Seine Fußballsparte nimmt als Hauptsportart die hervorragende Stellung innerhalb des Vereins ein.</p>
				<div class="hero-actions">
					
					<a href="layouts/shop.php" class="button button-primary">Zum Shop</a>
					<a href="layouts/tickets.php" class="button button-secondary">Tickets sichern</a>
				</div>
			</div>
			<div class="hero-panel">
				<div class="home-card">
					<h3>News</h3>
					<p>Jadon Sancho wechselt offiziell zum BVB.</p>
					<img class="news-image" src="img/Sancho_Wechsel.png" alt="Jadon Sancho Wechsel zum BVB" loading="lazy">
				</div>
			</div>
		</section>

		<section class="home-cards home-cards-simple">
			<article class="home-card">
				<h3>Erlebnis</h3>
				<div class="erlebnis-1-img">
					<a href="https://www.bvb.de/de/de/service/erlebnis-bvb.html" target="_blank" rel="noopener">
						<img src="img/Erlebnis.png" alt="Ansicht des Signal Iduna Parks bei einem BVB Erlebnis-Event" loading="lazy">
					</a>
				</div>
			</article>

			<article class="home-card">
				<h3>Nächste BVB Spiele</h3>
				<div class="BVB_Spiele home-games">
					<a href="layouts/tickets.php"><img src="img/BVB_Bayern.png" alt="BVB Bayern"></a>
					<a href="layouts/tickets.php"><img src="img/BVB_Atletiko.png" alt="BVB Atletico"></a>
					<a href="layouts/tickets.php"><img src="img/BVB_Real.png" alt="BVB Real"></a>
					<a href="layouts/tickets.php"><img src="img/St.Pauli_BVB.png" alt="BVB Pauli"></a>
				</div>
			</article>

			<article class="home-card home-membership">
				<h3>Mitgliederschaft</h3>
				<a href="https://www.bvb.de/de/de/der-bvb/der-verein/mitgliedschaft.html" target="_blank" rel="noopener">
					<img src="img/Mitglied.png" alt="Mitgliederschaft">
				</a>
			</article>
		</section>
	</main>

	<footer>
		<p>Service: <a href="layouts/service.php">service@bvb.de</a></p>
		<p>Allgemeine Anfragen: <a href="layouts/service.php">info@bvb.de</a></p>
		<p>Adresse: Rheinlanddamm 207-209, 44137 Dortmund</p>
		<p class="footer-links"><a href="layouts/impressum.php">Impressum</a> | <a href="layouts/gallery.php">Galerie</a></p>
	</footer>

	<script src="js/search.js"></script>
</body>
</html>

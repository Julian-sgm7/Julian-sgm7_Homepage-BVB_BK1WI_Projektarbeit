<?php 
$titel = "BVB Tickets";
include 'head.php';
include 'header.php';
require_once __DIR__ . '/../controller/RechnerController.php';
$controller = new RechnerController();
$meldung = $controller->handleRequest();
?>

<main>
	<h2>Tickets: BVB Spiele</h2>
	<div class="Tickets">
		<div class="Ticket">
			<img src="../img/BVB_Bayern.png" alt="BVB vs Bayern" class="Ticket-Bild">
			<h3>BVB vs Bayern M&uuml;nchen</h3>
			<p>Datum: 03.08.2019</p>
			<p>Ort: Signal Iduna Park</p>
			<button type="button" onclick="waehleSpiel('BVB vs Bayern M&uuml;nchen')">Ausw&auml;hlen</button>
		</div>

		<div class="Ticket">
			<img src="../img/BVB_Real.png" alt="BVB vs Real" class="Ticket-Bild">
			<h3>BVB vs Real Madrid</h3>
			<p>Datum: 01.06.2024</p>
			<p>Ort: Signal Iduna Park</p>
			<button type="button" onclick="waehleSpiel('BVB vs Real Madrid')">Ausw&auml;hlen</button>
		</div>
		
		<div class="Ticket">
			<img src="../img/St.Pauli_BVB.png" alt="BVB vs St. Pauli" class="Ticket-Bild">
			<h3>BVB vs St. Pauli</h3>
			<p>Datum: 06.11.2025</p>
			<p>Ort: Millerntor-Stadion</p>
			<button type="button" onclick="waehleSpiel('BVB vs St. Pauli')">Ausw&auml;hlen</button>
		</div>
		
		<div class="Ticket">
			<img src="../img/BVB_Atletiko.png" alt="BVB vs Atletico" class="Ticket-Bild">
			<h3>BVB vs Atletico Madrid</h3>
			<p>Datum: 16.04.2024</p>
			<p>Ort: Signal Iduna Park</p>
			<button type="button" onclick="waehleSpiel('BVB vs Atletico Madrid')">Ausw&auml;hlen</button>
		</div>
	</div>

<?php include '../view/RechnerView.php'; ?>
</main>

<script>
function waehleSpiel(name) {
    // Setzt den Wert in das schreibgeschützte Input-Feld
    document.getElementById('spiel_input').value = name;
    
    // Scrollt sanft zum Formular
    document.getElementById('buchung').scrollIntoView({ behavior: 'smooth' });
}
</script>

<?php include 'footer.php'; ?>
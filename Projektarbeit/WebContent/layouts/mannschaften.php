<?php
$titel = "BVB Mannschaften";
include 'head.php';
include 'header.php';
?>
	
<main>
	<h2 class="titel-mannschaften">Unsere Mannschaften</h2> 
    <div class="mannschafts-grid">
        <div class="team-box">
            <div class="bild-container">
                <img src="../img/Profimannschaft.png" alt="Profimannschaft">
            </div>
            <div class="text-inhalt">
                <h3>Profis</h3>
                <p>Die erste Mannschaft von Borussia Dortmund.</p>
                <a href="#" class="button">Mehr Infos</a>
            </div>
        </div>

        <div class="team-box">
            <div class="bild-container">
                <img src="../img/2.Mannschaft.png" alt="U23">
            </div>
            <div class="text-inhalt">
                <h3>U23</h3>
                <p>Die zweite Mannschaft des BVB.</p>
                <a href="#" class="button">Mehr Infos</a>
            </div>
        </div>
        
        <div class="team-box">
            <div class="bild-container">
                <img src="../img/u19.png" alt="U19">
            </div>
            <div class="text-inhalt">
                <h3>U19</h3>
                <p>Die Nachwuchsmannschaft des BVB.</p>
                <a href="#" class="button">Mehr Infos</a>
            </div>
        </div>
        
        <div class="team-box">
            <div class="bild-container">
                <img src="../img/frauen.png" alt="Frauen">
            </div>
            <div class="text-inhalt">
                <h3>Frauen</h3>
                <p>Die Frauenmannschaft von Borussia Dortmund.</p>
                <a href="#" class="button">Mehr Infos</a>
            </div>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>
<?php
$titel = "BVB Service";
include 'head.php';
include 'header.php';
?>

    <main>
        <div class="info">
            <h2>H&auml;ufige Fragen & Kontakt</h2>
            <p>Hast du Fragen zu deiner Mitgliedschaft, deinem Ticket oder deiner Bestellung im Shop? Unser Service-Team hilft dir gerne weiter.</p>
        </div>

        <div class="mannschafts-grid2">
            <div class="team-box">
                <div class="text-inhalt">
                    <h3>FAQ - H&auml;ufige Fragen</h3>
                    <p><strong>Wie erreiche ich das Ticketing?</strong><br>
                    Die Hotline ist Mo-Fr von 08:00 - 17:00 Uhr erreichbar.</p>
                    <p><strong>Versand im Shop?</strong><br>
                    Die Lieferzeit betr&auml;gt aktuell ca. 3-5 Werktage.</p>
                    <a href="#" class="button">Mehr Fragen</a>
                </div>
            </div>

            <div class="team-box">
			    <div class="text-inhalt">
			        <h3>Kontaktformular</h3>
			        <form action="#" class="service-form">
			            <input type="text" placeholder="Dein Name" required>
			            <input type="email" placeholder="Deine E-Mail" required>
			            <select>			              
			                <option>Mitgliedschaft</option>
			                <option>Tickets</option>
			                <option>Fanshop</option>
			                <option>Sonstiges</option>
			            </select>
			            <textarea placeholder="Deine Nachricht" rows="4"></textarea>
			            <button type="submit" class="submit-button">Anfrage senden</button>
			        </form>
			    </div>
			</div>
        </div>

        <section class="erlebnis">
        	<h2 class="text-center">Anfahrt zum Signal Iduna Park</h2>
			    <div class="erlebnis-img">
        		<img src="../img/Stadionadresse.png" alt="Anfahrt Stadion">
    			</div>
		</section>
    </main>

<?php include 'footer.php'; ?>
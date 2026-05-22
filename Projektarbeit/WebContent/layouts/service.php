<?php
$titel = "BVB Service";
include 'head.php';
include 'header.php';
?>

    <main>
        <div class="service-hero">
            <h2>Dein direkter Draht zum BVB-Service</h2>
            <p>Services so stark wie der BVB – schneller Support, smarte Hilfe und echtes Fan-Feeling.</p>
            <div class="service-highlights">
                <article>
                    <h3>Blitzschnelle Hilfe</h3>
                    <p>Fragen rund um Tickets, Mitgliedschaft und Fanartikel werden bei uns priorisiert beantwortet.</p>
                </article>
                <article>
                    <h3>Stadion-Guide</h3>
                    <p>Alles zur Anreise, zum Einlass und zum besten Erlebnis im Signal Iduna Park.</p>
                </article>
                <article>
                    <h3>VIP-Support</h3>
                    <p>Persönlicher Service für deinen perfekten Spieltag und deine Bestellungen.</p>
                </article>
            </div>
        </div>

        <div class="mannschafts-grid2">
            <div class="team-box service-card">
                <div class="text-inhalt">
                    <h3>FAQ - Schnell Antworten</h3>
                    <p><strong>Wie erreiche ich das Ticketing?</strong><br>
                    Die Hotline ist Mo–Fr von 08:00–17:00 Uhr erreichbar.</p>
                    <p><strong>Versand im Shop?</strong><br>
                    Die Lieferzeit beträgt aktuell ca. 3–5 Werktage.</p>
                    <ul class="service-list">
                        <li>Ticket-Infos, Mitgliedschaft & Shop</li>
                        <li>Extras, Rückfragen & Stadiontipps</li>
                        <li>Schnelle Antworten im BVB-Stil</li>
                    </ul>
                    <a href="#" class="button">Mehr Fragen</a>
                </div>
            </div>

            <div class="team-box service-card">
                <div class="text-inhalt">
                    <h3>Kontaktiere uns</h3>
                    <p>Schreib uns kurz – wir leiten deine Anfrage direkt weiter und melden uns schnell zurück.</p>
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
                    <p class="service-note">Unser Team prüft deine Nachricht sofort nach Eingang.</p>
                </div>
            </div>
        </div>

        <section class="erlebnis">
            <div class="erlebnis-text">
                <h2 class="text-center">Anfahrt zum Signal Iduna Park</h2>
                <p>So findest du deinen Weg zum Stadion im Fan-Tempo: Schnell, sicher und mit allen wichtigen Hinweisen für den perfekten Spieltag.</p>
            </div>
            <div class="erlebnis-img">
                <img src="../img/Stadionadresse.png" alt="Anfahrt Stadion">
            </div>
        </section>
    </main>

<?php include 'footer.php'; ?>

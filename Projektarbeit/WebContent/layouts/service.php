<?php
$titel = "BVB Service";
include 'head.php';
include 'header.php';
?>

    <main>
        <section class="service-simple">
            <div class="service-box">
                <div class="service-copy">
                    <h2>Kontaktiere uns</h2>
                    <p>Schreib uns kurz – wir beantworten deine Anfrage schnell.</p>

                    <form action="#" class="service-form">
                        <input type="text" placeholder="Dein Name" required>
                        <input type="email" placeholder="Deine E-Mail" required>
                        <select>
                            <option>Mitgliedschaft</option>
                            <option>Tickets</option>
                            <option>Fanshop</option>
                            <option>Sonstiges</option>
                        </select>
                        <textarea placeholder="Deine Nachricht" rows="5" required></textarea>
                        <button type="submit" class="submit-button">Anfrage senden</button>
                    </form>
                </div>

                <div class="service-image-box">
                    <img src="../img/Stadionadresse.png" alt="Anfahrt zum Signal Iduna Park">
                </div>
            </div>
        </section>
    </main>

<?php include 'footer.php'; ?>

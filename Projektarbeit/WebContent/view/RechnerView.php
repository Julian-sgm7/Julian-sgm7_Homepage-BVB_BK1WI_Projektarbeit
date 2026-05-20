<section class="ticket-formular" id="buchung">
    <h2>Ticket buchen</h2>
    
    <form method="post" action="#buchung">
        <label>Vorname </label><br>
        <input type="text" name="vorname" required><br><br>
        
        <label>Name </label><br>
        <input type="text" name="name" required><br><br>

        <label>Ausgew&auml;hltes Spiel </label><br>
        <input type="text" id="spiel_input" name="spiel" readonly placeholder="Bitte oben ein Spiel wählen" required class="spiel-input"><br><br>

        <label>Anzahl der Tickets </label><br>
        <input type="number" name="anzahl" min="1" max="10" required><br><br>

        <label> Gew&uuml;nschter Block </label><br>
        <select name="block">
            <option>Block A</option>
            <option>Block B</option>
            <option>Block C</option>
            <option>Block D</option>
            <option>Block E</option>
            <option>Block F</option>
            <option>Familien Block G</option>
            <option>VIP Block</option>
        </select>
        <br><br>

        <button type="submit" name="berechnen">Summe berechnen</button>
    </form>

    <?php if (!empty($meldung)): ?>
        <div class="ergebnis-text ergebnis-detail">
            <p><?php echo $meldung; ?></p>
            
            <button type="button" onclick="ticketKaufen()" class="btn-kaufen">
                Tickets jetzt kaufen
            </button>
        </div>
    <?php endif; ?>
</section>

<script>
function ticketKaufen() {
    // Diese Funktion ersetzt den Inhalt der Section mit der Erfolgsmeldung
    document.querySelector('.ticket-formular').innerHTML = "<h2>Vielen Dank!</h2><p>Deine Buchung war erfolgreich. Wir freuen uns auf dich!</p>";
}
</script>
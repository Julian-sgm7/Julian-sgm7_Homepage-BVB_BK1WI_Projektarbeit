<?php
require_once __DIR__ . '/../model/RechnerModel.php';

class RechnerController {
    
    /**
     * @return string Die Erfolgsmeldung oder Fehlermeldung
     */
    public function handleRequest() {
        $meldung = "";

        /* Prüfen, ob der "Summe berechnen"-Knopf im Formular gedrückt wurde */
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["berechnen"])) {
            $model = new RechnerModel();
            
            /* Formulardaten sicher abspeichern und Text-Sonderzeichen unschädlich machen */
            $vorname = htmlspecialchars($_POST["vorname"] ?? "");
            $name    = htmlspecialchars($_POST["name"] ?? "");
            $anzahl  = intval($_POST["anzahl"] ?? 0);
            $block   = $_POST["block"] ?? "";
            $spiel   = $_POST["spiel"] ?? "";

            /* Prüfen, ob mindestens 1 Ticket bestellt wurde */
            if ($anzahl > 0) {
                /* Gesamtpreis berechnen lassen */
                $gesamtpreis = $model->berechneGesamtpreis($anzahl, $block);
                /* Die fertige Nachricht für die Webseite zusammenbauen */
                $meldung = "<strong>Spiel:</strong> $spiel<br>" . 
                           $model->generiereMeldung($vorname, $name, $anzahl, $block, $gesamtpreis);
                           
            /* Fehlermeldung, falls 0 oder weniger Tickets eingegeben wurden */
            } else {
                $meldung = "Bitte gib eine gültige Anzahl an Tickets ein.";
            }
        }
        /* Gibt die Nachricht (Erfolg oder Fehler) zurück */
        return $meldung;
    }
}
<?php
require_once __DIR__ . '/../model/RechnerModel.php';

class RechnerController {
    
    /**
     * Verarbeitet die POST-Anfrage vom Formular
     * @return string Die Erfolgsmeldung oder Fehlermeldung
     */
    public function handleRequest() {
        $meldung = "";

        // Prüfen, ob der Button "berechnen" im Formular gedrückt wurde
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["berechnen"])) {
            $model = new RechnerModel();
            
            // Daten sicher aus dem POST-Array holen
            $vorname = htmlspecialchars($_POST["vorname"] ?? "");
            $name    = htmlspecialchars($_POST["name"] ?? "");
            $anzahl  = intval($_POST["anzahl"] ?? 0);
            $block   = $_POST["block"] ?? "";
            $spiel   = $_POST["spiel"] ?? "";

            if ($anzahl > 0) {
                $gesamtpreis = $model->berechneGesamtpreis($anzahl, $block);
                $meldung = "<strong>Spiel:</strong> $spiel<br>" . 
                           $model->generiereMeldung($vorname, $name, $anzahl, $block, $gesamtpreis);
            } else {
                $meldung = "Bitte gib eine gültige Anzahl an Tickets ein.";
            }
        }
        return $meldung;
    }
}
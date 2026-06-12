<?php

class RechnerModel {
    /* Festlegen der Ticket-Preise für die verschiedenen Blöcke */
    private $standard_preis = 50;
    private $familien_preis = 40;
    private $vip_preis = 250;

    /* Funktion, die den Preis basierend auf dem gewählten Block berechnet */
    public function berechneGesamtpreis($anzahl, $block) {
        $preis = $this->standard_preis;
        /* Prüfen, ob es sich um den Familien-Block handelt */
        if (strpos($block, 'Familien') !== false) {
            $preis = $this->familien_preis;
        /* Prüfen, ob es sich um den VIP-Block handelt */
        } elseif (strpos($block, 'VIP') !== false) {
            $preis = $this->vip_preis;
        }
        /* Endpreis ausrechnen: Menge mal Ticketpreis */
        return $anzahl * $preis;
    }
    
    public function generiereMeldung($vorname, $name, $anzahl, $block, $gesamtpreis) {
    	return "Hallo $vorname $name, du hast $anzahl Ticket(s) f&uuml;r den $block zum Spiel f&uuml;r einen Gesamtpreis von $gesamtpreis &euro; gew&auml;hlt. <br>";
	}
}
<?php

class RechnerModel {
    private $standard_preis = 50;
    private $familien_preis = 40;
    private $vip_preis = 250;

    public function berechneGesamtpreis($anzahl, $block) {
        $preis = $this->standard_preis;
        if (strpos($block, 'Familien') !== false) {
            $preis = $this->familien_preis;
        } elseif (strpos($block, 'VIP') !== false) {
            $preis = $this->vip_preis;
        }
        return $anzahl * $preis;
    }
    
    public function generiereMeldung($vorname, $name, $anzahl, $block, $gesamtpreis) {
    	return "Hallo $vorname $name, du hast $anzahl Ticket(s) f&uuml;r den $block zum Spiel f&uuml;r einen Gesamtpreis von $gesamtpreis &euro; gew&auml;hlt. <br>";
	}
}
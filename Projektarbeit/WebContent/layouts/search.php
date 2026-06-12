<?php
header('Content-Type: application/json; charset=utf-8');

// Beispiel-Inhalte durchsuchen
$searchables = [
    // Shop-Items
    ['type' => 'shop', 'name' => 'BVB Trikot Heim', 'link' => 'shop.php', 'icon' => '👕'],
    ['type' => 'shop', 'name' => 'BVB Trikot Auswärts', 'link' => 'shop.php', 'icon' => '👕'],
    ['type' => 'shop', 'name' => 'BVB Schal', 'link' => 'shop.php', 'icon' => '🧣'],
    ['type' => 'shop', 'name' => 'BVB Kappe', 'link' => 'shop.php', 'icon' => '🧢'],
    ['type' => 'shop', 'name' => 'BVB Hoodie', 'link' => 'shop.php', 'icon' => '🧥'],
    ['type' => 'shop', 'name' => 'BVB Mütze', 'link' => 'shop.php', 'icon' => '🧢'],
    ['type' => 'shop', 'name' => 'BVB Kissen', 'link' => 'shop.php', 'icon' => '🛋️'],
    ['type' => 'shop', 'name' => 'BVB Fußball', 'link' => 'shop.php', 'icon' => '⚽'],
    ['type' => 'shop', 'name' => 'BVB Fanartikel', 'link' => 'shop.php', 'icon' => '🎫'],
    ['type' => 'shop', 'name' => 'Shop', 'link' => 'shop.php', 'icon' => '🛒'],
    
    // Tickets
    ['type' => 'tickets', 'name' => 'Tickets für Bayern vs BVB', 'link' => 'tickets.php', 'icon' => '🎫'],
    ['type' => 'tickets', 'name' => 'Tickets für BVB vs Atletico', 'link' => 'tickets.php', 'icon' => '🎫'],
    ['type' => 'tickets', 'name' => 'Tickets für BVB vs Real Madrid', 'link' => 'tickets.php', 'icon' => '🎫'],
    ['type' => 'tickets', 'name' => 'Tickets für St. Pauli vs BVB', 'link' => 'tickets.php', 'icon' => '🎫'],
    ['type' => 'tickets', 'name' => 'Tickets', 'link' => 'tickets.php', 'icon' => '🎫'],
    ['type' => 'tickets', 'name' => 'Spiele', 'link' => 'tickets.php', 'icon' => '⚽'],
    
    // Teams / Spieler
    ['type' => 'team', 'name' => 'Jadon Sancho', 'link' => 'mannschaften.php', 'icon' => '⚽'],
    ['type' => 'team', 'name' => 'Marco Reus', 'link' => 'mannschaften.php', 'icon' => '⚽'],
    ['type' => 'team', 'name' => 'Gregor Kobel', 'link' => 'mannschaften.php', 'icon' => '🧤'],
    ['type' => 'team', 'name' => 'Mannschaften', 'link' => 'mannschaften.php', 'icon' => '👥'],
    ['type' => 'team', 'name' => 'Spieler', 'link' => 'mannschaften.php', 'icon' => '⚽'],
    
    // Warenkorb
    ['type' => 'shop', 'name' => 'Warenkorb', 'link' => 'warenkorb.php', 'icon' => '🛒'],
    
    // Sonstiges / Pages
    ['type' => 'page', 'name' => 'Service & Support', 'link' => 'service.php', 'icon' => '📞'],
    ['type' => 'page', 'name' => 'Galerie', 'link' => 'gallery.php', 'icon' => '🖼️'],
    ['type' => 'page', 'name' => 'Impressum', 'link' => 'impressum.php', 'icon' => '📄'],
    ['type' => 'page', 'name' => 'Mitgliedschaft', 'link' => 'https://www.bvb.de', 'icon' => '👥'],
    ['type' => 'page', 'name' => 'BVB Homepage', 'link' => '../index.php', 'icon' => '🏠'],
    ['type' => 'page', 'name' => 'Home', 'link' => '../index.php', 'icon' => '🏠'],
];

// Query abrufen
$query = isset($_GET['q']) ? strtolower(trim($_GET['q'])) : '';

$results = [];

if (strlen($query) >= 1) {
    foreach ($searchables as $item) {
        if (strpos(strtolower($item['name']), $query) !== false) {
            $results[] = $item;
        }
    }
}

// Wenn leer: Alle beliebten Seiten zeigen
if ($query === '') {
    $results = [
        ['type' => 'page', 'name' => 'Shop', 'link' => 'shop.php', 'icon' => '🛒'],
        ['type' => 'page', 'name' => 'Tickets', 'link' => 'tickets.php', 'icon' => '🎫'],
        ['type' => 'page', 'name' => 'Mannschaften', 'link' => 'mannschaften.php', 'icon' => '⚽'],
        ['type' => 'page', 'name' => 'Service', 'link' => 'service.php', 'icon' => '📞'],
        ['type' => 'page', 'name' => 'Galerie', 'link' => 'gallery.php', 'icon' => '🖼️'],
    ];
}

// Ergebnisse sortieren und auf 12 begrenzen
usort($results, function($a, $b) use ($query) {
    if ($query === '') return 0;
    $aPos = strpos(strtolower($a['name']), $query);
    $bPos = strpos(strtolower($b['name']), $query);
    return $aPos - $bPos;
});

$results = array_slice($results, 0, 12);

echo json_encode($results);
?>

<?php
header('Content-Type: application/json; charset=utf-8');

// Beispiel-Inhalte durchsuchen
$searchables = [
    // Shop-Items
    ['type' => 'shop', 'name' => 'BVB Trikot Heim', 'link' => 'layouts/shop.php', 'icon' => '👕'],
    ['type' => 'shop', 'name' => 'BVB Trikot Auswärts', 'link' => 'layouts/shop.php', 'icon' => '👕'],
    ['type' => 'shop', 'name' => 'BVB Schal', 'link' => 'layouts/shop.php', 'icon' => '🧣'],
    ['type' => 'shop', 'name' => 'BVB Kappe', 'link' => 'layouts/shop.php', 'icon' => '🧢'],
    ['type' => 'shop', 'name' => 'BVB Hoodie', 'link' => 'layouts/shop.php', 'icon' => '🧥'],
    ['type' => 'shop', 'name' => 'BVB Mütze', 'link' => 'layouts/shop.php', 'icon' => '🧢'],
    ['type' => 'shop', 'name' => 'BVB Kissen', 'link' => 'layouts/shop.php', 'icon' => '🛋️'],
    ['type' => 'shop', 'name' => 'BVB Fußball', 'link' => 'layouts/shop.php', 'icon' => '⚽'],
    ['type' => 'shop', 'name' => 'BVB Fanartikel', 'link' => 'layouts/shop.php', 'icon' => '🎫'],
    ['type' => 'shop', 'name' => 'Shop', 'link' => 'layouts/shop.php', 'icon' => '🛒'],
    
    // Tickets
    ['type' => 'tickets', 'name' => 'Tickets für Bayern vs BVB', 'link' => 'layouts/tickets.php', 'icon' => '🎫'],
    ['type' => 'tickets', 'name' => 'Tickets für BVB vs Atletico', 'link' => 'layouts/tickets.php', 'icon' => '🎫'],
    ['type' => 'tickets', 'name' => 'Tickets für BVB vs Real Madrid', 'link' => 'layouts/tickets.php', 'icon' => '🎫'],
    ['type' => 'tickets', 'name' => 'Tickets für St. Pauli vs BVB', 'link' => 'layouts/tickets.php', 'icon' => '🎫'],
    ['type' => 'tickets', 'name' => 'Tickets', 'link' => 'layouts/tickets.php', 'icon' => '🎫'],
    ['type' => 'tickets', 'name' => 'Spiele', 'link' => 'layouts/tickets.php', 'icon' => '⚽'],
    
    // Teams / Spieler
    ['type' => 'team', 'name' => 'Jadon Sancho', 'link' => 'layouts/mannschaften.php', 'icon' => '⚽'],
    ['type' => 'team', 'name' => 'Marco Reus', 'link' => 'layouts/mannschaften.php', 'icon' => '⚽'],
    ['type' => 'team', 'name' => 'Gregor Kobel', 'link' => 'layouts/mannschaften.php', 'icon' => '🧤'],
    ['type' => 'team', 'name' => 'Mannschaften', 'link' => 'layouts/mannschaften.php', 'icon' => '👥'],
    ['type' => 'team', 'name' => 'Spieler', 'link' => 'layouts/mannschaften.php', 'icon' => '⚽'],
    
    // Warenkorb
    ['type' => 'shop', 'name' => 'Warenkorb', 'link' => 'layouts/warenkorb.php', 'icon' => '🛒'],
    
    // Sonstiges / Pages
    ['type' => 'page', 'name' => 'Service & Support', 'link' => 'layouts/service.php', 'icon' => '📞'],
    ['type' => 'page', 'name' => 'Galerie', 'link' => 'layouts/gallery.php', 'icon' => '🖼️'],
    ['type' => 'page', 'name' => 'Impressum', 'link' => 'layouts/impressum.php', 'icon' => '📄'],
    ['type' => 'page', 'name' => 'Mitgliedschaft', 'link' => 'https://www.bvb.de', 'icon' => '👥'],
    ['type' => 'page', 'name' => 'BVB Homepage', 'link' => 'index.php', 'icon' => '🏠'],
    ['type' => 'page', 'name' => 'Home', 'link' => 'index.php', 'icon' => '🏠'],
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
        ['type' => 'page', 'name' => 'Shop', 'link' => 'layouts/shop.php', 'icon' => '🛒'],
        ['type' => 'page', 'name' => 'Tickets', 'link' => 'layouts/tickets.php', 'icon' => '🎫'],
        ['type' => 'page', 'name' => 'Mannschaften', 'link' => 'layouts/mannschaften.php', 'icon' => '⚽'],
        ['type' => 'page', 'name' => 'Service', 'link' => 'layouts/service.php', 'icon' => '📞'],
        ['type' => 'page', 'name' => 'Galerie', 'link' => 'layouts/gallery.php', 'icon' => '🖼️'],
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

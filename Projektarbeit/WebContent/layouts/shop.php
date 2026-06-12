<?php
session_start();
$titel = "BVB Shop";
include 'head.php';
include 'header.php';

/* Liste aller Produkte, die man kaufen kann */
$products = [
    'heimtrikot' => ['name' => 'BVB Heimtrikot', 'price' => 89.99, 'image' => '../img/BVB_Heimtrikot.png'],
    'auswartstrikot' => ['name' => 'BVB Auswärtstrikot', 'price' => 89.99, 'image' => '../img/BVB_Auswartstrikot.png'],
    'kappe' => ['name' => 'BVB Kappe', 'price' => 17.99, 'image' => '../img/BVB_Kappe.png'],
    'hoodie' => ['name' => 'BVB Hoodie', 'price' => 44.99, 'image' => '../img/BVB_Hoodie.png'],
    'muetze' => ['name' => 'BVB Mütze', 'price' => 24.99, 'image' => '../img/BVB_Muetze.png'],
    'kissen' => ['name' => 'BVB Kissen', 'price' => 14.99, 'image' => '../img/BVB_Kissen.png'],
    'fussball' => ['name' => 'BVB Fußball', 'price' => 24.99, 'image' => '../img/BVB_Fussball.png'],
    'schal' => ['name' => 'BVB Schal', 'price' => 17.99, 'image' => '../img/BVB_Schal.png'],
];

$message = '';
$formProduct = null;

if (isset($_GET['action'], $_GET['product']) && $_GET['action'] === 'buy' && isset($products[$_GET['product']])) {
    $formProduct = $products[$_GET['product']];
    $formProduct['id'] = $_GET['product'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'] ?? '';
    /* min + max Menge */
    $quantity = max(1, min(10, (int)($_POST['quantity'] ?? 1)));

    /* Fehler melden, wenn das Produkt nicht existiert */
    if (!isset($products[$productId])) {
        $message = 'Ungültiges Produkt. Bitte wählen Sie ein Produkt aus.';

    /* Paket für den Warenkorb packen */
    } else {
        $item = [
            'id' => $productId,
            'name' => $products[$productId]['name'],
            'price' => $products[$productId]['price'],
            'quantity' => $quantity,
            'image' => $products[$productId]['image'],
        ];

        /* Das Produkt wird in die Session ($_SESSION['cart']) gespeichert. */
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        /* Prüft, ob das Produkt schon im Warenkorb ist. Wenn ja: Menge erhöhen */
        $found = false;
        foreach ($_SESSION['cart'] as &$cartItem) {
            if ($cartItem['id'] === $productId) {
                $cartItem['quantity'] += $quantity;
                $found = true;
                break;
            }
        }
        if (!$found) {
            $_SESSION['cart'][] = $item;
        }

        $message = 'Dein Artikel wurde erfolgreich in den Warenkorb gelegt. Du kannst weiter einkaufen oder im Warenkorb deine Daten eingeben.';
    }
}

/* Berechnet die Gesamtzahl der Artikel und den Gesamtpreis */
$cart = $_SESSION['cart'] ?? [];
$cartCount = 0;
$totalAmount = 0;
foreach ($cart as $item) {
    $cartCount += $item['quantity'];
    $totalAmount += $item['price'] * $item['quantity'];
}
?>

<main class="shop-page">
    <div class="shop-header">
        <div>
            <h1>BVB Shop</h1>
            <p>Wähle mehrere Artikel aus und lege sie in den Warenkorb. Deine Daten gibst du später einmal im Warenkorb ein.</p>
        </div>
        <a href="warenkorb.php" class="button button-secondary">Zum Warenkorb</a>
    </div>

    <?php if ($message): ?>
        <div class="shop-alert"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <?php if ($formProduct): ?>
        <section class="checkout-card">
            <div class="checkout-info">
                <h2><?php echo htmlspecialchars($formProduct['name']); ?></h2>
                <p>Preis pro Stück: <?php echo number_format($formProduct['price'], 2, ',', '.'); ?> €</p>
            </div>
            <form method="post" class="checkout-form">
                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($formProduct['id']); ?>">
                <label>Anzahl</label>
                <input type="number" name="quantity" min="1" max="10" value="1" required>
                <button type="submit" name="add_to_cart" class="button button-primary">In den Warenkorb legen</button>
            </form>
        </section>
    <?php endif; ?>

    <div class="shop-layout">
        <section class="Shop-Fanartikel">
        <?php foreach ($products as $id => $product): ?>
            <article class="Produkt product-card">
                <img src="<?php echo $product['image']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                <p>Preis: <?php echo number_format($product['price'], 2, ',', '.'); ?> €</p>
                <a href="shop.php?action=buy&product=<?php echo urlencode($id); ?>" class="button button-primary">Kaufen</a>
            </article>
        <?php endforeach; ?>
    </section>

        <aside class="mini-cart">
            <h2>Deine Auswahl</h2>
            <?php if (empty($cart)): ?>
                <p>Dein Warenkorb ist noch leer. Wähle Artikel aus, um sie hier zu sehen.</p>
            <?php else: ?>
                <p class="mini-cart-info">Insgesamt <?php echo $cartCount; ?> Artikel</p>
                <ul class="mini-cart-list">
                    <?php foreach ($cart as $item): ?>
                        <li class="mini-cart-item">
                            <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                            <div>
                                <strong><?php echo htmlspecialchars($item['name']); ?></strong>
                                <p><?php echo $item['quantity']; ?> x <?php echo number_format($item['price'], 2, ',', '.'); ?> €</p>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div class="mini-cart-summary">
                    <p>Zwischensumme: <strong><?php echo number_format($totalAmount, 2, ',', '.'); ?> €</strong></p>
                    <a href="warenkorb.php" class="button button-primary">Warenkorb ansehen</a>
                </div>
            <?php endif; ?>
        </aside>
    </div>
</main>

<?php include 'footer.php'; ?>
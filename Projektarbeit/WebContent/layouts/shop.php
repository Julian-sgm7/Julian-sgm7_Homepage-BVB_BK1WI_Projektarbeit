<?php
session_start();
$titel = "BVB Shop";
include 'head.php';
include 'header.php';

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
    $name = trim($_POST['customer_name'] ?? '');
    $email = trim($_POST['customer_email'] ?? '');
    $address = trim($_POST['customer_address'] ?? '');
    $quantity = max(1, min(10, (int)($_POST['quantity'] ?? 1)));

    if (!isset($products[$productId])) {
        $message = 'Ungültiges Produkt. Bitte wählen Sie ein Produkt aus.';
    } elseif ($name === '' || $email === '' || $address === '') {
        $message = 'Bitte fülle alle Felder aus, um den Artikel in den Warenkorb zu legen.';
        $formProduct = $products[$productId];
        $formProduct['id'] = $productId;
    } else {
        $item = [
            'id' => $productId,
            'name' => $products[$productId]['name'],
            'price' => $products[$productId]['price'],
            'quantity' => $quantity,
            'image' => $products[$productId]['image'],
        ];

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

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

        $_SESSION['cart_customer'] = [
            'name' => $name,
            'email' => $email,
            'address' => $address,
        ];

        $message = 'Dein Artikel wurde erfolgreich in den Warenkorb gelegt. Du kannst den Warenkorb jetzt ansehen.';
    }
}
?>

<main class="shop-page">
    <div class="shop-header">
        <div>
            <span class="eyebrow">Fanartikel</span>
            <h1>BVB Shop</h1>
            <p>Wähle dein Lieblingsstück, fülle kurz deine Daten aus und lege es in den Warenkorb.</p>
        </div>
        <a href="cart.php" class="button button-secondary">Zum Warenkorb</a>
    </div>

    <?php if ($message): ?>
        <div class="shop-alert"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <?php if ($formProduct): ?>
        <section class="checkout-card">
            <div class="checkout-info">
                <h2>Jetzt kaufen: <?php echo htmlspecialchars($formProduct['name']); ?></h2>
                <p>Preis pro Stück: <?php echo number_format($formProduct['price'], 2, ',', '.'); ?> €</p>
            </div>
            <form method="post" class="checkout-form">
                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($formProduct['id']); ?>">
                <label>Dein Name</label>
                <input type="text" name="customer_name" required>
                <label>E-Mail</label>
                <input type="email" name="customer_email" required>
                <label>Lieferadresse</label>
                <textarea name="customer_address" rows="3" required></textarea>
                <label>Anzahl</label>
                <input type="number" name="quantity" min="1" max="10" value="1" required>
                <button type="submit" name="add_to_cart" class="button button-primary">In den Warenkorb legen</button>
            </form>
        </section>
    <?php endif; ?>

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
</main>

<?php include 'footer.php'; ?>
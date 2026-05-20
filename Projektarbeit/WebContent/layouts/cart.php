<?php
session_start();
$titel = "Warenkorb";
include 'head.php';
include 'header.php';

$cart = $_SESSION['cart'] ?? [];
$customer = $_SESSION['cart_customer'] ?? ['name' => '', 'email' => '', 'address' => ''];
$message = '';
$orderComplete = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['remove_item'], $_POST['product_id'])) {
        $productId = $_POST['product_id'];
        if (isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array_values(array_filter($_SESSION['cart'], function ($item) use ($productId) {
                return $item['id'] !== $productId;
            }));
            $cart = $_SESSION['cart'];
            $message = 'Artikel wurde aus dem Warenkorb entfernt.';
        }
    }

    if (isset($_POST['checkout'])) {
        $name = trim($_POST['customer_name'] ?? '');
        $email = trim($_POST['customer_email'] ?? '');
        $address = trim($_POST['customer_address'] ?? '');

        if ($name === '' || $email === '' || $address === '') {
            $message = 'Bitte fülle alle Kontaktdaten aus, um die Bestellung abzuschließen.';
        } elseif (empty($cart)) {
            $message = 'Der Warenkorb ist leer. Bitte lege zuerst Artikel in den Warenkorb.';
        } else {
            $_SESSION['cart_customer'] = ['name' => $name, 'email' => $email, 'address' => $address];
            $customer = $_SESSION['cart_customer'];
            $_SESSION['cart'] = [];
            $cart = [];
            $orderComplete = true;
            $message = 'Danke für deine Bestellung! Deine Artikel wurden erfolgreich bestellt.';
        }
    }
}

$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>

<main class="cart-page">
    <div class="cart-header">
        <div>
            <span class="eyebrow">Warenkorb</span>
            <h1>Deine Bestellung</h1>
            <p>Überprüfe deine Artikel, passe die Menge an oder gib deine Daten ein, um zur Kasse zu gehen.</p>
        </div>
        <a href="shop.php" class="button button-secondary">Weiter einkaufen</a>
    </div>

    <?php if ($message): ?>
        <div class="shop-alert"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <?php if ($orderComplete): ?>
        <section class="order-success">
            <h2>Bestellung abgeschlossen</h2>
            <p>Vielen Dank, <?php echo htmlspecialchars($customer['name']); ?>! Wir haben deine Bestellung empfangen.</p>
            <p>Wir senden eine Bestätigung an <strong><?php echo htmlspecialchars($customer['email']); ?></strong>.</p>
        </section>
    <?php endif; ?>

    <?php if (empty($cart) && !$orderComplete): ?>
        <div class="cart-empty">
            <p>Dein Warenkorb ist aktuell leer.</p>
            <a href="shop.php" class="button button-primary">Zum Shop</a>
        </div>
    <?php endif; ?>

    <?php if (!empty($cart)): ?>
        <section class="cart-list">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Produkt</th>
                        <th>Menge</th>
                        <th>Preis</th>
                        <th>Gesamt</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $item): ?>
                        <tr>
                            <td class="product-cell">
                                <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                                <div>
                                    <strong><?php echo htmlspecialchars($item['name']); ?></strong>
                                    <p><?php echo number_format($item['price'], 2, ',', '.'); ?> € pro Stück</p>
                                </div>
                            </td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td><?php echo number_format($item['price'], 2, ',', '.'); ?> €</td>
                            <td><?php echo number_format($item['price'] * $item['quantity'], 2, ',', '.'); ?> €</td>
                            <td>
                                <form method="post" class="remove-form">
                                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($item['id']); ?>">
                                    <button type="submit" name="remove_item" class="button button-secondary">Entfernen</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <section class="cart-summary">
            <div class="summary-card">
                <h2>Bestellübersicht</h2>
                <p>Zwischensumme: <strong><?php echo number_format($total, 2, ',', '.'); ?> €</strong></p>
                <p>Versand: <strong>4,99 €</strong></p>
                <p class="total">Gesamt: <strong><?php echo number_format($total + 4.99, 2, ',', '.'); ?> €</strong></p>
            </div>
            <form method="post" class="checkout-form">
                <h3>Deine Daten</h3>
                <label>Name</label>
                <input type="text" name="customer_name" value="<?php echo htmlspecialchars($customer['name']); ?>" required>
                <label>E-Mail</label>
                <input type="email" name="customer_email" value="<?php echo htmlspecialchars($customer['email']); ?>" required>
                <label>Lieferadresse</label>
                <textarea name="customer_address" rows="3" required><?php echo htmlspecialchars($customer['address']); ?></textarea>
                <button type="submit" name="checkout" class="button button-primary">Jetzt kaufen</button>
            </form>
        </section>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
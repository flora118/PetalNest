<?php
$title = 'Shopping Cart - PetalNest';
include 'includes/header.php';
include_once 'includes/functions.php';

// Add to cart functionality
if (isset($_GET['add'])) {
    $id = (int)$_GET['add'];
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]++;
    } else {
        $_SESSION['cart'][$id] = 1;
    }
    redirect('cart.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['qty'])) {
    foreach ($_POST['qty'] as $pid => $qty) {
        $pid = (int)$pid;
        $qty = (int)$qty;
        if ($qty <= 0) {
            unset($_SESSION['cart'][$pid]);
        } else {
            $_SESSION['cart'][$pid] = $qty;
        }
    }
    redirect('cart.php');
}

if (isset($_GET['remove'])) {
    unset($_SESSION['cart'][(int)$_GET['remove']]);
    redirect('cart.php');
}

$items = [];
$total = 0;
if (!empty($_SESSION['cart'])) {
    $ids = implode(',', array_map('intval', array_keys($_SESSION['cart'])));
    $res = $conn->query("SELECT * FROM products WHERE id IN ($ids)");
    while ($row = $res->fetch_assoc()) {
        $row['quantity'] = $_SESSION['cart'][$row['id']];
        $row['subtotal'] = $row['quantity'] * $row['price'];
        $total += $row['subtotal'];
        $items[] = $row;
    }
}
?>
<section class="cart-section">
    <div class="container">
        <h2 class="section-title">Shopping Cart</h2>
        
        <?php if (empty($items)): ?>
        <div class="empty-cart">
            <i class="fas fa-shopping-cart"></i>
            <h3>Your cart is empty</h3>
            <p>Add some beautiful flowers or plants to your cart!</p>
            <a href="products.php" class="cta-btn">Continue Shopping</a>
        </div>
        <?php else: ?>
        <form method="POST">
            <div class="cart-items">
                <?php foreach ($items as $item): ?>
                <div class="cart-item">
                    <div class="item-image">
                        <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                    </div>
                    <div class="item-details">
                        <h3><?= htmlspecialchars($item['name']) ?></h3>
                        <div class="item-price">$<?= number_format($item['price'], 2) ?></div>
                    </div>
                    <div class="item-quantity">
                        <input type="number" name="qty[<?= $item['id'] ?>]" value="<?= $item['quantity'] ?>" min="1">
                    </div>
                    <div class="item-subtotal">
                        $<?= number_format($item['subtotal'], 2) ?>
                    </div>
                    <div class="item-remove">
                        <a href="?remove=<?= $item['id'] ?>" class="btn-remove"><i class="fas fa-trash"></i></a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div class="cart-summary">
                <div class="summary-row">
                    <span>Subtotal:</span>
                    <span>$<?= number_format($total, 2) ?></span>
                </div>
                <div class="summary-row">
                    <span>Shipping:</span>
                    <span>$5.00</span>
                </div>
                <div class="summary-row total">
                    <span>Total:</span>
                    <span>$<?= number_format($total + 5, 2) ?></span>
                </div>
            </div>
            
            <div class="cart-actions">
                <button type="submit" class="btn-update">Update Cart</button>
                <a href="checkout.php" class="cta-btn">Proceed to Checkout</a>
            </div>
        </form>
        <?php endif; ?>
    </div>
</section>
<!-- Product Comparison Section -->
<section class="compare-section" style="display: none;">
    <div class="container">
        <h2 class="compare-title">Compare Products</h2>
        <div class="compare-products"></div>
    </div>
</section>
<?php include 'includes/footer.php'; ?>
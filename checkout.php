<?php
$title = 'Checkout - PetalNest';
include 'includes/header.php';
include_once 'includes/functions.php';
if (empty($_SESSION['cart'])) {
    redirect('cart.php');
}
$items = [];
$total = 0;
$ids = implode(',', array_map('intval', array_keys($_SESSION['cart'])));
$res = $conn->query("SELECT * FROM products WHERE id IN ($ids)");
while ($row = $res->fetch_assoc()) {
    $row['quantity'] = $_SESSION['cart'][$row['id']];
    $row['subtotal'] = $row['quantity'] * $row['price'];
    $total += $row['subtotal'];
    $items[] = $row;
}
$success = $error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);
    $phone = trim($_POST['phone']);
    $payment = trim($_POST['payment']);
    if ($name && $email && $address && $phone && $payment) {
        $uid = $_SESSION['user']['id'] ?? NULL;
        $stmt = $conn->prepare("INSERT INTO orders (user_id, name, email, address, phone, payment_method, total) VALUES (?,?,?,?,?,?,?)");
        $stmt->bind_param("isssssd", $uid, $name, $email, $address, $phone, $payment, $total);
        if ($stmt->execute()) {
            $order_id = $stmt->insert_id;
            $stmt->close();
            $oi = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?,?,?,?)");
            foreach ($items as $it) {
                $pid = (int)$it['id'];
                $qty = (int)$it['quantity'];
                $pr = (float)$it['price'];
                $oi->bind_param("iiid", $order_id, $pid, $qty, $pr);
                $oi->execute();
            }
            $oi->close();
            $_SESSION['cart'] = [];
            $success = "🎉 Thank you! Your order has been placed. Order ID: #$order_id";
        } else {
            $error = "❌ Something went wrong. Please try again.";
        }
    } else {
        $error = "Please fill all fields correctly.";
    }
}
?>
<section class="checkout-section">
    <div class="container">
        <h2 class="section-title">Checkout</h2>
        
        <?php if ($success): ?>
        <div class="success-message">
            <h3>Order Placed Successfully!</h3>
            <p><?= $success ?></p>
            <img src="assets/images/thankyou.jpg" alt="Thank You" style="width: 200px; margin: 20px 0;">
            <br>
            <a href="products.php" class="cta-btn">Continue Shopping</a>
        </div>
        <?php else: ?>
        <?php if ($error): ?>
        <div class="error-message"><?= $error ?></div>
        <?php endif; ?>
        
        <div class="checkout-grid">
            <div class="checkout-form">
                <h3>Billing Information</h3>
                <form method="POST">
                    <div class="form-group">
                        <label>Full Name *</label>
                        <input type="text" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>Email Address *</label>
                        <input type="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label>Phone Number *</label>
                        <input type="tel" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label>Delivery Address *</label>
                        <textarea name="address" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Payment Method *</label>
                        <select name="payment" required>
                            <option value="">Select Payment Method</option>
                            <option value="Cash on Delivery">Cash on Delivery</option>
                            <option value="Bkash">Bkash</option>
                            <option value="Nagad">Nagad</option>
                            <option value="Rocket">Rocket</option>
                        </select>
                    </div>
                    <button type="submit" class="cta-btn">Place Order</button>
                </form>
            </div>
            
            <div class="order-summary">
                <h3>Order Summary</h3>
                <div class="summary-items">
                    <?php foreach ($items as $item): ?>
                    <div class="summary-item">
                        <span><?= htmlspecialchars($item['name']) ?> × <?= $item['quantity'] ?></span>
                        <span>$<?= number_format($item['subtotal'], 2) ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
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
        </div>
        <?php endif; ?>
    </div>
</section>
<?php include 'includes/footer.php'; ?>
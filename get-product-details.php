<?php
include 'includes/db.php';
include_once 'includes/functions.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $product = get_product($id);
    
    if ($product) {
?>
        <div class="quick-view-image">
            <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
        </div>
        <div class="quick-view-details">
            <h3><?= htmlspecialchars($product['name']) ?></h3>
            <div class="product-price">$<?= number_format($product['price'], 2) ?></div>
            <div class="product-rating">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <i class="fas fa-star<?= $i <= $product['rating'] ? '' : '-o' ?>"></i>
                <?php endfor; ?>
            </div>
            <div class="product-description">
                <p><?= htmlspecialchars($product['description']) ?></p>
            </div>
            <div class="product-tips">
                <h4>Care Tips:</h4>
                <p><?= htmlspecialchars($product['tips']) ?></p>
            </div>
            <div class="product-actions">
                <?php if ($product['stock'] > 0): ?>
                    <button class="btn-add-cart" data-id="<?= $product['id'] ?>">Add to Cart</button>
                <?php else: ?>
                    <button class="btn-add-cart" disabled>Out of Stock</button>
                <?php endif; ?>
                <button class="wishlist-btn" data-id="<?= $product['id'] ?>">
                    <i class="fas fa-heart"></i>
                </button>
            </div>
        </div>
<?php
    } else {
        echo '<div class="error">Product not found.</div>';
    }
} else {
    echo '<div class="error">Invalid product ID.</div>';
}
?>
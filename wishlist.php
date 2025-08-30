<?php
$title = 'Wishlist - PetalNest';
include 'includes/header.php';
include_once 'includes/functions.php';

// Add to wishlist functionality
if (isset($_GET['add'])) {
    $id = (int)$_GET['add'];
    if (!in_array($id, $_SESSION['wishlist'])) {
        $_SESSION['wishlist'][] = $id;
    }
    redirect('wishlist.php');
}

if (isset($_GET['remove'])) {
    $_SESSION['wishlist'] = array_diff($_SESSION['wishlist'], [(int)$_GET['remove']]);
    redirect('wishlist.php');
}

$items = [];
if (!empty($_SESSION['wishlist'])) {
    $ids = implode(',', array_map('intval', $_SESSION['wishlist']));
    $res = $conn->query("SELECT * FROM products WHERE id IN ($ids)");
    $items = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
}
?>
<section class="wishlist-section">
    <div class="container">
        <h2 class="section-title">My Wishlist</h2>
        
        <?php if (empty($items)): ?>
        <div class="empty-wishlist">
            <i class="fas fa-heart"></i>
            <h3>Your wishlist is empty</h3>
            <p>Save your favorite flowers and plants here!</p>
            <a href="products.php" class="cta-btn">Browse Products</a>
        </div>
        <?php else: ?>
        <div class="wishlist-grid">
            <?php foreach ($items as $item): ?>
            <div class="wishlist-item">
                <div class="item-image">
                    <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                    <a href="?remove=<?= $item['id'] ?>" class="btn-remove"><i class="fas fa-times"></i></a>
                </div>
                <div class="item-info">
                    <h3><?= htmlspecialchars($item['name']) ?></h3>
                    <div class="item-price">$<?= number_format($item['price'], 2) ?></div>
                    <div class="item-rating">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="fas fa-star<?= $i <= $item['rating'] ? '' : '-o' ?>"></i>
                        <?php endfor; ?>
                    </div>
                    <div class="item-actions">
                        <a href="cart.php?add=<?= $item['id'] ?>" class="btn-add-cart">Add to Cart</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php include 'includes/footer.php'; ?>
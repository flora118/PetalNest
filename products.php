<?php
$title = 'Products - PetalNest';
include 'includes/header.php';
include_once 'includes/functions.php';
$category = $_GET['category'] ?? 'all';
$search = trim($_GET['search'] ?? '');
$sql = "SELECT * FROM products WHERE 1";
if ($category !== 'all') {
    $sql .= " AND category = '$category'";
}
if ($search) {
    $sql .= " AND name LIKE '%$search%'";
}
$sql .= " ORDER BY created_at DESC";
$res = $conn->query($sql);
?>
<section class="products-section">
    <div class="container">
        <h2 class="section-title">Our Products</h2>
        
        <div class="filter-section">
            <h3 class="filter-title">Filter by</h3>
            <div class="filter-options">
                <div class="filter-option" data-filter="flower">Flowers</div>
                <div class="filter-option" data-filter="plant">Plants</div>
                <div class="filter-option" data-filter="new">New</div>
                <div class="filter-option" data-filter="bestseller">Bestseller</div>
                <div class="filter-option" data-filter="premium">Premium</div>
                <div class="filter-option" data-filter="seasonal">Seasonal</div>
            </div>
        </div>
        
        <div class="category-tabs">
            <a href="products.php?category=all" class="category-tab <?= $category === 'all' ? 'active' : '' ?>">All</a>
            <a href="products.php?category=flower" class="category-tab <?= $category === 'flower' ? 'active' : '' ?>">Flowers</a>
            <a href="products.php?category=plant" class="category-tab <?= $category === 'plant' ? 'active' : '' ?>">Plants</a>
        </div>
        
        <div class="search-bar">
            <form method="GET">
                <input type="text" name="search" placeholder="Search products..." value="<?= htmlspecialchars($search) ?>">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
        
        <div class="products-grid">
            <?php while ($p = $res->fetch_assoc()): ?>
            <div class="product-card" data-category="<?= $p['category'] ?>" data-badge="<?= $p['badge'] ?>">
                <div class="product-image">
                    <img src="<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['name']) ?>">
                    <?php if ($p['badge']): ?>
                        <span class="product-badge badge-<?= $p['badge'] ?>"><?= $p['badge'] ?></span>
                    <?php endif; ?>
                    <button class="wishlist-btn" data-id="<?= $p['id'] ?>">
                        <i class="fas fa-heart"></i>
                    </button>
                </div>
                <div class="product-info">
                    <h3 class="product-name"><?= htmlspecialchars($p['name']) ?></h3>
                    <div class="product-price">$<?= number_format($p['price'], 2) ?></div>
                    <div class="product-rating">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="fas fa-star<?= $i <= $p['rating'] ? '' : '-o' ?>"></i>
                        <?php endfor; ?>
                    </div>
                    <div class="product-tips">
                        <i class="fas fa-lightbulb"></i> <?= htmlspecialchars($p['tips']) ?>
                    </div>
                    <div class="product-actions">
                        <?php if ($p['stock'] > 0): ?>
                            <button class="btn-add-cart" data-id="<?= $p['id'] ?>">Add to Cart</button>
                        <?php else: ?>
                            <button class="btn-add-cart" disabled>Out of Stock</button>
                        <?php endif; ?>
                        <button class="quick-view-btn" data-id="<?= $p['id'] ?>">Quick View</button>
                        <button class="compare-btn" data-id="<?= $p['id'] ?>" data-name="<?= htmlspecialchars($p['name']) ?>" data-price="<?= $p['price'] ?>" data-image="<?= htmlspecialchars($p['image']) ?>">Compare</button>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<!-- Quick View Modal -->
<div class="quick-view-modal" id="quick-view-modal">
    <div class="quick-view-content">
        <div class="quick-view-header">
            <h3>Product Details</h3>
            <button class="quick-view-close">&times;</button>
        </div>
        <div class="quick-view-body">
            <!-- Content will be loaded dynamically -->
        </div>
    </div>
</div>
<!-- Product Comparison Section -->
<section class="compare-section" style="display: none;">
    <div class="container">
        <h2 class="compare-title">Compare Products</h2>
        <div class="compare-products"></div>
    </div>
</section>
<?php include 'includes/footer.php'; ?>
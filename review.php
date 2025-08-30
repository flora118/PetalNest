<?php
// Enable output buffering at the very top
ob_start();

$title = 'Reviews - PetalNest';
include 'includes/header.php';
include_once 'includes/functions.php';

// Load existing reviews
$reviews = [
    ["user"=>"Siyam Ahmed","rating"=>5,"text"=>"Absolutely loved the Rose bouquet! 🌹 Highly recommend.","date"=>"2025-08-22","verified"=>true,"img"=>"assets/images/user1.jpg","like"=>3,"dislike"=>0],
    ["user"=>"তানভীর হাসান","rating"=>4,"text"=>"Tulips are fresh and vibrant. ফুলগুলো খুব সুন্দর ছিল 🌸","date"=>"2025-08-21","verified"=>true,"img"=>"assets/images/user2.jpg","like"=>2,"dislike"=>1],
    ["user"=>"Mahi Chowdhury","rating"=>5,"text"=>"Daisy flowers brightened my room. Excellent service! 💐","date"=>"2025-08-23","verified"=>true,"img"=>"assets/images/user3.jpg","like"=>5,"dislike"=>0],
    ["user"=>"সাদিয়া রহমান","rating"=>3,"text"=>"Lily is okay, petals were slightly wilted.","date"=>"2025-08-20","verified"=>false,"img"=>"assets/images/user4.jpg","like"=>1,"dislike"=>2],
    ["user"=>"Rafiq Islam","rating"=>4,"text"=>"Orchid bouquet was stunning and lasted long! 🌺","date"=>"2025-08-19","verified"=>true,"img"=>"assets/images/user5.jpg","like"=>4,"dislike"=>0]
];

// Handle like/dislike
if (isset($_GET['like'])) {
    $index = (int)$_GET['like'];
    if (isset($reviews[$index])) {
        $reviews[$index]['like']++;
        $_SESSION['reviews'] = $reviews;
    }
    // Clear output buffer before redirect
    ob_end_clean();
    header("Location: review.php");
    exit;
}

if (isset($_GET['dislike'])) {
    $index = (int)$_GET['dislike'];
    if (isset($reviews[$index])) {
        $reviews[$index]['dislike']++;
        $_SESSION['reviews'] = $reviews;
    }
    // Clear output buffer before redirect
    ob_end_clean();
    header("Location: review.php");
    exit;
}

// Handle new review submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['user'] ?? 'Guest');
    $rating = (int)($_POST['rating'] ?? 5);
    $text = trim($_POST['text'] ?? '');
    $img_path = 'assets/images/default-user.png';
    
    // Handle image upload
    if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'assets/images/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $img_name = time() . '_' . basename($_FILES['img']['name']);
        $img_path = $upload_dir . $img_name;
        
        if (!move_uploaded_file($_FILES['img']['tmp_name'], $img_path)) {
            $img_path = 'assets/images/default-user.png';
        }
    }
    
    // Add new review
    $new_review = [
        'user' => $name,
        'rating' => $rating,
        'text' => $text,
        'date' => date('Y-m-d'),
        'verified' => false,
        'img' => $img_path,
        'like' => 0,
        'dislike' => 0
    ];
    
    $reviews[] = $new_review;
    $_SESSION['reviews'] = $reviews;
    
    // Clear output buffer before redirect
    ob_end_clean();
    header("Location: review.php");
    exit;
}

// Load reviews from session if available
if (isset($_SESSION['reviews'])) {
    $reviews = $_SESSION['reviews'];
}

// Now we can safely output the HTML
?>
<section class="reviews-section">
    <div class="container">
        <h2 class="section-title">Customer Reviews</h2>
        <p style="text-align: center; margin-bottom: 40px; font-size: 1.2em;">Read what our valued customers have to say about us</p>
        
        <div class="reviews-grid">
            <?php foreach ($reviews as $i => $r): ?>
            <div class="review-card">
                <div class="review-header">
                    <img src="<?= htmlspecialchars($r['img']) ?>" alt="<?= htmlspecialchars($r['user']) ?>" class="review-avatar">
                    <div class="review-info">
                        <h4><?= htmlspecialchars($r['user']) ?></h4>
                        <div class="review-date"><?= date('d M Y', strtotime($r['date'])) ?></div>
                    </div>
                </div>
                <div class="review-rating">
                    <?php for ($s = 1; $s <= 5; $s++): ?>
                        <i class="fas fa-star<?= $s <= $r['rating'] ? '' : '-o' ?>"></i>
                    <?php endfor; ?>
                    <?php if ($r['verified']): ?>
                        <span class="verified-badge"><i class="fas fa-check-circle"></i> Verified</span>
                    <?php endif; ?>
                </div>
                <div class="review-text">
                    <p><?= htmlspecialchars($r['text']) ?></p>
                </div>
                <div class="review-actions">
                    <a href="?like=<?= $i ?>" class="btn-like"><i class="fas fa-thumbs-up"></i> <?= $r['like'] ?></a>
                    <a href="?dislike=<?= $i ?>" class="btn-dislike"><i class="fas fa-thumbs-down"></i> <?= $r['dislike'] ?></a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="add-review">
            <h3>Write a Review</h3>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Your Name</label>
                    <input type="text" name="user" required>
                </div>
                <div class="form-group">
                    <label>Rating</label>
                    <select name="rating" required>
                        <option value="5">5 Stars - Excellent</option>
                        <option value="4">4 Stars - Good</option>
                        <option value="3">3 Stars - Average</option>
                        <option value="2">2 Stars - Poor</option>
                        <option value="1">1 Star - Terrible</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Your Review</label>
                    <textarea name="text" required rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label>Your Photo (Optional)</label>
                    <input type="file" name="img" accept="image/*">
                </div>
                <button type="submit" class="cta-btn">Submit Review</button>
            </form>
        </div>
    </div>
</section>

<?php 
// Include footer and end output buffering
include 'includes/footer.php';
ob_end_flush();
?>
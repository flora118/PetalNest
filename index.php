<?php
$title = 'Home - PetalNest';
include 'includes/header.php';
?>
<main class="hero">
    <div class="hero-content">
        <h2>🌸 Welcome to PetalNest</h2>
        <p>Bloom, Buy & Grow – Your One Stop Flower Shop 🌷</p>
        <button class="cta-btn" onclick="location.href='products.php'">Shop Now</button>
        <!-- Floating Elements -->
        <span class="floating" style="top:30px; left:40px;">🌸</span>
        <span class="floating" style="top:80px; right:50px;">🌿</span>
        <span class="floating" style="bottom:40px; left:60px;">🌿</span>
        <span class="floating" style="bottom:70px; right:70px;">🌸</span>
        <span class="heart floating" style="top:150px; left:200px;">💚</span>
    </div>
</main>
<!-- About Section -->
<section class="about">
    <div class="container">
        <h2>About PetalNest 🌿</h2>
        <p>At PetalNest, every bloom tells a story. Our flowers are hand-picked with love and delivered fresh to your doorstep. Celebrate special moments and bring nature's beauty into your home.</p>
    </div>
</section>
<!-- Flower Subscription Section -->
<section class="subscription-section">
    <div class="container">
        <h2 class="section-title">Flower Subscription Boxes 📦</h2>
        <p class="section-subtitle">Fresh flowers delivered to your doorstep regularly</p>
        
        <div class="subscription-grid">
            <div class="subscription-box">
                <h3>Weekly Bloom</h3>
                <div class="subscription-price">$15.99 <span>/week</span></div>
                <ul class="subscription-features">
                    <li> Fresh seasonal flowers weekly</li>
                    <li> Free delivery</li>
                    <li> Cancel anytime</li>
                </ul>
                <button class="btn subscribe-btn">Subscribe Now</button>
            </div>
            
            <div class="subscription-box featured">
                <h3>Monthly Garden</h3>
                <div class="subscription-price">$49.99 <span>/month</span></div>
                <ul class="subscription-features">
                    <li> Premium flower arrangement</li>
                    <li> Free vase with first delivery</li>
                    <li> Exclusive member discounts</li>
                </ul>
                <button class="btn subscribe-btn">Subscribe Now</button>
            </div>
            
            <div class="subscription-box">
                <h3>Seasonal Surprise</h3>
                <div class="subscription-price">$129.99 <span>/quarter</span></div>
                <ul class="subscription-features">
                    <li> Curated seasonal collection</li>
                    <li> Personalized note</li>
                    <li> Gift wrapping option</li>
                </ul>
                <button class="btn subscribe-btn">Subscribe Now</button>
            </div>
        </div>
        
        <div class="subscription-benefits">
            <h3>Why Subscribe?</h3>
            <div class="benefits-grid">
                <div class="benefit-item">
                    <div class="benefit-icon">🌸</div>
                    <h4>Freshness Guaranteed</h4>
                    <p>Our flowers are sourced directly from farms and delivered within 24 hours of cutting.</p>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">🎁</div>
                    <h4>Customizable</h4>
                    <p>Personalize your subscription with your favorite flowers and delivery schedule.</p>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">💚</div>
                    <h4>Eco-Friendly</h4>
                    <p>We use sustainable packaging and support local flower farmers.</p>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">🔄</div>
                    <h4>Flexible</h4>
                    <p>Pause, skip, or cancel your subscription anytime with no hidden fees.</p>
                </div>
            </div>
        </div>
        
        <div class="subscription-testimonials">
            <h3>What Our Subscribers Say</h3>
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <p>"The Monthly Garden subscription has transformed my home! The flowers are always fresh and beautifully arranged."</p>
                    </div>
                    <div class="testimonial-author">
                        <img src="assets/images/user4.jpg" alt="Customer">
                        <div>
                            <h4>Sadiya Akter</h4>
                            <p>Monthly Garden Subscriber</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <p>"I've been subscribed to Weekly Bloom for 6 months now. The quality is consistently excellent and the delivery is always on time."</p>
                    </div>
                    <div class="testimonial-author">
                        <img src="assets/images/user2.jpg" alt="Customer">
                        <div>
                            <h4>Tanvir Hasan</h4>
                            <p>Weekly Bloom Subscriber</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <p>"The Seasonal Surprise boxes are perfect for special occasions. Each delivery feels like a gift to myself!"</p>
                    </div>
                    <div class="testimonial-author">
                        <img src="assets/images/user3.jpg" alt="Customer">
                        <div>
                            <h4>Shahi Chowdhury</h4>
                            <p>Seasonal Surprise Subscriber</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="subscription-faq">
            <h3>Frequently Asked Questions</h3>
            <div class="faq-accordion">
                <div class="faq-item">
                    <div class="faq-question">How does the subscription work?</div>
                    <div class="faq-answer">
                        <p>Simply choose your preferred subscription plan, and we'll deliver fresh flowers to your doorstep on a regular schedule. You can customize your delivery preferences and flower choices.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">Can I pause or cancel my subscription?</div>
                    <div class="faq-answer">
                        <p>Yes, you can pause or cancel your subscription at any time through your account dashboard. There are no cancellation fees or hidden charges.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">What if I'm not satisfied with the flowers?</div>
                    <div class="faq-answer">
                        <p>We offer a 100% satisfaction guarantee. If you're not happy with your flowers for any reason, contact us within 24 hours of delivery for a replacement or refund.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">Can I change my delivery address?</div>
                    <div class="faq-answer">
                        <p>Yes, you can update your delivery address anytime through your account settings. Just make sure to update it at least 48 hours before your next scheduled delivery.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Virtual Flower Arrangement Section -->
<section class="virtual-arrangement">
    <div class="container">
        <h2 class="section-title">Create Your Own Bouquet 🎨</h2>
        <p class="section-subtitle">Design your perfect flower arrangement with our virtual tool</p>
        
        <div class="virtual-arrangement-container">
            <div class="arrangement-canvas" id="arrangement-canvas"></div>
            
            <div class="flower-palette">
                <h3>Flower Palette</h3>
                <div class="flower-options">
                    <div class="flower-option" data-flower="🌹">🌹</div>
                    <div class="flower-option" data-flower="🌸">🌸</div>
                    <div class="flower-option" data-flower="🌷">🌷</div>
                    <div class="flower-option" data-flower="🌺">🌺</div>
                    <div class="flower-option" data-flower="🌻">🌻</div>
                    <div class="flower-option" data-flower="🌼">🌼</div>
                    <div class="flower-option" data-flower="💐">💐</div>
                    <div class="flower-option" data-flower="🌿">🌿</div>
                </div>
                
                <div class="arrangement-actions">
                    <button class="btn" id="clear-arrangement">Clear</button>
                    <button class="btn" id="save-arrangement">Save Arrangement</button>
                    <button class="btn" id="order-arrangement">Order This Arrangement</button>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Flower Care Tips Section -->
<section class="tips">
    <div class="container">
        <h2 class="section-title">Flower Care Tips 💡</h2>
        
        <div class="tips-grid">
            <div class="tip-card">
                <div class="tip-icon">💧</div>
                <h3>Watering</h3>
                <p>Most flowers need regular watering, but avoid overwatering. Check soil moisture before watering.</p>
            </div>
            
            <div class="tip-card">
                <div class="tip-icon">☀️</div>
                <h3>Sunlight</h3>
                <p>Place flowers where they can enjoy the right amount of sunlight. Most flowers need 4-6 hours of direct sunlight.</p>
            </div>
            
            <div class="tip-card">
                <div class="tip-icon">🌱</div>
                <h3>Soil Care</h3>
                <p>Use nutrient-rich soil to keep your plants healthy and vibrant. Replace soil every 6-12 months.</p>
            </div>
            
            <div class="tip-card">
                <div class="tip-icon">✂️</div>
                <h3>Pruning</h3>
                <p>Trim old leaves and blooms to encourage fresh growth. Remove dead or dying flowers regularly.</p>
            </div>
        </div>
    </div>
</section>
<!-- Seasonal Blooms Section -->
<section class="seasonal-collection">
    <div class="container">
        <div class="seasonal-header">
            <h2 class="seasonal-title">Seasonal Blooms 🌸</h2>
            <p class="seasonal-subtitle">Discover our collection of fresh seasonal flowers</p>
        </div>
        
        <div class="seasonal-products">
            <?php
            $res = $conn->query("SELECT * FROM products WHERE badge = 'seasonal' LIMIT 4");
            while ($p = $res->fetch_assoc()):
            ?>
            <div class="seasonal-product">
                <div class="seasonal-badge">Seasonal</div>
                <div class="product-image">
                    <img src="<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['name']) ?>">
                </div>
                <div class="product-info">
                    <h3 class="product-name"><?= htmlspecialchars($p['name']) ?></h3>
                    <div class="product-price">$<?= number_format($p['price'], 2) ?></div>
                    <div class="product-actions">
                        <button class="btn-add-cart" data-id="<?= $p['id'] ?>">Add to Cart</button>
                        <button class="quick-view-btn" data-id="<?= $p['id'] ?>">Quick View</button>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<!-- Personalized Recommendations Section -->
<section class="recommendation-section">
    <div class="container">
        <div class="recommendation-header">
            <h2 class="recommendation-title">Recommended For You 🌟</h2>
            <p class="recommendation-subtitle">Based on your browsing history and preferences</p>
        </div>
        
        <div class="recommendation-products">
            <?php
            // In a real application, this would be based on user's browsing history
            $res = $conn->query("SELECT * FROM products WHERE featured = TRUE LIMIT 4");
            while ($p = $res->fetch_assoc()):
            ?>
            <div class="product-card">
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
                        <button class="btn-add-cart" data-id="<?= $p['id'] ?>">Add to Cart</button>
                        <button class="quick-view-btn" data-id="<?= $p['id'] ?>">Quick View</button>
                        <button class="compare-btn" data-id="<?= $p['id'] ?>" data-name="<?= htmlspecialchars($p['name']) ?>" data-price="<?= $p['price'] ?>" data-image="<?= htmlspecialchars($p['image']) ?>">Compare</button>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<!-- Mid CTA Section -->
<section class="cta-mid">
    <div class="container">
        <h2>Ready to Brighten Your Day?</h2>
        <p>Explore our collection of fresh flowers and plants</p>
        <button class="btn" onclick="location.href='products.php'">Shop Now</button>
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
<!-- Live Chat Widget -->
<div class="live-chat">
    <button class="chat-button">
        <i class="fas fa-comments"></i>
    </button>
    <div class="chat-window">
        <div class="chat-header">
            <h3>Chat with us</h3>
            <button class="chat-close">&times;</button>
        </div>
        <div class="chat-messages">
            <div class="message bot">
                <div class="message-content">Hello! How can I help you today?</div>
            </div>
        </div>
        <div class="chat-input-container">
            <input type="text" class="chat-input" placeholder="Type your message...">
            <button class="chat-send">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>
</div>
<!-- Floating Flowers -->
<div class="floating-flowers">
    <span class="flower" style="top: 10%; left: 5%;">🌸</span>
    <span class="flower" style="top: 20%; left: 90%;">🌺</span>
    <span class="flower" style="top: 60%; left: 10%;">🌻</span>
    <span class="flower" style="top: 80%; left: 85%;">🌷</span>
    <span class="flower" style="top: 40%; left: 95%;">🌼</span>
</div>
<?php include 'includes/footer.php'; ?>
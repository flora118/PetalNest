<?php
$title = 'Flower Subscription - PetalNest';
include 'includes/header.php';
?>
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
                <div class="progress-bar">
                    <div class="progress-fill" data-width="75"></div>
                </div>
                <p class="subscription-popular">75% of subscribers choose this plan</p>
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
                <div class="progress-bar">
                    <div class="progress-fill" data-width="90"></div>
                </div>
                <p class="subscription-popular">90% customer satisfaction rate</p>
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
                <div class="progress-bar">
                    <div class="progress-fill" data-width="60"></div>
                </div>
                <p class="subscription-popular">Perfect for special occasions</p>
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
<?php include 'includes/footer.php'; ?>
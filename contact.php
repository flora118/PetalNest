<?php
$title = 'Contact Us - PetalNest';
include 'includes/header.php';
include_once 'includes/functions.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));
    
    // Here you would typically send an email or save to database
    // For now, we'll just show a success message
    $success = "Thank you, $name! 💌 We've received your message and will get back to you soon.";
}
?>
<section class="contact-section">
    <div class="container">
        <h2 class="section-title">Get in Touch</h2>
        <p style="text-align: center; margin-bottom: 40px; font-size: 1.2em;">We'd love to hear from you!</p>
        
        <div class="contact-grid">
            <div class="contact-info">
                <h3>Contact Information</h3>
                <img src="assets/images/misc/mahi.jpg" alt="Tasfika Hasan Mahi" style="width: 100%; border-radius: 15px; margin-bottom: 20px;">
                <div class="contact-item">
                    <i class="fas fa-user"></i>
                    <div>
                        <h4>Tasfika Hasan Mahi</h4>
                        <p>Founder & CEO</p>
                    </div>
                </div>
                <div class="contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <h4>Address</h4>
                        <p>123 Flower Street, Dhaka, Bangladesh</p>
                    </div>
                </div>
                <div class="contact-item">
                    <i class="fas fa-phone"></i>
                    <div>
                        <h4>Phone</h4>
                        <p>+880 1234 567890</p>
                    </div>
                </div>
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <h4>Email</h4>
                        <p>mahi.chy@gmail.com</p>
                    </div>
                </div>
                <div class="contact-item">
                    <i class="fas fa-clock"></i>
                    <div>
                        <h4>Business Hours</h4>
                        <p>Mon-Fri: 9AM - 6PM<br>Sat: 10AM - 4PM<br>Sun: Closed</p>
                    </div>
                </div>
            </div>
            
            <div class="contact-form">
                <h3>Send us a Message</h3>
                <?php if (isset($success)): ?>
                    <div class="success-message"><?= $success ?></div>
                <?php endif; ?>
                <form method="POST">
                    <div class="form-group">
                        <label>Your Name *</label>
                        <input type="text" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>Email Address *</label>
                        <input type="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label>Message *</label>
                        <textarea name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="cta-btn">Send Message</button>
                </form>
            </div>
        </div>
        
        <div class="map-section">
            <h3>Find Us on Map</h3>
            <div class="map-container">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.123456789!2d90.123456789!3d23.123456789!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMDD!5s123456789!5e0!3m2!1sen!2sbd" 
                    width="100%" 
                    height="400" 
                    style="border:0; border-radius: 15px;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
            <div class="map-info">
                <h4>Our Location</h4>
                <p><i class="fas fa-map-marker-alt"></i> 123 Flower Street, Dhaka, Bangladesh</p>
                <p><i class="fas fa-clock"></i> Open: Mon-Fri 9AM-6PM, Sat 10AM-4PM</p>
                <a href="https://maps.google.com/?q=123+Flower+Street,+Dhaka,+Bangladesh" target="_blank" class="btn">Get Directions</a>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
<?php
include 'db.php';
include 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'PetalNest' ?> - Bloom Buy & Grow</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/images/favicon.png">
</head>
<body>
<!-- Loading Screen -->
<div class="loader" id="loader">
    <div class="loader-content">
        <div class="flower-loader">🌸</div>
        <p>Loading PetalNest...</p>
    </div>
</div>
<header class="main-header">
    <div class="header-top">
        <div class="container">
            <div class="contact-info">
                <span><i class="fas fa-phone"></i> +880 1234 567890</span>
                <span><i class="fas fa-envelope"></i> support@petalnest.com</span>
            </div>
            <div class="social-links">
                <a href="https://www.facebook.com/share/1768uwNwxg/" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/ayesha454907?igsh=aWZ0M2JqaXV0cHRt" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://wa.me/01324534714" target="_blank"><i class="fab fa-whatsapp"></i></a>
            </div>
        </div>
    </div>
    <div class="header-main">
        <div class="container">
            <div class="logo">
                <h1><i class="fas fa-seedling"></i> PetalNest</h1>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="products.php"><i class="fas fa-leaf"></i> Products</a></li>
                    <li><a href="subscription.php"><i class="fas fa-box"></i> Subscription</a></li>
                    <li><a href="virtual-arrangement.php"><i class="fas fa-paint-brush"></i> Arrange</a></li>
                    <li><a href="review.php"><i class="fas fa-star"></i> Reviews</a></li>
                    <li><a href="contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
                    <?php if (is_logged_in()): ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle"><i class="fas fa-user"></i> Account</a>
                            <ul class="dropdown-menu">
                                <li><a href="user/profile.php"><i class="fas fa-user"></i> Profile</a></li>
                                <li><a href="user/orders.php"><i class="fas fa-shopping-bag"></i> My Orders</a></li>
                                <li><a href="user/care-reminders.php"><i class="fas fa-bell"></i> Care Reminders</a></li>
                                <li><a href="user/settings.php"><i class="fas fa-cog"></i> Settings</a></li>
                                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li><a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                        <li><a href="register.php"><i class="fas fa-user-plus"></i> Register</a></li>
                    <?php endif; ?>
                    <li><a href="wishlist.php"><i class="fas fa-heart"></i> (<?= wishlist_count() ?>)</a></li>
                    <li><a href="cart.php"><i class="fas fa-shopping-cart"></i> (<?= cart_count() ?>)</a></li>
                </ul>
            </nav>
            <div class="theme-toggle">
                <button id="theme-btn"><i class="fas fa-moon"></i></button>
            </div>
        </div>
    </div>
</header>
<!-- Greeting Message -->
<div class="greeting-message">
    <div class="container">
        <p id="greeting-text">Welcome to PetalNest! 🌸</p>
    </div>
</div>
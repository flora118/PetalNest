<?php
include 'db.php';

// Function declarations with existence checks
if (!function_exists('redirect')) {
    function redirect($url) {
        header("Location: $url");
        exit;
    }
}

if (!function_exists('is_logged_in')) {
    function is_logged_in() {
        return isset($_SESSION['user']);
    }
}

if (!function_exists('sanitize')) {
    function sanitize($str) {
        global $conn;
        return $conn->real_escape_string($str);
    }
}

if (!function_exists('get_product')) {
    function get_product($id) {
        global $conn;
        $id = (int)$id;
        $res = $conn->query("SELECT * FROM products WHERE id = $id");
        return $res->fetch_assoc();
    }
}

if (!function_exists('get_user_orders')) {
    function get_user_orders($user_id) {
        global $conn;
        $user_id = (int)$user_id;
        return $conn->query("SELECT * FROM orders WHERE user_id = $user_id ORDER BY created_at DESC");
    }
}

if (!function_exists('send_email')) {
    function send_email($to, $subject, $body) {
        $headers = "From: no-reply@petalnest.com\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        return mail($to, $subject, $body, $headers);
    }
}

if (!function_exists('cart_count')) {
    function cart_count() {
        return array_sum($_SESSION['cart'] ?? []);
    }
}

if (!function_exists('wishlist_count')) {
    function wishlist_count() {
        return count($_SESSION['wishlist'] ?? []);
    }
}
?>
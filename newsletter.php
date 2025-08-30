<?php
include 'includes/db.php';
$success = $error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $stmt = $conn->prepare("INSERT INTO newsletter_subscribers (email) VALUES (?)");
        $stmt->bind_param("s", $email);
        
        if ($stmt->execute()) {
            $success = "Thank you for subscribing to our newsletter!";
        } else {
            $error = "This email is already subscribed.";
        }
        $stmt->close();
    } else {
        $error = "Please enter a valid email address.";
    }
}
// Redirect back to referring page
$referer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
header("Location: $referer");
exit;
?>
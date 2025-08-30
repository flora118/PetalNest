<?php
$title = 'Login - PetalNest';
include 'includes/header.php';
include_once 'includes/functions.php';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_input = trim($_POST['user_input']);
    $password = $_POST['password'];
    if ($user_input && $password) {
        $s = sanitize($user_input);
        $res = $conn->query("SELECT * FROM users WHERE username='$s' OR email='$s' LIMIT 1");
        if ($res && $res->num_rows) {
            $u = $res->fetch_assoc();
            if (password_verify($password, $u['password_hash'])) {
                $_SESSION['user'] = ['id' => $u['id'], 'username' => $u['username'], 'email' => $u['email']];
                redirect('index.php');
            } else {
                $errors[] = "Invalid password";
            }
        } else {
            $errors[] = "User not found";
        }
    } else {
        $errors[] = "Fill both fields";
    }
}
?>
<main class="auth-page">
    <div class="auth-container">
        <h2><i class="fas fa-sign-in-alt"></i> Login to Your Account</h2>
        
        <?php foreach ($errors as $e): ?>
            <div class="error-message"><?= $e ?></div>
        <?php endforeach; ?>
        
        <form method="POST">
            <input type="text" name="user_input" placeholder="Username or Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="cta-btn">Login</button>
        </form>
        
        <p>Don't have an account? <a href="register.php">Register here</a></p>
        <p><a href="forgot-password.php">Forgot password?</a></p>
    </div>
</main>
<?php include 'includes/footer.php'; ?>
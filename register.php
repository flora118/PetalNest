<?php
$title = 'Register - PetalNest';
include 'includes/header.php';
include_once 'includes/functions.php';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];
    if ($username && $email && $pass && $cpass) {
        if ($pass !== $cpass) {
            $errors[] = "Passwords do not match";
        } else {
            // Check if user already exists
            $check_user = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
            $check_user->bind_param("ss", $username, $email);
            $check_user->execute();
            $result = $check_user->get_result();
            
            if ($result->num_rows > 0) {
                $errors[] = "Username or email already exists";
            } else {
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO users (username, email, password_hash) VALUES (?,?,?)");
                $stmt->bind_param("sss", $username, $email, $hash);
                if ($stmt->execute()) {
                    $_SESSION['user'] = ['id' => $stmt->insert_id, 'username' => $username, 'email' => $email];
                    redirect('index.php');
                } else {
                    $errors[] = "Registration failed. Please try again.";
                }
                $stmt->close();
            }
            $check_user->close();
        }
    } else {
        $errors[] = "All fields are required";
    }
}
?>
<main class="auth-page">
    <div class="auth-container">
        <h2><i class="fas fa-user-plus"></i> Create New Account</h2>
        
        <?php foreach ($errors as $e): ?>
            <div class="error-message"><?= $e ?></div>
        <?php endforeach; ?>
        
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="cpassword" placeholder="Confirm Password" required>
            <button type="submit" class="cta-btn">Register</button>
        </form>
        
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</main>
<?php include 'includes/footer.php'; ?>
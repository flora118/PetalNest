<?php
$title = 'Account Settings - PetalNest';
include '../includes/header.php';
include_once '../includes/functions.php';
if (!is_logged_in()) {
    redirect('../login.php');
}
$user = $_SESSION['user'];
$success = $error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current = $_POST['current_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];
    if ($current && $new && $confirm) {
        $res = $conn->query("SELECT password_hash FROM users WHERE id = " . (int)$user['id']);
        $u = $res->fetch_assoc();
        if (password_verify($current, $u['password_hash']) && $new === $confirm) {
            $hash = password_hash($new, PASSWORD_DEFAULT);
            $conn->query("UPDATE users SET password_hash = '$hash' WHERE id = " . (int)$user['id']);
            $success = "Password updated successfully!";
        } else {
            $error = "Current password is incorrect or new passwords do not match.";
        }
    } else {
        $error = "All fields are required.";
    }
}
?>
<section class="settings-section">
    <div class="container">
        <h2 class="section-title">Account Settings</h2>
        
        <?php if ($success): ?>
            <div class="success-message"><?= $success ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="error-message"><?= $error ?></div>
        <?php endif; ?>
        <div class="settings-grid">
            <div class="settings-sidebar">
                <h3>Settings</h3>
                <div class="settings-menu">
                    <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
                    <a href="orders.php"><i class="fas fa-shopping-bag"></i> My Orders</a>
                    <a href="settings.php" class="active"><i class="fas fa-cog"></i> Settings</a>
                    <a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
            
            <div class="settings-content">
                <h3>Change Password</h3>
                <form method="POST">
                    <div class="form-group">
                        <label>Current Password *</label>
                        <input type="password" name="current_password" required>
                    </div>
                    <div class="form-group">
                        <label>New Password *</label>
                        <input type="password" name="new_password" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm New Password *</label>
                        <input type="password" name="confirm_password" required>
                    </div>
                    <button type="submit" class="cta-btn">Update Password</button>
                </form>
            </div>
        </div>
    </div>
</section>
<?php include '../includes/footer.php'; ?>
<?php
$title = 'My Profile - PetalNest';
include '../includes/header.php';
include_once '../includes/functions.php';
if (!is_logged_in()) {
    redirect('../login.php');
}
$user = $_SESSION['user'];
$success = $error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    if ($username && $email) {
        $stmt = $conn->prepare("UPDATE users SET username=?, email=?, phone=?, address=? WHERE id=?");
        $stmt->bind_param("ssssi", $username, $email, $phone, $address, $user['id']);
        if ($stmt->execute()) {
            $_SESSION['user']['username'] = $username;
            $_SESSION['user']['email'] = $email;
            $success = "Profile updated successfully!";
        } else {
            $error = "Failed to update profile.";
        }
        $stmt->close();
    } else {
        $error = "Username and Email are required.";
    }
}
// Load user details
$res = $conn->query("SELECT * FROM users WHERE id = " . (int)$user['id']);
$user = $res->fetch_assoc();
?>
<section class="profile-section">
    <div class="container">
        <h2 class="section-title">My Profile</h2>
        
        <?php if ($success): ?>
            <div class="success-message"><?= $success ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="error-message"><?= $error ?></div>
        <?php endif; ?>
        <div class="profile-grid">
            <div class="profile-sidebar">
                <div class="profile-avatar">
                    <img src="<?= htmlspecialchars($user['profile_pic']) ?>" alt="Profile Picture">
                    <h3><?= htmlspecialchars($user['username']) ?></h3>
                    <p><?= htmlspecialchars($user['email']) ?></p>
                </div>
                <div class="profile-menu">
                    <a href="profile.php" class="active"><i class="fas fa-user"></i> Profile</a>
                    <a href="orders.php"><i class="fas fa-shopping-bag"></i> My Orders</a>
                    <a href="settings.php"><i class="fas fa-cog"></i> Settings</a>
                    <a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
            
            <div class="profile-content">
                <h3>Edit Profile</h3>
                <form method="POST">
                    <div class="form-group">
                        <label>Username *</label>
                        <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Email Address *</label>
                        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="tel" name="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="address"><?= htmlspecialchars($user['address'] ?? '') ?></textarea>
                    </div>
                    <button type="submit" class="cta-btn">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
</section>
<?php include '../includes/footer.php'; ?>
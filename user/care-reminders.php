<?php
$title = 'Flower Care Reminders - PetalNest';
include '../includes/header.php';
include_once '../includes/functions.php';
if (!is_logged_in()) {
    redirect('../login.php');
}
$user = $_SESSION['user'];
$success = $error = '';
// Add new reminder
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_reminder'])) {
    $product_id = (int)$_POST['product_id'];
    $reminder_type = $_POST['reminder_type'];
    $reminder_date = $_POST['reminder_date'];
    $frequency = (int)$_POST['frequency'];
    
    $stmt = $conn->prepare("INSERT INTO care_reminders (user_id, product_id, reminder_type, reminder_date, frequency) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iissi", $user['id'], $product_id, $reminder_type, $reminder_date, $frequency);
    
    if ($stmt->execute()) {
        $success = "Reminder added successfully!";
    } else {
        $error = "Failed to add reminder.";
    }
    $stmt->close();
}
// Mark reminder as completed
if (isset($_GET['complete'])) {
    $reminder_id = (int)$_GET['complete'];
    $conn->query("UPDATE care_reminders SET is_completed = TRUE WHERE id = $reminder_id AND user_id = {$user['id']}");
    redirect('care-reminders.php');
}
// Delete reminder
if (isset($_GET['delete'])) {
    $reminder_id = (int)$_GET['delete'];
    $conn->query("DELETE FROM care_reminders WHERE id = $reminder_id AND user_id = {$user['id']}");
    redirect('care-reminders.php');
}
// Fetch user's products
$products = $conn->query("SELECT * FROM products WHERE id IN (SELECT product_id FROM order_items WHERE order_id IN (SELECT id FROM orders WHERE user_id = {$user['id']}))");
// Fetch reminders
$reminders = $conn->query("SELECT r.*, p.name, p.image FROM care_reminders r JOIN products p ON r.product_id = p.id WHERE r.user_id = {$user['id']} ORDER BY r.reminder_date ASC");
?>
<section class="care-reminders-section">
    <div class="container">
        <h2 class="section-title">Flower Care Reminders 🔔</h2>
        <p class="section-subtitle">Never forget to care for your plants and flowers</p>
        
        <?php if ($success): ?>
            <div class="success-message"><?= $success ?></div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="error-message"><?= $error ?></div>
        <?php endif; ?>
        
        <div class="tabs">
            <div class="tab active" data-tab="upcoming">Upcoming</div>
            <div class="tab" data-tab="completed">Completed</div>
            <div class="tab" data-tab="add-new">Add New</div>
        </div>
        
        <div id="upcoming" class="tab-content active">
            <h3>Your Upcoming Reminders</h3>
            
            <?php if ($reminders->num_rows == 0): ?>
                <div class="empty-state">
                    <i class="fas fa-bell-slash"></i>
                    <h3>No upcoming reminders</h3>
                    <p>Add a new reminder to get started</p>
                    <button class="btn" onclick="document.querySelector('[data-tab=\"add-new\"]').click()">Add Reminder</button>
                </div>
            <?php else: ?>
                <div class="reminders-grid">
                    <?php while ($reminder = $reminders->fetch_assoc()): ?>
                        <?php if (!$reminder['is_completed']): ?>
                            <div class="care-reminder">
                                <div class="care-reminder-icon">
                                    <?php
                                    switch ($reminder['reminder_type']) {
                                        case 'watering': echo '💧'; break;
                                        case 'fertilizing': echo '🌱'; break;
                                        case 'pruning': echo '✂️'; break;
                                        case 'repotting': echo '🪴'; break;
                                        default: echo '🌿';
                                    }
                                    ?>
                                </div>
                                <div class="care-reminder-content">
                                    <div class="care-reminder-title">
                                        <?= ucfirst($reminder['reminder_type']) ?> for <?= htmlspecialchars($reminder['name']) ?>
                                    </div>
                                    <div class="care-reminder-date">
                                        Due: <?= date('M d, Y', strtotime($reminder['reminder_date'])) ?>
                                    </div>
                                    <div class="care-reminder-frequency">
                                        Repeats every <?= $reminder['frequency'] ?> days
                                    </div>
                                </div>
                                <div class="care-reminder-actions">
                                    <a href="?complete=<?= $reminder['id'] ?>" class="btn">Complete</a>
                                    <a href="?delete=<?= $reminder['id'] ?>" class="btn delete">Delete</a>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
        
        <div id="completed" class="tab-content">
            <h3>Completed Reminders</h3>
            
            <?php 
            $reminders->data_seek(0);
            $hasCompleted = false;
            
            while ($reminder = $reminders->fetch_assoc()): ?>
                <?php if ($reminder['is_completed']): 
                    $hasCompleted = true;
                ?>
                    <div class="care-reminder completed">
                        <div class="care-reminder-icon">
                            <?php
                            switch ($reminder['reminder_type']) {
                                case 'watering': echo '💧'; break;
                                case 'fertilizing': echo '🌱'; break;
                                case 'pruning': echo '✂️'; break;
                                case 'repotting': echo '🪴'; break;
                                default: echo '🌿';
                            }
                            ?>
                        </div>
                        <div class="care-reminder-content">
                            <div class="care-reminder-title">
                                <?= ucfirst($reminder['reminder_type']) ?> for <?= htmlspecialchars($reminder['name']) ?>
                            </div>
                            <div class="care-reminder-date">
                                Completed on: <?= date('M d, Y', strtotime($reminder['reminder_date'])) ?>
                            </div>
                        </div>
                        <div class="care-reminder-actions">
                            <a href="?delete=<?= $reminder['id'] ?>" class="btn delete">Delete</a>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endwhile; ?>
            
            <?php if (!$hasCompleted): ?>
                <div class="empty-state">
                    <i class="fas fa-check-circle"></i>
                    <h3>No completed reminders</h3>
                    <p>Complete some reminders to see them here</p>
                </div>
            <?php endif; ?>
        </div>
        
        <div id="add-new" class="tab-content">
            <h3>Add New Reminder</h3>
            
            <form method="POST" class="reminder-form">
                <div class="form-group">
                    <label>Select Product</label>
                    <select name="product_id" required>
                        <option value="">Choose a product</option>
                        <?php while ($product = $products->fetch_assoc()): ?>
                            <option value="<?= $product['id'] ?>"><?= htmlspecialchars($product['name']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Reminder Type</label>
                    <select name="reminder_type" required>
                        <option value="watering">Watering</option>
                        <option value="fertilizing">Fertilizing</option>
                        <option value="pruning">Pruning</option>
                        <option value="repotting">Repotting</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Reminder Date</label>
                    <input type="date" name="reminder_date" required>
                </div>
                
                <div class="form-group">
                    <label>Frequency (days)</label>
                    <input type="number" name="frequency" min="1" value="7" required>
                </div>
                
                <button type="submit" name="add_reminder" class="btn">Add Reminder</button>
            </form>
            
            <div class="care-tips">
                <h3>Flower Care Tips</h3>
                <div class="tips-grid">
                    <div class="tip-card">
                        <div class="tip-icon">💧</div>
                        <h4>Watering</h4>
                        <p>Most plants need water when the top inch of soil feels dry. Overwatering is a common cause of plant death.</p>
                    </div>
                    <div class="tip-card">
                        <div class="tip-icon">🌱</div>
                        <h4>Fertilizing</h4>
                        <p>Fertilize during the growing season (spring and summer) with a balanced fertilizer every 2-4 weeks.</p>
                    </div>
                    <div class="tip-card">
                        <div class="tip-icon">✂️</div>
                        <h4>Pruning</h4>
                        <p>Remove dead or yellowing leaves to encourage new growth and improve air circulation.</p>
                    </div>
                    <div class="tip-card">
                        <div class="tip-icon">🪴</div>
                        <h4>Repotting</h4>
                        <p>Repot plants when they outgrow their containers, usually every 1-2 years depending on the plant.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include '../includes/footer.php'; ?>
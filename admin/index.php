<?php
session_start();
include '../includes/db.php';
if (!isset($_SESSION['user']) || $_SESSION['user']['username'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}
// Fetch dashboard stats
$total_products = $conn->query("SELECT COUNT(*) as count FROM products")->fetch_assoc()['count'];
$total_users = $conn->query("SELECT COUNT(*) as count FROM users")->fetch_assoc()['count'];
$total_orders = $conn->query("SELECT COUNT(*) as count FROM orders")->fetch_assoc()['count'];
$recent_orders = $conn->query("SELECT * FROM orders ORDER BY created_at DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - PetalNest</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .admin-dashboard {
            padding: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .admin-header h1 {
            color: #ff1493;
        }
        .admin-nav a {
            margin: 0 10px;
            padding: 8px 15px;
            background: #ff1493;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: 0.3s;
        }
        .admin-nav a:hover {
            background: #ff69b4;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .stat-card h3 {
            margin: 0;
            color: #006400;
        }
        .stat-card p {
            font-size: 2em;
            margin: 10px 0 0;
            color: #ff1493;
        }
        .recent-orders {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .recent-orders h3 {
            margin-top: 0;
            color: #ff1493;
        }
        .recent-orders table {
            width: 100%;
            border-collapse: collapse;
        }
        .recent-orders th, .recent-orders td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        .recent-orders th {
            background: #ffe6f0;
        }
    </style>
</head>
<body>
<div class="admin-dashboard">
    <div class="admin-header">
        <h1>🌸 Admin Dashboard</h1>
        <nav class="admin-nav">
            <a href="products.php">Products</a>
            <a href="users.php">Users</a>
            <a href="orders.php">Orders</a>
            <a href="../logout.php">Logout</a>
        </nav>
    </div>
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Total Products</h3>
            <p><?= $total_products ?></p>
        </div>
        <div class="stat-card">
            <h3>Total Users</h3>
            <p><?= $total_users ?></p>
        </div>
        <div class="stat-card">
            <h3>Total Orders</h3>
            <p><?= $total_orders ?></p>
        </div>
    </div>
    <div class="recent-orders">
        <h3>Recent Orders</h3>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Email</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($order = $recent_orders->fetch_assoc()): ?>
                    <tr>
                        <td>#<?= sprintf("%05d", $order['id']) ?></td>
                        <td><?= htmlspecialchars($order['name']) ?></td>
                        <td><?= htmlspecialchars($order['email']) ?></td>
                        <td>$<?= number_format($order['total'], 2) ?></td>
                        <td><?= ucfirst($order['status']) ?></td>
                        <td><?= date('d M Y', strtotime($order['created_at'])) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
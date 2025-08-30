<?php
session_start();
include '../includes/db.php';
if (!isset($_SESSION['user']) || $_SESSION['user']['username'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM orders WHERE id = $id");
    $conn->query("DELETE FROM order_items WHERE order_id = $id");
    header("Location: orders.php");
    exit;
}
$orders = $conn->query("SELECT * FROM orders ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders - PetalNest Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .admin-container {
            padding: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .admin-header {
            display: flex;
            justify-content: space-between;
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
        .table-section {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .table-section table {
            width: 100%;
            border-collapse: collapse;
        }
        .table-section th, .table-section td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        .table-section th {
            background: #ffe6f0;
        }
        .action-btns a {
            margin-right: 5px;
            padding: 4px 8px;
            background: #ff1493;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 0.9em;
        }
        .action-btns a.delete {
            background: #ff4d4d;
        }
    </style>
</head>
<body>
<div class="admin-container">
    <div class="admin-header">
        <h1>📦 Manage Orders</h1>
        <nav class="admin-nav">
            <a href="index.php">Dashboard</a>
            <a href="products.php">Products</a>
            <a href="users.php">Users</a>
            <a href="../logout.php">Logout</a>
        </nav>
    </div>
    <div class="table-section">
        <h3>All Orders</h3>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Email</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($o = $orders->fetch_assoc()): ?>
                    <tr>
                        <td>#<?= sprintf("%05d", $o['id']) ?></td>
                        <td><?= htmlspecialchars($o['name']) ?></td>
                        <td><?= htmlspecialchars($o['email']) ?></td>
                        <td>$<?= number_format($o['total'], 2) ?></td>
                        <td><?= ucfirst($o['status']) ?></td>
                        <td><?= date('d M Y', strtotime($o['created_at'])) ?></td>
                        <td class="action-btns">
                            <a href="?delete=<?= $o['id'] ?>" class="delete" onclick="return confirm('Delete this order?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
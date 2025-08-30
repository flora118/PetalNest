<?php
session_start();
include '../includes/db.php';
if (!isset($_SESSION['user']) || $_SESSION['user']['username'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}
$success = $error = '';
// Add product
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = (float)$_POST['price'];
    $stock = (int)$_POST['stock'];
    $category = $_POST['category'];
    $badge = $_POST['badge'];
    $tips = trim($_POST['tips']);
    if ($name && $price && $stock) {
        $image = 'assets/images/default.jpg';
        if (!empty($_FILES['image']['name'])) {
            $image = 'assets/images/' . time() . '_' . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], '../' . $image);
        }
        $stmt = $conn->prepare("INSERT INTO products (name, description, price, stock, image, category, badge, tips) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdisssi", $name, $description, $price, $stock, $image, $category, $badge, $tips);
        if ($stmt->execute()) {
            $success = "Product added successfully!";
        } else {
            $error = "Failed to add product.";
        }
        $stmt->close();
    } else {
        $error = "Name, price, and stock are required.";
    }
}
// Delete product
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM products WHERE id = $id");
    header("Location: products.php");
    exit;
}
// Fetch products
$products = $conn->query("SELECT * FROM products ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products - PetalNest Admin</title>
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
        .form-section, .table-section {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .form-section h3, .table-section h3 {
            margin-top: 0;
            color: #ff1493;
        }
        .form-section input, .form-section textarea, .form-section select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }
        .form-section button {
            background: #ff1493;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
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
        .table-section img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
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
        <h1>🌸 Manage Products</h1>
        <nav class="admin-nav">
            <a href="index.php">Dashboard</a>
            <a href="users.php">Users</a>
            <a href="orders.php">Orders</a>
            <a href="../logout.php">Logout</a>
        </nav>
    </div>
    <?php if ($success): ?>
        <div class="success-message"><?= $success ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="error-message"><?= $error ?></div>
    <?php endif; ?>
    <div class="form-section">
        <h3>Add New Product</h3>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Product Name" required>
            <textarea name="description" placeholder="Description"></textarea>
            <input type="number" step="0.01" name="price" placeholder="Price" required>
            <input type="number" name="stock" placeholder="Stock" required>
            <select name="category" required>
                <option value="flower">Flower</option>
                <option value="plant">Plant</option>
            </select>
            <select name="badge">
                <option value="">No Badge</option>
                <option value="new">New</option>
                <option value="seasonal">Seasonal</option>
                <option value="bestseller">Bestseller</option>
                <option value="out_of_stock">Out of Stock</option>
                <option value="premium">Premium</option>
            </select>
            <textarea name="tips" placeholder="Care Tips"></textarea>
            <input type="file" name="image" accept="image/*">
            <button type="submit" name="add">Add Product</button>
        </form>
    </div>
    <div class="table-section">
        <h3>All Products</h3>
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Category</th>
                    <th>Badge</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($p = $products->fetch_assoc()): ?>
                    <tr>
                        <td><img src="../<?= htmlspecialchars($p['image']) ?>" alt=""></td>
                        <td><?= htmlspecialchars($p['name']) ?></td>
                        <td>$<?= number_format($p['price'], 2) ?></td>
                        <td><?= $p['stock'] ?></td>
                        <td><?= ucfirst($p['category']) ?></td>
                        <td><?= $p['badge'] ? ucfirst($p['badge']) : 'None' ?></td>
                        <td class="action-btns">
                            <a href="edit_product.php?id=<?= $p['id'] ?>">Edit</a>
                            <a href="?delete=<?= $p['id'] ?>" class="delete" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
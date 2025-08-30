<?php
session_start();
include '../includes/db.php';
if (!isset($_SESSION['user']) || $_SESSION['user']['username'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}
$id = (int)$_GET['id'];
$product = $conn->query("SELECT * FROM products WHERE id = $id")->fetch_assoc();
$success = $error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = (float)$_POST['price'];
    $stock = (int)$_POST['stock'];
    $category = $_POST['category'];
    $badge = $_POST['badge'];
    $tips = trim($_POST['tips']);
    if ($name && $price && $stock) {
        $image = $product['image'];
        if (!empty($_FILES['image']['name'])) {
            $image = 'assets/images/' . time() . '_' . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], '../' . $image);
        }
        $stmt = $conn->prepare("UPDATE products SET name=?, description=?, price=?, stock=?, image=?, category=?, badge=?, tips=? WHERE id=?");
        $stmt->bind_param("ssdissssi", $name, $description, $price, $stock, $image, $category, $badge, $tips, $id);
        if ($stmt->execute()) {
            $success = "Product updated successfully!";
        } else {
            $error = "Failed to update product.";
        }
        $stmt->close();
    } else {
        $error = "Name, price, and stock are required.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - PetalNest Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .admin-container {
            padding: 30px;
            max-width: 800px;
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
        .form-section {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .form-section h3 {
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
        .current-image {
            margin-bottom: 15px;
        }
        .current-image img {
            max-width: 200px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
<div class="admin-container">
    <div class="admin-header">
        <h1>✏️ Edit Product</h1>
        <nav class="admin-nav">
            <a href="products.php">Back to Products</a>
            <a href="index.php">Dashboard</a>
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
        <h3>Edit Product</h3>
        <form method="POST" enctype="multipart/form-data">
            <div class="current-image">
                <p>Current Image:</p>
                <img src="../<?= htmlspecialchars($product['image']) ?>" alt="">
            </div>
            <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
            <textarea name="description"><?= htmlspecialchars($product['description']) ?></textarea>
            <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>" required>
            <input type="number" name="stock" value="<?= $product['stock'] ?>" required>
            <select name="category" required>
                <option value="flower" <?= $product['category'] == 'flower' ? 'selected' : '' ?>>Flower</option>
                <option value="plant" <?= $product['category'] == 'plant' ? 'selected' : '' ?>>Plant</option>
            </select>
            <select name="badge">
                <option value="">No Badge</option>
                <option value="new" <?= $product['badge'] == 'new' ? 'selected' : '' ?>>New</option>
                <option value="seasonal" <?= $product['badge'] == 'seasonal' ? 'selected' : '' ?>>Seasonal</option>
                <option value="bestseller" <?= $product['badge'] == 'bestseller' ? 'selected' : '' ?>>Bestseller</option>
                <option value="out_of_stock" <?= $product['badge'] == 'out_of_stock' ? 'selected' : '' ?>>Out of Stock</option>
                <option value="premium" <?= $product['badge'] == 'premium' ? 'selected' : '' ?>>Premium</option>
            </select>
            <textarea name="tips"><?= htmlspecialchars($product['tips']) ?></textarea>
            <input type="file" name="image" accept="image/*">
            <button type="submit" name="update">Update Product</button>
        </form>
    </div>
</div>
</body>
</html>
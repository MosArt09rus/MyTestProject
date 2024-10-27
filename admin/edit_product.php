<?php
session_start();
require '../db/db.php';
include 'menu.php';

if (!isset($_SESSION['admin_logged_in'])) {
    if (!isset($_SESSION['moderator_logged_in'])) {
        header('Location: ../public/login.php');
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];

    $stmt = $pdo->prepare("UPDATE products SET name = ?, price = ?, description = ?, category_id = ? WHERE id = ?");
    $stmt->execute([$name, $price, $description, $category_id, $id]);

    header('Location: products.php');
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>">
        <label>Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required><br>
        <label>Price:</label>
        <input type="number" name="price" value="<?= htmlspecialchars($product['price']) ?>" required><br>
        <label>Description:</label>
        <textarea name="description" required><?= htmlspecialchars($product['description']) ?></textarea><br>
        <label>Category:</label>
        <select name="category_id" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?= htmlspecialchars($category['id']) ?>" <?= $category['id'] == $product['category_id'] ? 'selected' : '' ?>><?= htmlspecialchars($category['name']) ?></option>
            <?php endforeach; ?>
        </select><br>
        <button type="submit">Update Product</button>
    </form>
</body>
</html>

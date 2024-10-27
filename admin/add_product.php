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
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $id = 1;
    $stmt = $pdo->prepare("SELECT MAX(id) AS max_id FROM products");
        $stmt->execute();
        $result  = $stmt->fetch();
        if ($result['max_id'] >= $id) {
            $id = $result['max_id'] + 1;
        }
    $stmt = $pdo->prepare("INSERT INTO products (id, name,  description, price, category_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$id, $name, $description, $price, $category_id]);

    header('Location: ./products.php');
}

$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    
</head>
<body>
    <h1>Add Product</h1>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" required><br>
        <label>Price:</label>
        <input type="number" name="price" required><br>
        <label>Description:</label>
        <textarea name="description" required></textarea><br>
        <label>Category:</label>
        <select name="category_id" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
            <?php endforeach; ?>
        </select><br>
        <button type="submit">Add Product</button>
    </form>
</body>
</html>

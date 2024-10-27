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

$statement = $pdo->query("SELECT products.id, products.name, description, price, categories.name AS category_name FROM products JOIN categories ON category_id = categories.id");
$products = $statement->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Products</h1>
    <a href="add_product.php">Add Product</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product['id'] ?></td>
                    <td><?= $product['name'] ?></td>
                    <td><?= $product['price'] ?></td>
                    <td><?= $product['description'] ?></td>
                    <td><?= $product['category_name'] ?></td>
                    <td>
                        <a href="edit_product.php?id=<?= $product['id'] ?>">Edit</a>
                        <a href="delete_product.php?id=<?= $product['id'] ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

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

$statement = $pdo->query("SELECT * FROM categories");
$categories = $statement->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Categories</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Categories</h1>
    <a href="add_category.php">Add Category</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?= htmlspecialchars($category['id']) ?></td>
                    <td><?= htmlspecialchars($category['name']) ?></td>
                    <td>
                        <a href="edit_category.php?id=<?= htmlspecialchars($category['id']) ?>">Edit</a>
                        <a href="delete_category.php?id=<?= htmlspecialchars($category['id']) ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

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

    $stmt = $pdo->prepare("UPDATE categories SET name = ? WHERE id = ?");
    $stmt->execute([$name, $id]);

    header('Location: categories.php');
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM categories WHERE id = ?");
$stmt->execute([$id]);
$category = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Category</title>
</head>
<body>
    <h1>Edit Category</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($category['id']) ?>">
        <label>Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($category['name']) ?>" required><br>
        <button type="submit">Update Category</button>
    </form>
</body>
</html>

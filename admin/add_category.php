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
    $id = 1;
    $stmt = $pdo->prepare("SELECT MAX(id) AS max_id FROM categories");
        $stmt->execute();
        $result  = $stmt->fetch();
        if ($result['max_id'] >= $id) {
            $id = $result['max_id'] + 1;
        }

    $stmt = $pdo->prepare("INSERT INTO categories (id, name) VALUES (?, ?)");
    $stmt->execute([$id, $name]);

    header('Location: ./categories.php');
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Add Category</title>
</head>
<body>
    <h1>Add Category</h1>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" required><br>
        <button type="submit">Add Category</button>
    </form>
</body>
</html>

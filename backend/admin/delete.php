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

$type = $_GET['type'];

if ($type == "products") {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);

    header('Location: products.php');    
}
elseif ($type == "categories") {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM categories WHERE id = ?");
    $stmt->execute([$id]);

    header('Location: categories.php');
}
elseif ($type == "users" && isset($_SESSION['admin_logged_in'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);

    header('Location: users.php');
}
?>
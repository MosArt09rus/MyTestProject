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
include '../../frontend/admin/edit_product_form.php';
?>

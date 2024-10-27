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
include '../../frontend/admin/add_product_form.php';
?>
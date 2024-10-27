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

$statement = $pdo->query("SELECT products.id, products.name, description, price, categories.name AS category_name FROM products JOIN categories ON category_id = categories.id ORDER BY products.id");
$products = $statement->fetchAll();
include '../../frontend/admin/products_form.php';
?>

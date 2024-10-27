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
include '../../frontend/admin/categories_form.php';
?>
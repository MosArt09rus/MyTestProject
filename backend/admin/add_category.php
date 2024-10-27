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
include '../../frontend/admin/add_category_form.php';
?>
<?php
session_start();
require '../db/db.php';
include 'menu.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../public/login.php');
    exit;
}

$statement = $pdo->query("SELECT * FROM users");
$users = $statement->fetchAll();
include '../../frontend/admin/users_form.php';
?>
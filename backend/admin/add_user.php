<?php
session_start();
require '../db/db.php';
include 'menu.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../public/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $role = $_POST['role'];
    $password = md5($_POST['password']);
    $id = 1;
    $stmt = $pdo->prepare("SELECT MAX(id) AS max_id FROM users");
        $stmt->execute();
        $result  = $stmt->fetch();
        if ($result['max_id'] >= $id) {
            $id = $result['max_id'] + 1;
        }

    $stmt = $pdo->prepare("INSERT INTO users (id, login, userrole, password) VALUES (?, ?, ?, ?)");
    $stmt->execute([$id, $login, $role, $password]);

    header('Location: users.php');
}
include '../../frontend/admin/add_user_form.php';
?>
<?php
session_start();
require '../db/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = md5($_POST['password']);
    $id = 1;
    // Проверка на существование логина
    $stmt = $pdo->prepare("SELECT * FROM users WHERE login = ?");
    $stmt->execute([$login]);
    if ($stmt->rowCount() > 0) {
        $error = "Этот логин уже занят.";
    } else {
        $stmt = $pdo->prepare("SELECT MAX(id) AS max_id FROM users");
        $stmt->execute();
        $result  = $stmt->fetch();
        if ($result['max_id'] >= $id) {
            $id = $result['max_id'] + 1;
        }
        $stmt = $pdo->prepare("INSERT INTO users (id, login, password) VALUES (?, ?, ?)");
        $stmt->execute([$id, $login, $password]);
        $_SESSION['user_logged_in'] = true;
        $_SESSION['username'] = $user['login']; 
        header('Location: ../admin/index.php');
        exit;
    }
}
include '../../frontend/public/register_form.php'
?>

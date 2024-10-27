<?php
session_start();
require '../../backend/db/db.php';


unset($_SESSION['username']);
unset($_SESSION['admin_logged_in']);
unset($_SESSION['user_logged_in']);
unset($_SESSION['moderator_logged_in']);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = md5($_POST['password']);
    // Проверка логина и пароля
    $stmt = $pdo->prepare("SELECT * FROM users WHERE login = ? AND password = ?");
    $stmt->execute([$login, $password]);
    $user = $stmt->fetch();

    if ($user) {
        if ($user['userrole'] == "admin") {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['username'] = $user['login']; 
            header('Location: ../../backend/admin/index.php');
            exit;
        }
        elseif ($user['userrole'] == "moderator") {
            $_SESSION['moderator_logged_in'] = true;
            $_SESSION['username'] = $user['login']; 
            header('Location: ../../backend/admin/index.php');
            exit;
        }
        else {
            $_SESSION['user_logged_in'] = true;
            $_SESSION['username'] = $user['login'];
            header('Location: ../../backend/admin/index.php');
            exit;
        }    
    }
    else {
        $error = "Неверный логин или пароль.";
    }
}
include '../../frontend/public/login_form.php';
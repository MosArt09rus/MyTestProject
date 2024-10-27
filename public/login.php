<?php
session_start();
require '../db/db.php';


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
            header('Location: ../admin/index.php');
            exit;
        }
        elseif ($user['userrole'] == "moderator") {
            $_SESSION['moderator_logged_in'] = true;
            $_SESSION['username'] = $user['login']; 
            header('Location: ../admin/index.php');
            exit;
        }
        else {
            $_SESSION['user_logged_in'] = true;
            $_SESSION['username'] = $user['login'];
            header('Location: ../public/index.php');
            exit;
        }    
    }
    else {
        $error = "Неверный логин или пароль.";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
</head>
<body>
    <h1>Вход</h1>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="POST">
        <label>Логин:</label>
        <input type="text" name="login" required><br>
        <label>Пароль:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Войти</button>
    </form>
    <p>Нет аккаунта? <a href="./register.php">Зарегистрируйтесь</a></p>
</body>
</html>

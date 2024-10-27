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
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
    <h1>Регистрация</h1>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="POST">

        <label>Логин:</label>
        <input type="text" name="login" required><br>
        <label>Пароль:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Зарегистрироваться</button>
    </form>
    <p>Есть аккаунт? <a href="./login.php">Войдите</a></p>
</body>
</html>

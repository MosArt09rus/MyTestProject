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
    <p>Есть аккаунт? <a href="../../backend/public/login.php">Войдите</a></p>
</body>
</html>
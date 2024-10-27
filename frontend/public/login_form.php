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
    <p>Нет аккаунта? <a href="../../backend/public/register.php">Зарегистрируйтесь</a></p>
</body>
</html>
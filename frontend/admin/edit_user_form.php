<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
        <label>Login:</label>
        <input type="text" name="login" value="<?= htmlspecialchars($user['login']) ?>" required><br>
        <label>Role:</label>
        <input type="text" name="role" value="<?= htmlspecialchars($user['userrole']) ?>" required><br>
        <label>Password:</label>
        <input type="password" name="password"><br>
        <button type="submit">Update User</button>
    </form>
</body>
</html>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Users</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../../backend/js/confirmDelete.js"></script>
</head>
<body>
    <h1>Users</h1>
    <a href="add.php?type=users">Add User</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Login</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['login']) ?></td>
                    <td><?= htmlspecialchars($user['userrole']) ?></td>
                    <td>
                        <a href="edit.php?type=users&id=<?= htmlspecialchars($user['id']) ?>">Edit</a>
                        <a href="#" onclick="confirmDelete('delete.php?type=users&id=<?= htmlspecialchars($user['id']) ?>')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
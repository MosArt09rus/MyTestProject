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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Users</h1>
    <a href="add_user.php">Add User</a>
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
                        <a href="edit_user.php?id=<?= htmlspecialchars($user['id']) ?>">Edit</a>
                        <a href="delete_user.php?id=<?= htmlspecialchars($user['id']) ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

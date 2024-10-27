<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Categories</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Categories</h1>
    <a href="add_category.php">Add Category</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?= htmlspecialchars($category['id']) ?></td>
                    <td><?= htmlspecialchars($category['name']) ?></td>
                    <td>
                        <a href="edit_category.php?id=<?= htmlspecialchars($category['id']) ?>">Edit</a>
                        <a href="delete_category.php?id=<?= htmlspecialchars($category['id']) ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
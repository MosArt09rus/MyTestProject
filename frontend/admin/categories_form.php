<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Categories</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../../backend/js/confirmDelete.js"></script>
</head>
<body>
    <h1>Categories</h1>
    <a href="add.php?type=categories">Add Category</a>
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
                        <a href="edit.php?type=categories&id=<?= htmlspecialchars($category['id']) ?>">Edit</a>
                        <a href="#" onclick="confirmDelete('delete.php?type=categories&id=<?= htmlspecialchars($category['id']) ?>')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
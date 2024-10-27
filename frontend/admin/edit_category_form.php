<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Edit Category</title>
</head>
<body>
    <h1>Edit Category</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($category['id']) ?>">
        <label>Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($category['name']) ?>" required><br>
        <button type="submit">Update Category</button>
    </form>
</body>
</html>
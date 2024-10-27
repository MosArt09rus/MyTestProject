<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    
</head>
<body>
    <h1>Add Product</h1>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" required><br>
        <label>Price:</label>
        <input type="number" name="price" required><br>
        <label>Description:</label>
        <textarea name="description" required></textarea><br>
        <label>Category:</label>
        <select name="category_id" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
            <?php endforeach; ?>
        </select><br>
        <button type="submit">Add Product</button>
    </form>
</body>
</html>

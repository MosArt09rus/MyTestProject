<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>">
        <label>Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required><br>
        <label>Price:</label>
        <input type="number" name="price" value="<?= htmlspecialchars($product['price']) ?>" required><br>
        <label>Description:</label>
        <textarea name="description" required><?= htmlspecialchars($product['description']) ?></textarea><br>
        <label>Category:</label>
        <select name="category_id" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?= htmlspecialchars($category['id']) ?>" <?= $category['id'] == $product['category_id'] ? 'selected' : '' ?>><?= htmlspecialchars($category['name']) ?></option>
            <?php endforeach; ?>
        </select><br>
        <button type="submit">Update Product</button>
    </form>
</body>
</html>
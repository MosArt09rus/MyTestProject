<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <link rel="stylesheet" href="../../frontend/css/style.css">
    <script src="../../backend/js/confirmDelete.js"></script>
</head>
<body>
    <h1>Products</h1>
    <a href="CRUD.php?operation=add&type=products">Add Product</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product['id'] ?></td>
                    <td><?= $product['name'] ?></td>
                    <td><?= $product['price'] ?></td>
                    <td><?= $product['description'] ?></td>
                    <td><?= $product['category_name'] ?></td>
                    <td>
                        <a href="CRUD.php?operation=edit&type=products&id=<?= $product['id'] ?>">Edit</a>
                        <a href="#" onclick="confirmDelete('CRUD.php?operation=delete&type=products&id=<?= $product['id'] ?>')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

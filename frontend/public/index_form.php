
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>MySite</title>
    <link rel="stylesheet" href="../../frontend/css/style.css">
</head>
<body>
    <h1>Example</h1>
    <a href = "../../backend/public/login.php"><?php echo $_SESSION["reg_button"] ?></a>
    <?php ?>
    <?php echo $PublicIndexHTMLContent ?>
    <h1>Products</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Category</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product['name'] ?></td>
                    <td><?= $product['price'] ?></td>
                    <td><?= $product['description'] ?></td>
                    <td><?= $product['category_name'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
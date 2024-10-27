<?php
session_start();
if (!isset($_SESSION['user_logged_in'])) {
    $_SESSION['reg_button'] = "Войти";
    $PublicIndexHTMLContent = '<h3>Вы не вошли в систему</h3>';
    exit;
}
else {
    $_SESSION['reg_button'] = "Выйти";
    $role = "guest";
    $PublicIndexHTMLContent = '<h3>Добро пожаловать, ' . $_SESSION['username'] . '! <br> Ваша роль - '. $role . '</h3>';
}

require '../db/db.php';
$statement = $pdo->query("SELECT * FROM products");
$products = $statement->fetchAll();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>MySite</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Example</h1>
    <a href = "../public/login.php"><?php echo $_SESSION["reg_button"] ?></a>
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
                    <td><?= $product['category_id'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

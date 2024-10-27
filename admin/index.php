<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    if (isset($_SESSION['moderator_logged_in'])) {
        $_SESSION['reg_button'] = "Выйти";
        $AdminIndexHTMLContent = '<nav>
            <ul>
                <li><a href="products.php">Products</a></li>
                <li><a href="categories.php">Categories</a></li>
            </ul>
        </nav>';
        $role = "moderator";
    }
    elseif (!isset($_SESSION['user_logged_in'])) {
        header('Location: ../public/login.php');
        exit;
    }
    else {
        header('Location: ../public/index.php');
    }
}
else {
    $_SESSION['reg_button'] = "Выйти";
    $AdminIndexHTMLContent = '<nav>
        <ul>
            <li><a href="products.php">Products</a></li>
            <li><a href="categories.php">Categories</a></li>
            <li><a href="users.php">Users</a></li>
            <li><a href="../api/items_test.html">ItemsAPITest</a></li>
            <li><a href="../api/categories_test.html">CategoriesAPITest</a></li>
        </ul>
    </nav>';
    $role = "admin";
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Admin Panel</h1>
    <a href = "../public/login.php"><?php echo $_SESSION["reg_button"] ?></a>
    <h3>Добро пожаловать,  <?php echo $_SESSION['username'] ?>! <br> Ваша роль - <?php echo $role ?></h3>
    <?php echo $AdminIndexHTMLContent ?>
</body>
</html>

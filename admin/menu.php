<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    if (isset($_SESSION['moderator_logged_in'])) {
        $AdminMenuHTMLContent = '<div class="menu">
        <a href="products.php">Products</a>
        <a href="categories.php">Categories</a>
        <a href="./index.php">На главную</a>
    </div>';
    }
}
else {
    $AdminMenuHTMLContent = '<div class="menu">
        <a href="products.php">Products</a>
        <a href="users.php">Users</a>
        <a href="categories.php">Categories</a>
        <a href="./index.php">На главную</a>
    </div>';
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Меню</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .menu {
            display: flex;
            justify-content: center;
            margin-top: 25px;
            margin-bottom: 25px;
        }

        .menu a {
            margin: 0 10px;
            padding: 10px 20px;
            background-color: #f2f2f2;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
        }

        .menu a:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
   <?php echo $AdminMenuHTMLContent ?> 
</body>
</html>
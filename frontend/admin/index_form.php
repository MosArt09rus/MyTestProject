<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../../frontend/css/style.css">
</head>
<body>
    <h1>Admin Panel</h1>
    <a href = "../public/login.php"><?php echo $_SESSION["reg_button"] ?></a>
    <h3>Добро пожаловать,  <?php echo $_SESSION['username'] ?>! <br> Ваша роль - <?php echo $role ?></h3>
    <?php echo $AdminIndexHTMLContent ?>
</body>
</html>
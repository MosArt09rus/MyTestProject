<?php
session_start();
if (!isset($_SESSION['user_logged_in'])) {
    $_SESSION['reg_button'] = "Войти";
    $PublicIndexHTMLContent = '<h3>Вы не вошли в систему</h3>';
}
else {
    $_SESSION['reg_button'] = "Выйти";
    $role = "guest";
    $PublicIndexHTMLContent = '<h3>Добро пожаловать, ' . $_SESSION['username'] . '! <br> Ваша роль - '. $role . '</h3>';
}

require '../../backend/db/db.php';
$statement = $pdo->query("SELECT products.id, products.name, description, price, categories.name AS category_name FROM products JOIN categories ON category_id = categories.id");
$products = $statement->fetchAll();
include '../../frontend/public/index_form.php';
?>

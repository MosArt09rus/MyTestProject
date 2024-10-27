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
include '../../frontend/admin/menu_form.php';
?>
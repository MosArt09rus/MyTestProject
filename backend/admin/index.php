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
            <li><a href="../../frontend/api/items_test.html">ItemsAPITest</a></li>
            <li><a href="../../frontend/api/categories_test.html">CategoriesAPITest</a></li>
        </ul>
    </nav>';
    $role = "admin";
}
include '../../frontend/admin/index_form.php';
?>

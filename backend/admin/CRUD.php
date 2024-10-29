<?php
session_start();
require '../db/db.php';
include 'menu.php';
include 'admin_panel.php';

$adminPanel = new AdminPanel($pdo);

$operation = $_GET['operation'] ?? '';
$type = $_GET['type'] ?? '';
$id = $_GET['id'] ?? '';

if ($operation == "add") {
    if ($type == "products") {
        $CRUD_HTML_Content = $adminPanel->addProduct();
    } elseif ($type == "categories") {
        $CRUD_HTML_Content = $adminPanel->addCategory();
    } elseif ($type == "users" && isset($_SESSION['admin_logged_in'])) {
        $CRUD_HTML_Content = $adminPanel->addUser();
    }
}
elseif ($operation == "edit") {
    if ($type == "products") {
        $CRUD_HTML_Content = $adminPanel->editProduct($id);
    } elseif ($type == "categories") {
        $CRUD_HTML_Content = $adminPanel->editCategory($id);
    } elseif ($type == "users" && isset($_SESSION['admin_logged_in'])) {
        $CRUD_HTML_Content = $adminPanel->editUser($id);
    }
}
elseif ($operation == "delete") {
    if ($type == "products") {
        $adminPanel->deleteProduct($id);
    } elseif ($type == "categories") {
        $adminPanel->deleteCategory($id);
    } elseif ($type == "users" && isset($_SESSION['admin_logged_in'])) {
        $adminPanel->deleteUser($id);
    }
}
else echo "неизвестная операция";



include '../../frontend/admin/CRUD_form.php';
?>
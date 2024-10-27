<?php
session_start();
require '../db/db.php';
include 'menu.php';

if (!isset($_SESSION['admin_logged_in'])) {
    if (!isset($_SESSION['moderator_logged_in'])) {
        header('Location: ../public/login.php');
        exit;
    }
}

$type = $_GET['type'];

if ($type == "products") {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $category_id = $_POST['category_id'];
        $id = 1;
        $stmt = $pdo->prepare("SELECT MAX(id) AS max_id FROM products");
            $stmt->execute();
            $result  = $stmt->fetch();
            if ($result['max_id'] >= $id) {
                $id = $result['max_id'] + 1;
            }
        $stmt = $pdo->prepare("INSERT INTO products (id, name,  description, price, category_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$id, $name, $description, $price, $category_id]);
    
        header('Location: ./products.php');
    }
    
    $categories = $pdo->query("SELECT * FROM categories")->fetchAll();
    $addHTMLContent = '
    <h1>Add Product</h1>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" required><br>
        <label>Price:</label>
        <input type="number" name="price" required><br>
        <label>Description:</label>
        <textarea name="description" required></textarea><br>
        <label>Category:</label>
        <select name="category_id" required>
        ';
        foreach ($categories as $category){
            $addHTMLContent .= '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
        }
        $addHTMLContent .= '
        </select><br>
        <button type="submit">Add Product</button>
    </form>';
}
elseif ($type == "categories") {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $id = 1;
        $stmt = $pdo->prepare("SELECT MAX(id) AS max_id FROM categories");
            $stmt->execute();
            $result  = $stmt->fetch();
            if ($result['max_id'] >= $id) {
                $id = $result['max_id'] + 1;
            }
    
        $stmt = $pdo->prepare("INSERT INTO categories (id, name) VALUES (?, ?)");
        $stmt->execute([$id, $name]);
    
        header('Location: ./categories.php');
    }
    $addHTMLContent = '
    <h1>Add Category</h1>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" required><br>
        <button type="submit">Add Category</button>
    </form>';
}
elseif ($type == "users" && isset($_SESSION['admin_logged_in'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $login = $_POST['login'];
        $role = $_POST['role'];
        $password = md5($_POST['password']);
        $id = 1;
        $stmt = $pdo->prepare("SELECT MAX(id) AS max_id FROM users");
            $stmt->execute();
            $result  = $stmt->fetch();
            if ($result['max_id'] >= $id) {
                $id = $result['max_id'] + 1;
            }
    
        $stmt = $pdo->prepare("INSERT INTO users (id, login, userrole, password) VALUES (?, ?, ?, ?)");
        $stmt->execute([$id, $login, $role, $password]);
    
        header('Location: users.php');
    }
    $addHTMLContent = '
    <h1>Add User</h1>
    <form method="POST">
        <label>Login:</label>
        <input type="text" name="login" required><br>
        <label>Role:</label>
        <input type="text" name="role" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Add User</button>
    </form>';
}
include '../../frontend/admin/add_form.php';
?>
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
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $category_id = $_POST['category_id'];
    
        $stmt = $pdo->prepare("UPDATE products SET name = ?, price = ?, description = ?, category_id = ? WHERE id = ?");
        $stmt->execute([$name, $price, $description, $category_id, $id]);
    
        header('Location: products.php');
    }
    
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch();
    
    $categories = $pdo->query("SELECT * FROM categories")->fetchAll();

    $editHTMLContent = '
    <h1>Edit Product</h1>
    <form method="POST">
        <input type="hidden" name="id" value="' . htmlspecialchars($product['id']) . '">
        <label>Name:</label>
        <input type="text" name="name" value="' . htmlspecialchars($product['name']) . '" required><br>
        <label>Price:</label>
        <input type="number" name="price" value="' . htmlspecialchars($product['price']) . '" required><br>
        <label>Description:</label>
        <textarea name="description" required>' . htmlspecialchars($product['description']) . '</textarea><br>
        <label>Category:</label>
        <select name="category_id" required>
        ';

    foreach ($categories as $category) {
        $editHTMLContent .= '<option value="' . htmlspecialchars($category['id']) . '" ' . ($category['id'] == $product['category_id'] ? 'selected' : '') . '>' . htmlspecialchars($category['name']) . '</option>';
    }

    $editHTMLContent .= '
        </select><br>
        <button type="submit">Update Product</button>
    </form>'; 
}
elseif ($type == "categories") {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $name = $_POST['name'];
    
        $stmt = $pdo->prepare("UPDATE categories SET name = ? WHERE id = ?");
        $stmt->execute([$name, $id]);
    
        header('Location: categories.php');
    }
    
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM categories WHERE id = ?");
    $stmt->execute([$id]);
    $category = $stmt->fetch();
    $editHTMLContent = '
    <h1>Edit Category</h1>
    <form method="POST">
        <input type="hidden" name="id" value="' . htmlspecialchars($category['id']) . '">
        <label>Name:</label>
        <input type="text" name="name" value="' . htmlspecialchars($category['name']) . '" required><br>
        <button type="submit">Update Category</button>
    </form>';
}
elseif ($type == "users" && isset($_SESSION['admin_logged_in'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $login = $_POST['login'];
        $role = $_POST['role'];
        $password = $_POST['password']; 
    
        if (!empty($password)) {
            $password = md5($password);
            $stmt = $pdo->prepare("UPDATE users SET login = ?, userrole = ?, password = ? WHERE id = ?");
            $stmt->execute([$login, $role, $password, $id]);
        } else {
            $stmt = $pdo->prepare("UPDATE users SET login = ?, userrole = ? WHERE id = ?");
            $stmt->execute([$login, $role, $id]);
        }
    
        header('Location: users.php');
    }
    
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch();
    $editHTMLContent = '
    <form method="POST">
        <input type="hidden" name="id" value="' . htmlspecialchars($user['id']) . '">
        <label>Login:</label>
        <input type="text" name="login" value="' . htmlspecialchars($user['login']) . '" required><br>
        <label>Role:</label>
        <input type="text" name="role" value="' . htmlspecialchars($user['userrole']) . '" required><br>
        <label>Password:</label>
        <input type="password" name="password"><br>
        <button type="submit">Update User</button>
    </form>';
}
include '../../frontend/admin/edit_form.php';
?>
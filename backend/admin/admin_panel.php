<?php
class AdminPanel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->checkLogin();
    }

    private function checkLogin() {
        if (!isset($_SESSION['admin_logged_in']) && !isset($_SESSION['moderator_logged_in'])) {
            header('Location: ../public/login.php');
            exit;
        }
    }

//Добавление

    public function addProduct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $category_id = $_POST['category_id'];

            $id = $this->getNextId('products');
            $stmt = $this->pdo->prepare("INSERT INTO products (id, name, description, price, category_id) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$id, $name, $description, $price, $category_id]);

            header('Location: ./products.php');
            exit;
        }

        return $this->renderAddProductForm();
    }

    public function addCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];

            $id = $this->getNextId('categories');
            $stmt = $this->pdo->prepare("INSERT INTO categories (id, name) VALUES (?, ?)");
            $stmt->execute([$id, $name]);

            header('Location: ./categories.php');
            exit;
        }

        return $this->renderAddCategoryForm();
    }

    public function addUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = $_POST['login'];
            $role = $_POST['role'];
            $password = md5($_POST['password']);

            $id = $this->getNextId('users');
            $stmt = $this->pdo->prepare("INSERT INTO users (id, login, userrole, password) VALUES (?, ?, ?, ?)");
            $stmt->execute([$id, $login, $role, $password]);

            header('Location: users.php');
            exit;
        }

        return $this->renderAddUserForm();
    }

    private function getNextId($table) {
        $stmt = $this->pdo->prepare("SELECT MAX(id) AS max_id FROM $table");
        $stmt->execute();
        $result = $stmt->fetch();
        return ($result['max_id'] ?? 0) + 1;
    }

    private function renderAddProductForm() {
        $categories = $this->pdo->query("SELECT * FROM categories")->fetchAll();
        $options = '';
        foreach ($categories as $category) {
            $options .= '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
        }

        return '
            <h1>Add Product</h1>
            <form method="POST">
                <label>Name:</label>
                <input type="text" name="name" required><br>
                <label>Price:</label>
                <input type="number" name="price" required><br>
                <label>Description:</label>
                <textarea name="description" required></textarea><br>
                <label>Category:</label>
                <select name="category_id" required>' . $options . '</select><br>
                <button type="submit">Add Product</button>
            </form>';
    }

    private function renderAddCategoryForm() {
        return '
            <h1>Add Category</h1>
            <form method="POST">
                <label>Name:</label>
                <input type="text" name="name" required><br>
                <button type="submit">Add Category</button>
            </form>';
    }

    private function renderAddUserForm() {
        return '
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

//Редактирование

public function editProduct($id) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $category_id = $_POST['category_id'];

        $stmt = $this->pdo->prepare("UPDATE products SET name = ?, price = ?, description = ?, category_id = ? WHERE id = ?");
        $stmt->execute([$name, $price, $description, $category_id, $id]);

        header('Location: products.php');
        exit;
    }

    $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch();

    $categories = $this->pdo->query("SELECT * FROM categories")->fetchAll();
    return $this->renderEditProductForm($product, $categories);
}

public function editCategory($id) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];

        $stmt = $this->pdo->prepare("UPDATE categories SET name = ? WHERE id = ?");
        $stmt->execute([$name, $id]);

        header('Location: categories.php');
        exit;
    }

    $stmt = $this->pdo->prepare("SELECT * FROM categories WHERE id = ?");
    $stmt->execute([$id]);
    $category = $stmt->fetch();
    return $this->renderEditCategoryForm($category);
}

public function editUser($id) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $login = $_POST['login'];
        $role = $_POST['role'];
        $password = $_POST['password'];

        if (!empty($password)) {
            $password = md5($password);
            $stmt = $this->pdo->prepare("UPDATE users SET login = ?, userrole = ?, password = ? WHERE id = ?");
            $stmt->execute([$login, $role, $password, $id]);
        } else {
            $stmt = $this->pdo->prepare("UPDATE users SET login = ?, userrole = ? WHERE id = ?");
            $stmt->execute([$login, $role, $id]);
        }

        header('Location: users.php');
        exit;
    }

    $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch();
    return $this->renderEditUserForm($user);
}

private function renderEditProductForm($product, $categories) {
    $options = '';
    foreach ($categories as $category) {
        $selected = ($category['id'] == $product['category_id']) ? 'selected' : '';
        $options .= '<option value="' . htmlspecialchars($category['id']) . '" ' . $selected . '>' . htmlspecialchars($category['name']) . '</option>';
    }

    return '
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
            <select name="category_id" required>' . $options . '</select><br>
            <button type="submit">Update Product</button>
        </form>';
}

private function renderEditCategoryForm($category) {
    return '
        <h1>Edit Category</h1>
        <form method="POST">
            <input type="hidden" name="id" value="' . htmlspecialchars($category['id']) . '">
            <label>Name:</label>
            <input type="text" name="name" value="' . htmlspecialchars($category['name']) . '" required><br>
            <button type="submit">Update Category</button>
        </form>';
}

private function renderEditUserForm($user) {
    return '
        <h1>Edit User</h1>
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

//Удаление

public function delete($type, $id) {
    if ($type != "user") {
        $stmt = $this->pdo->prepare("DELETE FROM ? WHERE id = ?");
        $stmt->execute([$type, $id]);
        header('Location: products.php');
    }
    exit;
}

public function deleteUser($id) {
    $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: users.php');
    exit;
}

}

?>
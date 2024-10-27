<?php
header('Content-Type: application/json');
require '../db/db.php';

try {
    $nameFilter = isset($_GET['name']) ? $_GET['name'] : '';

    $sql = "SELECT id, name FROM categories WHERE name LIKE :name";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => "%$nameFilter%"]);
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($categories)) {
        http_response_code(404);
        echo json_encode(['error_code' => 404, 'error_message' => 'Categories not found.']);
        exit;
    }

    $response = ['categories' => $categories];
    echo json_encode($response);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error_code' => 500, 'error_message' => 'Internal server error: ' . $e->getMessage()]);
}

?>
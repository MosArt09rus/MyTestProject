<?php
header('Content-Type: application/json');
require '../db/db.php';

try {
    $limit = 5; // Количество товаров на странице
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    $nameFilter = isset($_GET['name']) ? $_GET['name'] : '';

    $sql = "SELECT products.id, products.name, products.description AS preview_text, products.price, categories.name AS category
            FROM products
            JOIN categories ON products.category_id = categories.id
            WHERE products.name LIKE :name
            LIMIT :limit OFFSET :offset";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name', "%$nameFilter%");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$items) {
        http_response_code(404);
        echo json_encode(['error_code' => 404, 'error_message' => 'Items not found.']);
        exit;
    }

    $response = ['items' => $items];
    echo json_encode($response);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error_code' => 500, 'error_message' => 'Internal server error.']);
}

//  testproject/api/items.php/?name=&page=1

?>
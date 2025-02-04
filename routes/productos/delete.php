<?php
require_once '../../config/database.php';
require_once '../../controllers/ProductoController.php';

header('Content-Type: application/json');

http://localhost/api-v2/routes/productos/delete.php?id=1

if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(["error" => "Falta el ID"]);
    exit();
}

$controller = new ProductoController($pdo);
$controller->eliminar($_GET['id']);
?>

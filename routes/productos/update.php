<?php
require_once '../../config/database.php';
require_once '../../controllers/ProductoController.php';

header('Content-Type: application/json');

//APIREST = http://localhost/api-v2/routes/productos/update.php?id=1

if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(["error" => "Falta el ID"]);
    exit();
}

$controller = new ProductoController($pdo);
$data = json_decode(file_get_contents("php://input"), true);
$controller->actualizar($_GET['id'], $data);
?>

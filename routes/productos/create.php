<?php
require_once '../../config/database.php';
require_once '../../controllers/ProductoController.php';

header('Content-Type: application/json');

//APIREST = http://localhost/api-v2/routes/productos/create.php

$controller = new ProductoController($pdo);
$data = json_decode(file_get_contents("php://input"), true);
$controller->crear($data);
?>

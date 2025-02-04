<?php
require_once '../../config/database.php';
require_once '../../controllers/ProductoController.php';

header('Content-Type: application/json');

//APIREST = http://localhost/api-v2/routes/productos/index.php

$controller = new ProductoController($pdo);
$controller->listar();
?>

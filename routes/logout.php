<?php
require_once '../controllers/AuthController.php';
require_once '../config/database.php';
require_once '../config/cors.php';

header("Content-Type: application/json");

//APIREST = http://localhost/api-v2/routes/logout.php

$authController = new AuthController($pdo);

// Verifica si la solicitud es GET y maneja el logout
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $authController->logout();  
} else {
    http_response_code(405); 
    echo json_encode(["error" => "Método no permitido"]);
}
?>

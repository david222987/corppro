<?php
require_once '../controllers/AuthController.php';
require_once '../config/database.php';
require_once '../config/cors.php';

header("Content-Type: application/json");

//APIREST = http://localhost/api-v2/routes/login.php

$authController = new AuthController($pdo);

// Verifica si la solicitud es POST y maneja el login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $authController->login();
} else {
    http_response_code(405);
    echo json_encode(["error" => "Método no permitido"]);
}
?>

<?php
require_once '../models/Usuario.php';
require_once '../config/database.php';

header('Content-Type: application/json');

// CONTROLADOR - REGISTRO Y LOGIN DEL USUARIO
class AuthController {
    private $usuarioModel;

    public function __construct($pdo) {
        $this->usuarioModel = new Usuario($pdo);
    }

    // REGISTRO DE USUARIO
    public function register($data) {
        if (!isset($data['nombre'], $data['usuario'], $data['email'], $data['clave']) || 
            trim($data['nombre']) === "" || trim($data['usuario']) === "" || trim($data['email']) === "" || trim($data['clave']) === "") {
            http_response_code(400);
            echo json_encode(["error" => "Todos los campos son obligatorios"]);
            exit();
        }
    
        // Validar el formato del correo electrónico
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo json_encode(["error" => "El correo electrónico no es válido"]);
            exit();
        }
    
        // Verificar si el nombre de usuario ya está registrado
        if ($this->usuarioModel->usuarioExistePorUsuario($data['usuario'])) {
            http_response_code(409);
            echo json_encode(["error" => "El nombre de usuario ya está registrado"]);
            exit();
        }
    
        // Verificar si el correo electrónico ya está registrado
        if ($this->usuarioModel->usuarioExistePorEmail($data['email'])) {
            http_response_code(409);
            echo json_encode(["error" => "El correo electrónico ya está registrado"]);
            exit();
        }
    
        // Encriptar la contraseña
        $clave = password_hash($data['clave'], PASSWORD_BCRYPT);
    
        // Crear un nuevo usuario
        if ($this->usuarioModel->crearUsuario($data['nombre'], $data['usuario'], $data['email'], $clave)) {
            http_response_code(201);
            return ["message" => "Usuario registrado exitosamente"];
        } else {
            http_response_code(500);
            return ["error" => "Error al registrar el usuario"];
        }
    }
    
    

    // LOGIN DE USUARIO
    public function login() {
        $data = json_decode(file_get_contents("php://input"), true);

        // Verificar que los campos requeridos existan
        if (!isset($data['email'], $data['clave'])) {
            http_response_code(400);
            echo json_encode(["error" => "Todos los campos son obligatorios"]);
            return;
        }

        // Verificar si el usuario existe
        $usuario = $this->usuarioModel->obtenerUsuarioPorEmail($data['email']);
        if (!$usuario) {
            http_response_code(404);
            echo json_encode(["error" => "Usuario no encontrado"]);
            return;
        }

        // Verificar la contraseña
        if (!password_verify($data['clave'], $usuario['clave'])) {
            http_response_code(401);
            echo json_encode(["error" => "Contraseña incorrecta"]);
            return;
        }

        // Iniciar la sesión y almacenar el usuario en la sesión
        session_start();
        $_SESSION['usuario'] = $usuario;

        http_response_code(200);
        echo json_encode(["message" => "Inicio de sesión exitoso"]);
    }

    // CERRAR SESION
    public function logout() {
        session_start();
        session_destroy();
        http_response_code(200);
        echo json_encode(["message" => "Sesión cerrada"]);
    }
}
?>

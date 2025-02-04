<?php
require_once __DIR__ . '/../models/Producto.php';

//CONTROLADOR - CRUD PRODUCTOS
class ProductoController {
    private $productoModel;

    public function __construct($pdo) {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            http_response_code(401);
            echo json_encode(["error" => "No autorizado"]);
            exit();
        }
        $this->productoModel = new Producto($pdo);
    }

    public function listar() {
        $productos = $this->productoModel->obtenerProductos();
        echo json_encode($productos ?: ["error" => "No hay productos"]);
    }

    public function obtenerPorId($id) {
        $producto = $this->productoModel->obtenerProductoPorId($id);
        echo json_encode($producto ?: ["error" => "Producto no encontrado"]);
    }

    public function crear($data) {
        if (!isset($data['nombre'], $data['descripcion'], $data['precio'], $data['imagen'], $data['usuario_id'])) {
            http_response_code(400);
            echo json_encode(["error" => "Faltan datos"]);
            return;
        }
        $this->productoModel->crearProducto($data['nombre'], $data['descripcion'], $data['precio'], $data['imagen'], $data['usuario_id']);
        http_response_code(201);
        echo json_encode(["message" => "Producto creado"]);
    }

    public function actualizar($id, $data) {
        if (!isset($data['nombre'], $data['descripcion'], $data['precio'], $data['imagen'])) {
            http_response_code(400);
            echo json_encode(["error" => "Faltan datos"]);
            return;
        }
        $this->productoModel->actualizarProducto($id, $data['nombre'], $data['descripcion'], $data['precio'], $data['imagen']);
        echo json_encode(["message" => "Producto actualizado"]);
    }

    public function eliminar($id) {
        $this->productoModel->eliminarProducto($id);
        echo json_encode(["message" => "Producto eliminado"]);
    }
}
?>

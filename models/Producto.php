<?php

//MODELO - PRODUCTO
class Producto {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function obtenerProductos() {
        $stmt = $this->pdo->query("SELECT * FROM productos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerProductoPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM productos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crearProducto($nombre, $descripcion, $precio, $imagen, $usuario_id) {
        $stmt = $this->pdo->prepare("INSERT INTO productos (nombre, descripcion, precio, imagen, usuario_id) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$nombre, $descripcion, $precio, $imagen, $usuario_id]);
    }

    public function actualizarProducto($id, $nombre, $descripcion, $precio, $imagen) {
        $stmt = $this->pdo->prepare("UPDATE productos SET nombre=?, descripcion=?, precio=?, imagen=? WHERE id=?");
        return $stmt->execute([$nombre, $descripcion, $precio, $imagen, $id]);
    }

    public function eliminarProducto($id) {
        $stmt = $this->pdo->prepare("DELETE FROM productos WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>

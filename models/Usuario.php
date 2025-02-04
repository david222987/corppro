<?php
// MODELO USUARIO
class Usuario {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // VERIFICAR SI EL EMAIL YA ESTÁ REGISTRADO
    public function usuarioExistePorEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
    }

    // VERIFICAR SI EL USUARIO YA ESTÁ REGISTRADO
    public function usuarioExistePorUsuario($usuario) {
        $query = "SELECT id FROM usuarios WHERE usuario = :usuario LIMIT 1";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":usuario", $usuario);
        $stmt->execute();
    
        return $stmt->rowCount() > 0;
    }
    
    // CREAR UN NUEVO USUARIO
    public function crearUsuario($nombre, $usuario, $email, $clave) {
        $sql = "INSERT INTO usuarios (nombre, usuario, email, clave) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nombre, $usuario, $email, $clave]);

    }

    // OBTENER USUARIO POR EMAIL
    public function obtenerUsuarioPorEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
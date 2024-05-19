<?php
require_once __DIR__ . "/sistema.class.php";

class Usuario extends Sistema
{
    public function getAll()
    {
        $this->connect();
        $sql = "SELECT u.id_usuario, u.username, ur.id_rol, r.rol
        FROM usuarios u
        JOIN usuario_rol ur ON u.id_usuario = ur.id_usuario
        JOIN rol r ON ur.id_rol = r.id_rol;";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $this->count = count($datos);
        return $datos;
    }

    public function getById($id_usuario)
    {
        $this->connect();
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE id_usuario = :id_usuario;");
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $this->count = count($datos);
        return $datos[0];
    }

    public function getByUsername($username)
    {
        $this->connect();
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE username = :username;");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $this->count = count($datos);
        return $datos[0];
    }

    public function insert($datos)
    {
    }

    public function updateUsuario($datos, $id_usuario)
    {
        $this->connect();
        $stmt = $this->conn->prepare("UPDATE usuarios SET username = :username WHERE id_usuario = :id_usuario;");
        $stmt->bindParam(':username', $datos['username'], PDO::PARAM_STR);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $this->count = count($datos);
        return $stmt->rowCount();
    }

    public function updateRole($id_usuario, $role) {

    }

    public function delete($id_usuario)
    {
        $this->connect();
        $stmt = $this->conn->prepare("DELETE FROM usuarios WHERE id_usuario = :id_usuario;");
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $this->count = count($datos);
        return $stmt->rowCount();
    }
}

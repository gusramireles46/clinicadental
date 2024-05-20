<?php
require_once __DIR__ . "/sistema.class.php";

class Usuario extends Sistema
{
    public function getAll()
    {
        $this->connect();
        $sql = "SELECT * FROM usuarios ORDER BY id_usuario;";
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

    public function getRolesUsuario($id_usuario)
    {
        $this->connect();
        $sql = "SELECT r.id_rol, r.rol FROM rol r JOIN usuario_rol ur ON r.id_rol = ur.id_rol WHERE ur.id_usuario = :id_usuario;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $this->count = count($datos);
        return $datos;
    }

    public function getUserRoles($id_usuario)
    {
        $this->connect();
        $sql = "SELECT r.id_rol, r.rol FROM rol r JOIN usuario_rol ur ON r.id_rol = ur.id_rol WHERE ur.id_usuario = :id_usuario;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $roles = "";
        foreach ($datos as $rol => $role) {
            $roles.= $role['rol'];
            if ($rol < count($datos) - 1) {
                $roles.= ', ';
            }
        }
        return $roles;
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

    public function update($datos, $id_usuario)
    {
        $this->connect();
        $usuario = $this->getById($id_usuario);
        $usuarioActualizado = false;
        if ($this->validateUser($datos) && $datos['correo'] != $usuario['username']) {
            $stmt = $this->conn->prepare("UPDATE usuarios SET username = :username WHERE id_usuario = :id_usuario;");
            $stmt->bindParam(':username', $datos['correo'], PDO::PARAM_STR);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();
            $usuarioActualizado = true;
        }
        $rolActualizado = false;
        if (isset($datos['roles'])) {
            $rolActualizado = $this->updateRole($id_usuario, $datos['roles']);
        }
        if ($usuarioActualizado || $rolActualizado) {
            return true;
        }
        $this->alert("danger", "Nel");
        return false;
    }

    public function updateRole($id_usuario, $roles)
    {
        $this->connect();
        $this->conn->beginTransaction();
        try {
            $sql = "DELETE FROM usuario_rol WHERE id_usuario = :id_usuario;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();
            foreach ($roles as $id_rol) {
                $sql = "INSERT INTO usuario_rol (id_usuario, id_rol) VALUES (:id_usuario, :id_rol);";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
                $stmt->execute();
            }
            $this->conn->commit();
            $sql = "SELECT * FROM usuarios WHERE id_usuario = :id_usuario;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $datos = $stmt->fetchAll();
            $this->alert("success", "Se ha actualizado el rol de {$datos[0]['username']} correctamente");
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            $this->alert("danger", "No se ha podido actualizar el rol del usuario");
            return false;
        }
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

    private function validateUser($datos)
    {
        if (empty($datos['correo'])) {
            return false;
        }
        return true;
    }
}

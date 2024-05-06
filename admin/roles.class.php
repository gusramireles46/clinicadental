<?php
require_once __DIR__ . '/sistema.class.php';

class Rol extends Sistema
{
    public function getAll()
    {
        $this->connect();
        $stmt = $this->conn->prepare('SELECT * FROM rol;');
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $this->count = count($datos);
        return $datos;
    }

    public function getById($id_rol)
    {
        $this->connect();
        $stmt = $this->conn->prepare('SELECT * FROM rol WHERE id_rol = :id_rol;');
        $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        if (isset($datos[0])) {
            $this->setCount(count($datos));
            return $datos[0];
        }
        return $datos;
    }

    public function getRolPrivilegio($rol)
    {
        $this->connect();
        $stmt = $this->conn->prepare('
        SELECT * FROM privilegio p
        JOIN rol_privilegio rp ON rp.id_privilegio = p.id_privilegio
        JOIN rol r ON rp.id_rol = r.id_rol
        WHERE r.id_rol = :id_rol;'
        );
        $stmt->bindParam(':id_rol', $rol, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();

        $privilegios = '';
        foreach ($datos as $key => $row) {
            $privilegios .= $row['privilegio'];
            if ($key < count($datos) - 1) {
                $privilegios .= ', ';
            }
        }
        return $privilegios;
    }

    public function getPrivilegiosRol($rol)
    {
        $this->connect();
        $stmt = $this->conn->prepare('
        SELECT p.id_privilegio, p.privilegio 
        FROM privilegio p
        JOIN rol_privilegio rp ON rp.id_privilegio = p.id_privilegio
        JOIN rol r ON rp.id_rol = r.id_rol
        WHERE r.id_rol = :id_rol;'
        );
        $stmt->bindParam(':id_rol', $rol, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $privilegios = $stmt->fetchAll();
        return $privilegios;
    }


    public function delete($id_rol)
    {
        $this->connect();
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare('DELETE FROM rol_privilegio WHERE id_rol = :id_rol;');
            $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
            $stmt->execute();
            $stmt = $this->conn->prepare('DELETE FROM rol WHERE id_rol = :id_rol;');
            $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
            $stmt->execute();
            $this->conn->commit();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            $this->conn->rollBack();
            return 0;
        }
    }


    public function update($id_rol, $datos)
    {
        $this->connect();
        $rol = $this->getById($id_rol);
        $nombreActualizado = false;
        if ($this->validateRol($datos) && $datos['rol'] != $rol['rol']) {
            $stmt = $this->conn->prepare('UPDATE rol SET rol = :rol WHERE id_rol = :id_rol;');
            $stmt->bindParam(':rol', $datos['rol'], PDO::PARAM_STR);
            $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
            $stmt->execute();
            $nombreActualizado = true;
        }
        $privilegiosActualizados = false;
        if (isset($datos['privilegios'])) {
            $privilegiosActualizados = $this->updatePrivilegios($id_rol, $datos['privilegios']);
        }

        return ($nombreActualizado || $privilegiosActualizados) ? 1 : 0;
    }

    public function updatePrivilegios($id_rol, $privilegios)
    {
        $this->connect();
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare('DELETE FROM rol_privilegio WHERE id_rol = :id_rol;');
            $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
            $stmt->execute();
            foreach ($privilegios as $id_privilegio) {
                $stmt = $this->conn->prepare('INSERT INTO rol_privilegio (id_rol, id_privilegio) VALUES (:id_rol, :id_privilegio)');
                $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
                $stmt->bindParam(':id_privilegio', $id_privilegio, PDO::PARAM_INT);
                $stmt->execute();
            }
            $this->conn->commit();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    public function insert($datos)
    {
        $this->connect();

        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare('SELECT id_rol FROM rol WHERE rol = :rol');
            $stmt->bindParam(':rol', $datos['rol'], PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $this->alert('danger', 'El rol ya existe');
                $this->conn->rollBack();
                return false;
            }
            $stmt = $this->conn->prepare('INSERT INTO rol (rol) VALUES (:rol)');
            $stmt->bindParam(':rol', $datos['rol'], PDO::PARAM_STR);
            $stmt->execute();
            $id_rol = $this->conn->lastInsertId();
            if (isset($datos['privilegios']) && is_array($datos['privilegios'])) {
                foreach ($datos['privilegios'] as $id_privilegio) {
                    $stmt = $this->conn->prepare('INSERT INTO rol_privilegio (id_rol, id_privilegio) VALUES (:id_rol, :id_privilegio)');
                    $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
                    $stmt->bindParam(':id_privilegio', $id_privilegio, PDO::PARAM_INT);
                    $stmt->execute();
                }
            }
            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    private function validateRol($datos)
    {
        if (empty($datos['rol'])) {
            return false;
        }
        return true;
    }
}
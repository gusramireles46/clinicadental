<?php
require_once __DIR__ . '/sistema.class.php';

class Privilegio extends Sistema
{
    public function getAll()
    {
        $this->connect();
        $stmt = $this->conn->prepare('SELECT * FROM privilegio;');
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $this->count = count($datos);
        return $datos;
    }

    public function getById($id_privilegio)
    {
        $this->connect();
        $stmt = $this->conn->prepare('SELECT id_privilegio, privilegio FROM privilegio WHERE id_privilegio = :id_privilegio;');
        $stmt->bindParam(':id_privilegio', $id_privilegio, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        if (isset($datos[0])) {
            $this->setCount(count($datos));
            return $datos[0];
        }
        return $datos;
    }

    public function getByNombre($privilegio)
    {
        $this->connect();
        $stmt = $this->conn->prepare('SELECT * FROM privilegio WHERE privilegio = :privilegio;');
        $stmt->bindParam(':privilegio', $privilegio, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        if (isset($datos[0])) {
            $this->setCount(count($datos));
            return $datos[0];
        }
        return $datos;
    }

    public function insert($datos)
    {
        $this->connect();
        if ($this->validatePrivilegio($datos)) {
            $stmt = $this->conn->prepare('INSERT INTO privilegio (privilegio) VALUES (:privilegio);');
            $stmt->bindParam(':privilegio', $datos['privilegio'], PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount();
        }
        return 0;
    }

    public function update($datos, $id_privilegio)
    {
        $this->connect();
        if ($this->validatePrivilegio($datos)) {
            $stmt = $this->conn->prepare('UPDATE privilegio SET privilegio = :privilegio WHERE id_privilegio = :id_privilegio;');
            $stmt->bindParam(':privilegio', $datos['privilegio'], PDO::PARAM_STR);
            $stmt->bindParam(':id_privilegio', $id_privilegio, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount();
        }
        return 0;
    }

    public function delete($id_privilegio) {
        $this->connect();
        $stmt = $this->conn->prepare('DELETE FROM privilegio WHERE id_privilegio = :id_privilegio;');
        $stmt->bindParam(':id_privilegio', $id_privilegio, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }

    private function validatePrivilegio($datos): bool
    {
        if (empty($datos['privilegio'])) {
            return false;
        }
        return true;
    }
}
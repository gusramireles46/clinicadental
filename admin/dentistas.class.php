<?php
include __DIR__ . '/sistema.class.php';

class Dentista extends Sistema
{
    public function getAll()
    {
        $this->connect();
        $stmt = $this->conn->prepare('SELECT * FROM dentista;');
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $this->count = count($datos);
        return $datos;
    }

    public function getById($id_dentista)
    {
        $this->connect();
        $stmt = $this->conn->prepare('SELECT * FROM dentista WHERE id_dentista = :id_dentista;');
        $stmt->bindParam(':id_dentista', $id_dentista, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $this->count = count($datos);
        if (isset($datos[0])) {
            $this->setCount(count($datos));
            return $datos[0];
        }
        return $datos;
    }

    public function insert($datos)
    {
        $this->connect();
        if ($this->validateDentista($datos)) {

        }
    }

    private function validateDentista($datos)
    {
        if (empty($datos['nombre'])) {
            return false;
        } else if (empty($datos['apellido_paterno'])) {
            return false;
        } else if (empty($datos['apellido_materno'])) {
            return false;
        } else if (empty($datos['correo'])) {
            return false;
        }
        return true;
    }
}

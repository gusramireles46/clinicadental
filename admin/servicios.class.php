<?php
require_once __DIR__ . '/sistema.class.php';

class Servicio extends Sistema
{
    public function getAll()
    {
        $this->connect();
        $stmt = $this->conn->prepare('SELECT s.id_servicio AS id_servicio, s.servicio AS servicio, s.descripcion AS descripcion, s.precio AS precio, c.categoria AS categoria, s.imagen AS imagen FROM servicios s JOIN categorias c ON c.id_categoria = s.id_categoria ORDER BY s.id_servicio;');
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $this->count = count($datos);
        return $datos;
    }

    public function getById($id_servicio)
    {
        $this->connect();
        $stmt = $this->conn->prepare('SELECT * FROM servicios WHERE id_servicio = :id_servicio');
        $stmt->bindParam(':id_servicio', $id_servicio, PDO::PARAM_INT);
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
        $prefijo = $datos['servicio'];
        $filename = $this->upload('servicios', $prefijo);
        if ($this->validateServicio($datos)) {
            if ($filename) {
                $stmt = $this->conn->prepare('INSERT INTO servicios (servicio, descripcion, precio, imagen, id_categoria) VALUES (:servicio, :descripcion, :precio, :imagen, :id_categoria);');
                $stmt->bindParam(':imagen', $filename, PDO::PARAM_STR);
            } else {
                $stmt = $this->conn->prepare('INSERT INTO servicios (servicio, precio, descripcion, id_categoria) VALUES (:servicio, :precio, :descripcion, :id_categoria);');
            }
            $stmt->bindParam(':servicio', $datos['servicio'], PDO::PARAM_STR);
            $stmt->bindParam(':descripcion', $datos['descripcion'], PDO::PARAM_STR);
            $stmt->bindParam(':precio', $datos['precio'], PDO::PARAM_STR);
            $stmt->bindParam(':id_categoria', $datos['id_categoria'], PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount();
        }
        return 0;
    }

    public function update($id_servicio, $datos)
    {
        $this->connect();
        $filename = $this->upload('servicios');
        if ($this->validateServicio($datos)) {
            if ($filename) {
                $stmt = $this->conn->prepare('UPDATE servicios SET servicio = :servicio, descripcion = :descripcion, precio = :precio, imagen = :imagen, id_categoria = :id_categoria WHERE id_servicio = :id_servicio;');
                $stmt->bindParam(':imagen', $filename, PDO::PARAM_STR);
            } else {
                $stmt = $this->conn->prepare('UPDATE servicios SET servicio = :servicio, precio = :precio, descripcion = :descripcion, id_categoria = :id_categoria WHERE id_servicio = :id_servicio;');
            }
            $stmt->bindParam(':servicio', $datos['servicio'], PDO::PARAM_STR);
            $stmt->bindParam(':descripcion', $datos['descripcion'], PDO::PARAM_STR);
            $stmt->bindParam(':precio', $datos['precio'], PDO::PARAM_STR);
            $stmt->bindParam(':id_categoria', $datos['id_categoria'], PDO::PARAM_INT);
            $stmt->bindParam(':id_servicio', $id_servicio, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount();
        }
        return 0;
    }

    public function delete($id_servicio) {
        $this->connect();
        $stmt = $this->conn->prepare('DELETE FROM servicios WHERE id_servicio = :id_servicio;');
        $stmt->bindParam(':id_servicio', $id_servicio, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }

    private function validateServicio($datos)
    {
        if (empty($datos['servicio'])) {
            return false;
        } else if (empty($datos['descripcion'])) {
            return false;
        } else if (!($datos['precio'] >= 0) && !empty($datos['precio'])) {
            return false;
        }
        return true;
    }
}
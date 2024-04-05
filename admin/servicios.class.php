<?php
require_once __DIR__ . '/sistema.class.php';

class Servicio extends Sistema
{
    public function getAll()
    {
        $this->connect();
        $stmt = $this->conn->prepare('SELECT s.id_servicio AS id_servicio, s.servicio AS servicio, s.descripcion AS descripcion, s.precio AS precio, c.categoria AS categoria, s.imagen AS imagen FROM servicios s JOIN categorias c ON c.id_categoria = s.id_categoria;');
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

    private function validateServicio()
    {
        if (empty($datos['servicio'])) {
            return false;
        } else if (empty($datos['descripcion'])) {
            return false;
        } else if (empty($datos['precio'])) {
            return false;
        }
        return true;
    }
}
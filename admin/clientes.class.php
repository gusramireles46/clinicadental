<?php
include __DIR__ . "/sistema.class.php";

class Cliente extends Sistema
{
    public function getAll()
    {
        $this->connect();
        $stmt = $this->conn->prepare("SELECT * FROM clientes;");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $this->count = count($datos);
        return $datos;
    }

    public function getById($id_cliente) {
        $this->connect();
        $stmt = $this->conn->prepare("SELECT * FROM clientes WHERE id_cliente = :id_cliente;");
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $this->count = count($datos);
        return $datos[0];
    }
}
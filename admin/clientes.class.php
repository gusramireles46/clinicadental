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

    public function insert($cliente) {
        $this->connect();
        $stmt = $this->conn->prepare("INSERT INTO clientes (nombre, apellido_paterno, apellido_materno, telefono) VALUES (:nombre, :apellido_paterno, :apellido_materno, :telefono);");
        $stmt->bindParam(':nombre', $cliente['nombre'], PDO::PARAM_STR);
        $stmt->bindParam(':apellido', $cliente['apellido'], PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $cliente['telefono'], PDO::PARAM_STR);
        $stmt->bindParam(':direccion', $cliente['direccion'], PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function update($datos, $id_cliente) {
        $this->connect();
        $stmt = $this->conn->prepare("UPDATE clientes SET nombre = :nombre, apellido_paterno = :apellido_paterno, apellido_materno = :apellido_materno, telefono = :telefono WHERE id_cliente = :id_cliente;");
        $stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
        $stmt->bindParam(':apellido_paterno', $datos['apellido_paterno'], PDO::PARAM_STR);
        $stmt->bindParam(':apellido_materno', $datos['apellido_materno'], PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $datos['telefono'], PDO::PARAM_STR);
        $stmt->bindParam(':direccion', $datos['direccion'], PDO::PARAM_STR);
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function delete($id_cliente) {
        $this->connect();
        $stmt = $this->conn->prepare('DELETE FROM clientes WHERE id_cliente = :id_cliente;');
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
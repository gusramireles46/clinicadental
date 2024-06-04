<?php
include __DIR__ . '/sistema.class.php';

class Producto extends Sistema
{
    public function getAll()
    {
        $this->connect();
        $stmt = $this->conn->prepare("SELECT * FROM productos;");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $this->count = count($datos);
        return $datos;
    }

    public function getById($id_producto)
    {
        $this->connect();
        $stmt = $this->conn->prepare("SELECT * FROM productos WHERE id_producto = :id_producto;");
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
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
        $prefijo = $datos['producto'];
        $filename = $this->upload("productos", $prefijo);
        if ($this->validateProducto($datos)) {
            if ($filename) {
                $stmt = $this->conn->prepare('INSERT INTO productos (producto, precio, imagen) VALUES (:producto, :precio, :imagen);');
                $stmt->bindParam(':imagen', $filename, PDO::PARAM_STR);
            } else {
                $stmt = $this->conn->prepare('INSERT INTO productos (producto, precio) VALUES (:producto, :precio);');
            }
            $stmt->bindParam(':producto', $datos['producto'], PDO::PARAM_STR);
            $stmt->bindParam(':precio', $datos['precio'], PDO::PARAM_STR);
            $stmt->execute();
            return true;
        }
        return false;
    }

    public function update($id_producto, $datos) {
        $this->connect();
        $prefijo = $datos['producto'];
        $filename = $this->upload("productos", $prefijo);
        if ($this->validateProducto($datos)) {
            if ($filename) {
                $stmt = $this->conn->prepare('UPDATE productos SET producto = :producto, precio = :precio, imagen = :imagen WHERE id_producto = :id_producto;');
                $stmt->bindParam(':imagen', $filename, PDO::PARAM_STR);
            } else {
                $stmt = $this->conn->prepare('UPDATE productos SET producto = :producto, precio = :precio WHERE id_producto = :id_producto;');
            }
            $stmt->bindParam(':producto', $datos['producto'], PDO::PARAM_STR);
            $stmt->bindParam(':precio', $datos['precio'], PDO::PARAM_STR);
            $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        }
        return false;
    }

    public function delete($id_producto) {
        $this->connect();
        $stmt = $this->conn->prepare('DELETE FROM productos WHERE id_producto = :id_producto;');
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }

    private function validateProducto($datos)
    {
        if (empty($datos['producto'])) {
            return false;
        }
        if (empty($datos['precio'])) {
            return false;
        }
        if ($datos['precio'] < 0) {
            return false;
        }
        return true;
    }
}
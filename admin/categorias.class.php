<?php
require_once __DIR__ . '/sistema.class.php';

class Categoria extends Sistema
{
    function getAll()
    {
        $this->connect();
        $stmt = $this->conn->prepare('SELECT * FROM categorias;');
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $this->count = count($datos);
        return $datos;
    }

    function getOne($id_categoria)
    {
        $this->connect();
        $stmt = $this->conn->prepare('SELECT * FROM categorias WHERE id_categoria = :id_categoria;');
        $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
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

    function insert($datos)
    {
        $this->connect();
        $file_name = $this->upload('categorias');
        if ($this->validateCategoria($datos)) {
            if ($file_name) {
                $stmt = $this->conn->prepare('INSERT INTO categorias (categoria, descripcion, imagen) VALUES (:categoria, :descripcion, :imagen)');
                $stmt->bindParam(':imagen', $file_name, PDO::PARAM_STR);
            } else {
                $stmt = $this->conn->prepare('INSERT INTO categorias (categoria, descripcion) VALUES (:categoria, :descripcion)');
            }
            $stmt->bindParam(':categoria', $datos['categoria'], PDO::PARAM_STR);
            $stmt->bindParam(':descripcion', $datos['descripcion'], PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount();
        }
        return 0;
    }

    function delete($id_categoria)
    {
        $this->connect();
        $stmt = $this->conn->prepare('DELETE FROM categorias WHERE id_categoria = :id_categoria;');
        $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }

    private function validateCategoria($datos)
    {
        if (empty($datos['categoria'])) {
            return false;
        } else if (empty($datos['descripcion'])) {
            return false;
        }
        return true;
    }
}

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
            if (isset($datos['fotografia'])) {
                $foto = $datos['fotografia'];
                $sql = "INSERT INTO dentista (nombre, apellido_paterno, apellido_materno, telefono, dias_habiles, especialidad, hora_inicio, hora_fin, fotografia, correo) 
                        VALUES (:nombre, :apellido_paterno, :apellido_materno, :telefono, :dias_habiles, :especialidad, :hora_inicio, :hora_fin, :fotografia, :correo);";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':fotografia', $foto, PDO::PARAM_LOB);
            } else {
                $sql = "INSERT INTO dentista (nombre, apellido_paterno, apellido_materno, telefono, dias_habiles, especialidad, hora_inicio, hora_fin, correo) 
                        VALUES (:nombre, :apellido_paterno, :apellido_materno, :telefono, :dias_habiles, :especialidad, :hora_inicio, :hora_fin, :correo);";
                $stmt = $this->conn->prepare($sql);
            }
            $stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
            $stmt->bindParam(':apellido_paterno', $datos['apellido_paterno'], PDO::PARAM_STR);
            $stmt->bindParam(':apellido_materno', $datos['apellido_materno'], PDO::PARAM_STR);
            $stmt->bindParam(':telefono', $datos['telefono'], PDO::PARAM_STR);
            $stmt->bindParam(':dias_habiles', $datos['dias_habiles'], PDO::PARAM_STR);
            $stmt->bindParam(':especialidad', $datos['especialidad'], PDO::PARAM_STR);
            $stmt->bindParam(':hora_inicio', $datos['hora_inicio'], PDO::PARAM_STR);
            $stmt->bindParam(':hora_fin', $datos['hora_fin'], PDO::PARAM_STR);
            $stmt->bindParam(':correo', $datos['correo'], PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount();
        }
        return 0;
    }

    public function update($id_dentista, $datos)
    {
        $this->connect();
        if ($this->validateDentista($datos)) {
            if (!empty($datos['fotografia'])) {
                $foto = $datos['fotografia'];
                $sql = "UPDATE dentista SET nombre = :nombre, apellido_paterno = :apellido_paterno, apellido_materno = :apellido_materno, telefono = :telefono, correo = :correo, dias_habiles = :dias_habiles, hora_inicio = :hora_inicio, hora_fin = :hora_fin, especialidad = :especialidad, fotografia = :fotografia WHERE id_dentista = :id_dentista;";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':fotografia', $foto, PDO::PARAM_LOB);
            } else {
                $sql = "UPDATE dentista SET nombre = :nombre, apellido_paterno = :apellido_paterno, apellido_materno = :apellido_materno, telefono = :telefono, correo = :correo, dias_habiles = :dias_habiles, hora_inicio = :hora_inicio, hora_fin = :hora_fin, especialidad = :especialidad WHERE id_dentista = :id_dentista;";
                $stmt = $this->conn->prepare($sql);
            }
            $stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
            $stmt->bindParam(':apellido_paterno', $datos['apellido_paterno'], PDO::PARAM_STR);
            $stmt->bindParam(':apellido_materno', $datos['apellido_materno'], PDO::PARAM_STR);
            $stmt->bindParam(':telefono', $datos['telefono'], PDO::PARAM_STR);
            $stmt->bindParam(':correo', $datos['correo'], PDO::PARAM_STR);
            $stmt->bindParam(':dias_habiles', $datos['dias_habiles'], PDO::PARAM_STR);
            $stmt->bindParam(':hora_inicio', $datos['hora_inicio'], PDO::PARAM_STR);
            $stmt->bindParam(':hora_fin', $datos['hora_fin'], PDO::PARAM_STR);
            $stmt->bindParam(':especialidad', $datos['especialidad'], PDO::PARAM_STR);
            $stmt->bindParam(':id_dentista', $id_dentista, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount();
        }
        return 0;
    }

    public function delete($id_dentista)
    {
        $this->connect();
        $stmt = $this->conn->prepare('DELETE FROM dentista WHERE id_dentista = :id_dentista;');
        $stmt->bindParam(':id_dentista', $id_dentista, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
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

<?php
require_once 'config.php';

class Sistema extends Config
{
    var $conn;
    var $count;

    function connect()
    {
        $this->conn = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    }

    function query($sql)
    {
        $this->connect();
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $datos = array();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        return $datos;
    }

    function alert($type, $message)
    {
        $alert = array();
        $alert['type'] = $type;
        $alert['message'] = $message;
        include __DIR__. '/components/alert.php';
    }

    function setCount($count)
    {
        $this->count = $count;
    }

    function getCount()
    {
        return $this->count;
    }

    function upload($carpeta)
    {
        if (in_array($_FILES['imagen']['type'], $this->getImageType())) {
            if ($_FILES['imagen']['size'] <= $this->getImageSize()) {
                $n = rand(1, 1000000);
                $nombre_archivo = $n . $_FILES['imagen']['size'] . $_FILES['imagen']['name'];
                $nombre_archivo = md5($nombre_archivo);
                $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
                $nombre_archivo = $nombre_archivo . "." . $extension;
                $ruta = '../assets/images/' . $carpeta . '/' . $nombre_archivo;
                if (!file_exists($ruta)) {
                    move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);
                    return $nombre_archivo;
                }
            }
        }
        return false;
    }
}
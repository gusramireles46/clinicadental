<?php
require_once 'config.php';

class Sistema extends Config
{
    var $conn;
    var $count;

    function connect()
    {
        $this->conn = new PDO(DB_DRIVER . ':host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
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

    public function getRol($username)
    {
        $sql = "SELECT r.rol FROM usuarios u
                JOIN usuario_rol ur ON u.id_usuario = ur.id_usuario
                JOIN rol r ON ur.id_rol = r.id_rol
                WHERE u.username = '" . $username . "';";
        $datos = $this->query($sql);
        $info = array();
        foreach ($datos as $row) {
            $info[] = $row['rol'];
        }
        return $info;
    }

    public function getPrivilegio($username)
    {
        $sql = "SELECT p.privilegio FROM usuarios u
                JOIN usuario_rol ur on u.id_usuario = ur.id_usuario
                JOIN rol_privilegio rp on ur.id_rol = rp.id_rol
                JOIN privilegio p on rp.id_privilegio = p.id_privilegio
                WHERE u.username = '" . $username . "';";
        $datos = $this->query($sql);
        $info = array();
        foreach ($datos as $row) {
            $info[] = $row['privilegio'];
        }
        return $info;
    }

    public function login($username, $password)
    {
        $password = md5($password);
        $this->connect();
        $sql = "SELECT * FROM usuarios WHERE username = :username AND password = :password;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        if (isset($datos[0])) {
            $roles = array();
            $roles = $this->getRol($username);
            $privilegios = array();
            $privilegios = $this->getPrivilegio($username);
            $_SESSION['valido'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['roles'] = $roles;
            $_SESSION['privilegios'] = $privilegios;
            return $datos[0];
        } else {
            $this->logout();
        }
        return false;
    }

    public function logout()
    {
        unset($_SESSION);
        session_destroy();
    }

    public function checkRol($rol, $kill = false)
    {
        if (isset($_SESSION['roles'])) {
            if ($_SESSION['valido']) {
                if (in_array($rol, $_SESSION['roles'])) {
                    return true;
                }
            }
        }
        if ($kill) {
            $this->logout();
            $this->alert('danger', '<i class="fa-solid fa-triangle-exclamation"></i> Permiso denegado');
            die();
        }
        return false;
    }

    public function checkPrivilegio($privilegio, $kill = false)
    {
        if (isset($_SESSION['privilegios'])) {
            if ($_SESSION['valido']) {
                if (in_array($privilegio, $_SESSION['privilegios'])) {
                    return true;
                }
            }
        }
        if ($kill) {
            $this->logout();
            $this->alert('danger', '<i class="fa-solid fa-triangle-exclamation"></i> Permiso denegado');
            die();
        }
        return false;
    }

    function alert($type, $message)
    {
        $alert = array();
        $alert['type'] = $type;
        $alert['message'] = $message;
        include __DIR__ . '/components/alert.php';
    }

    function setCount($count)
    {
        $this->count = $count;
    }

    function getCount()
    {
        return $this->count;
    }

    function upload($carpeta, $prefijo)
    {
        if (in_array($_FILES['imagen']['type'], $this->getImageType())) {
            if ($_FILES['imagen']['size'] <= $this->getImageSize()) {
                $n = rand(1, 1000000);
                $nombre_archivo = $n . $_FILES['imagen']['size'] . $_FILES['imagen']['name'];
                $nombre_archivo = str_replace(' ', '', $prefijo) . '_' . md5($nombre_archivo);
                $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
                $nombre_archivo = $nombre_archivo . '.' . $extension;
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
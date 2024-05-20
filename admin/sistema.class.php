<?php
require_once 'config.php';

use PHPMailer\PHPMailer\PHPMailer;

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

    public function reset($username)
    {
        if ($this->checkEmail($username)) {
            $this->connect();
            $sql = "SELECT * FROM usuarios WHERE username = :username;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $datos = $stmt->fetchAll();
            if (isset($datos[0])) {
                $token1 = md5($username . 'R4nD0M');
                $token2 = md5($username . date('Y-m-d H:i:s') . rand(1, 1000000));
                $token = $token1 . $token2;
                $sql = "UPDATE usuarios SET token = :token WHERE username = :username;";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':token', $token, PDO::PARAM_STR);
                $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                $stmt->execute();
                $destinatario = $username;
                $usuario = $datos[0]['username'];
                $asunto = 'Recuperación de contraseña';
                $cuerpo = 'Hola ' . $usuario . ',<br><br>';
                $cuerpo .= 'Hemos recibido una solicitud de recuperación de contraseña.<br>';
                $cuerpo .= 'Para recuperar tu contraseña, haz click en el siguiente enlace:<br>';
                $cuerpo .= '<a href="http://localhost/clinicadental/admin/login.php?action=RECOVERY&token=' . $token . '">Reestablecer contraseña</a><br><br>';
                $cuerpo .= 'Si no has solicitado la recuperación de contraseña, ignora este mensaje.<br><br>';
                $cuerpo .= 'Atentamente,<br>';
                $cuerpo .= 'El equipo de Clinica Dental Integral';
                if ($this->sendMail($destinatario, $username, $asunto, $cuerpo)) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        return false;
    }

    public function recovery($token, $password = null)
    {
        $this->connect();
        if (strlen($token) == 64) {
            $sql = "SELECT * FROM usuarios WHERE token = :token;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':token', $token, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $datos = $stmt->fetchAll();
            if (isset($datos[0])) {
                if ($password != null) {
                    $password = md5($password);
                    $username = $datos[0]['username'];
                    $sql = "UPDATE usuarios SET password = :password, token = null WHERE username = :username;";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
                    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                    $stmt->execute();
                }
                return true;
            }
        }
        return false;
    }

    private function checkEmail($username)
    {
        return filter_var($username, FILTER_VALIDATE_EMAIL);
    }

    private function sendMail($destinatario, $username, $asunto, $mensaje)
    {
        require dirname(__DIR__) . '/vendor/autoload.php';
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->SMTPAuth = true;
        $mail->Username = '21030017@itcelaya.edu.mx';
        $mail->Password = 'zhpnrgjwjfsjzmip';
        $mail->setFrom('21030017@itcelaya.edu.mx', 'GUSTAVO RAMIREZ MIRELES');
        $mail->addAddress($destinatario, $username);
        $mail->Subject = $asunto;
        $mail->CharSet = PHPMailer::CHARSET_UTF8;
        $mail->msgHTML($mensaje);
        if (!$mail->send())
            return false;
        else
            return true;
    }

    public function register($datos)
    {
        if (!$this->checkEmail($datos['correo'])) {
            $this->alert('danger', '<i class="fa-solid fa-triangle-exclamation"></i> El correo electrónico no es válido');
            return false;
        }
        $this->connect();
        try {
            $this->conn->beginTransaction();
            $sql = "SELECT * FROM usuarios WHERE username = :username;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $datos['correo'], PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $usuario = $stmt->fetchAll();
            if (isset($usuario[0])) {
                $this->alert('danger', '<i class="fa-solid fa-triangle-exclamation"></i> El correo electrónico ya existe');
                $this->conn->rollback();
                return false;
            }
            $sql = "INSERT INTO usuarios (username, password) VALUES (:username, :password)";
            $stmt = $this->conn->prepare($sql);
            $correo = $datos['correo'];
            $password = $datos['password'];
            $password = md5($password);
            $stmt->bindParam(':username', $correo, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->execute();
            $sql = "SELECT * FROM usuarios WHERE username = :username;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $correo, PDO::PARAM_STR);
            $stmt->execute();
            $usuario = array();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $usuario = $stmt->fetchAll();
            if (isset($usuario[0])) {
                $id_usuario = $usuario[0]['id_usuario'];
                $sql = "INSERT INTO usuario_rol (id_usuario, id_rol) VALUES (:id_usuario, 3);";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                $stmt->execute();
                $sql = "INSERT INTO clientes (nombre, apellido_paterno, apellido_materno, telefono, id_usuario) VALUES (:nombre, :apellido_paterno, :apellido_materno, :telefono, :id_usuario);";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
                $stmt->bindParam(':apellido_paterno', $datos['apellido_paterno'], PDO::PARAM_STR);
                $stmt->bindParam(':apellido_materno', $datos['apellido_materno'], PDO::PARAM_STR);
                $stmt->bindParam(':telefono', $datos['telefono'], PDO::PARAM_STR);
                $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                $stmt->execute();
                $sql = "SELECT * FROM clientes c JOIN usuarios u ON c.id_usuario = :id_usuario;";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                $stmt->execute();
                $cliente = array();
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $cliente = $stmt->fetchAll();
                if (isset($cliente[0])) {
                    $nombreCliente = $cliente[0]['nombre'] . " " . $cliente[0]['apellido_paterno'] . " " . $cliente[0]['apellido_materno'];
                    $this->alert('success', '<i class="fa-solid fa-check"></i> Registro exitoso');
                    $cuerpo = "Hola {$nombreCliente} <br>";
                    $cuerpo.= "Gracias por registrarte en Clinica Dental Integral.<br>";
                    $cuerpo.= "Para ingresar a tu cuenta, haz click en el siguiente enlace:<br>";
                    $cuerpo.= "<a href='http://localhost/clinicadental/admin/login.php'>Iniciar sesión</a><br><br>";
                    $cuerpo.= "El equipo de Clinica Dental Integral";
                    $this->sendMail($correo, $nombreCliente, "Registro en Clinica Dental Integral", $cuerpo);
                    $this->conn->commit();
                    return true;
                }
                $this->alert('danger', '<i class="fa-solid fa-triangle-exclamation"></i> No se pudo registrar');
                $this->conn->rollback();
                return false;
            }
        } catch (PDOException $e) {
            $this->alert('danger', '<i class="fa-solid fa-triangle-exclamation"></i> No se pudo registrar');
            return false;
        }
    }
}
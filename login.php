<?php
include __DIR__ . '/components/headerSinNavbar.php';
include __DIR__ . '/admin/sistema.class.php';
$app = new Sistema();
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
if (isset($_SESSION['valido']) && $action != "LOGOUT") {
    $app->alert("danger", "Ya hay una sesión abierta");
    header("refresh:2;url=index.php");
}
switch ($action) {
    case "LOGOUT":
        $app->logout();
        $app->alert('success', '<i class="fa fa-check"></i> Has cerrado sesión correctamente');
        header("refresh:3;url=" . basename(__FILE__));
        break;
    case 'LOGIN':
        $username = $_POST['username'];
        $password = $_POST['password'];
        if ($app->login($username, $password)) {
            header('Location: index.php');
        } else {
            $app->alert('danger', '<i class="fa-solid fa-circle-xmark"></i> Usuario o contraseña incorrectos');
            header("refresh:3;url=" . basename(__FILE__));
            include __DIR__ . '/views/login/index.php';
        }
        break;
    case 'FORGOT':
        include __DIR__ . '/views/login/forgot.php';
        break;
    case 'RESET':
        $username = $_POST['username'];
        $reset = $app->reset($username);
        if ($reset) {
            $app->alert('success', '<i class="fa-solid fa-circle-check"></i> Correo enviado correctamente');
            header("refresh:3;url=" . basename(__FILE__));
            include __DIR__ . '/views/login/forgot.php';
        } else {
            $app->alert('danger', '<i class="fa-solid fa-circle-xmark"></i> Correo no encontrado');
            header("refresh:3;url=" . basename(__FILE__));
            include __DIR__ . '/views/login/forgot.php';
        }
        break;
    case 'RECOVERY':
        if (isset($_GET['token'])) {
            $token = $_GET['token'];
            if ($app->recovery($token)) {
                if (isset($_POST['password'])) {
                    $password = $_POST['password'];
                    if ($app->recovery($token, $password)) {
                        $app->alert('success', '<i class="fa-solid fa-circle-check"></i> Contraseña actualizada correctamente');
                        header("refresh:3;url=" . basename(__FILE__));
                    } else {
                        $app->alert('danger', '<i class="fa-solid fa-circle-xmark"></i> No se ha podido actualizar la contraseña');
                        die();
                    }
                }
                include __DIR__ . '/views/login/recovery.php';
                die();
            }
            $app->alert('danger', '<i class="fa-solid fa-circle-xmark"></i> Token no válido');
            header("refresh:3;url=" . basename(__FILE__));
        }
        break;
    case 'REGISTRO':
        include __DIR__. '/views/login/registro.php';
        break;
    case 'SIGNUP':
        $datos = $_POST;
        $app->register($datos);
        header("refresh:3;url=". basename(__FILE__));
        break;
    default:
        include __DIR__ . '/views/login/index.php';
        break;
}
include __DIR__ . '/components/footerVacio.php';

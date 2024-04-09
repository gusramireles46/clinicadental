<?php
include __DIR__ . '/components/headerSinNavbar.php';
include __DIR__ . '/sistema.class.php';
$app = new Sistema();
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
switch ($action) {
    case 'LOGOUT':
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
    default:
        include __DIR__ . '/views/login/index.php';
        break;
}
include __DIR__ . '/components/footer.php';

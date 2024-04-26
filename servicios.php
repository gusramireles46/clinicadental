<?php
include __DIR__ . '/admin/servicios.class.php';
include __DIR__ . '/components/header.php';
$web = new Servicio();
$action = isset($_GET['action']) ? $_GET['action'] : null;
$id_servicio = isset($_GET['id_servicio']) ? $_GET['id_servicio'] : null;
$datos = array();
$alert = array();
switch ($action) {
    case 'DETALLES':
        if ($datos = $web->getById($id_servicio)) {
            print_r($datos);
        } else {
            $web->alert('danger', 'El servicio no ha sido encontrado');
            header("refresh:3;url=servicios.php");
        }
        break;
    default:
        $datos = $web->getAll();
        include __DIR__ . '/views/servicios/index.php';
        break;
}
include __DIR__ . '/components/footer.php';

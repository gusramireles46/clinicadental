<?php
include __DIR__ . '/servicios.class.php';
include __DIR__ . '/components/header.php';
$app = new Servicio();
$servicios = $app->getAll();
$action = isset($_GET['action']) ? $_GET['action'] : null;
$id_servicio = isset($_GET['id_servicio']) ? $_GET['id_servicio'] : null;
$datos = array();
$alert = array();
switch ($action) {
    case 'CREATE':
        include __DIR__ . '/views/servicios/form.php';
        break;
    case 'EDIT':
        $datos = $app->getById($id_servicio);
        if (isset($datos['id_servicio'])) {
            include __DIR__ . '/views/servicios/form.php';
        } else {
            $app->alert('danger', '<i class="fa-solid fa-circle-xmark"></i> No se ha podido eliminar el servicio');
            include __DIR__ . '/views/servicios/index.php';
        }
        $datos = $app->getAll();
        break;
    default:
        $datos = $app->getAll();
        include __DIR__ . '/views/servicios/index.php';
        break;
}
include __DIR__ . '/components/footer.php';

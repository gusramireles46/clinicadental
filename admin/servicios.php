<?php
include __DIR__ . '/servicios.class.php';
include __DIR__ . '/categorias.class.php';
include __DIR__ . '/components/header.php';
$app = new Servicio();
$appCategoria = new Categoria();
$servicios = $app->getAll();
$categorias = $appCategoria->getAll();
$action = isset($_GET['action']) ? $_GET['action'] : null;
$id_servicio = isset($_GET['id_servicio']) ? $_GET['id_servicio'] : null;
$datos = array();
$alert = array();
switch ($action) {
    case 'CREATE':
        include __DIR__ . '/views/servicios/form.php';
        break;
    case 'UPDATE':
        $datos = $_POST;
        if ($app->update($id_servicio, $datos)) {
            $app->alert('success', '<i class="fa-solid fa-circle-check"></i> Servicio actualizado correctamente');
        } else {
            $app->alert('danger', '<i class="fa-solid fa-circle-xmark"></i> No se ha podido actualizar el servicio especificado');
        }
        $datos = $app->getAll();
        include __DIR__ . '/views/servicios/index.php';
        break;
    case 'DELETE':
        if ($app->delete($id_servicio)) {
            $app->alert('success', '<i class="fa-solid fa-circle-check"></i> Servicio eliminado correctamente');
        } else {
            $app->alert('danger', '<i class="fa-solid fa-circle-xmark"></i> No se ha podido eliminar el servicio');
        }
        $datos = $app->getAll();
        include __DIR__ . '/views/servicios/index.php';
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
    case 'SAVE':
        $datos = $_POST;
        if ($app->insert($datos)) {
            $app->alert('success', '<i class="fa-solid fa-circle-check"></i> Servicio agregado correctamente');
        } else {
            $app->alert('danger', '<i class="fa-solid fa-circle-xmark"></i> No se ha podido registrar el servicio');
        }
        $datos = $app->getAll();
        include __DIR__ . '/views/servicios/index.php';
        break;
    default:
        $datos = $app->getAll();
        include __DIR__ . '/views/servicios/index.php';
        break;
}
include __DIR__ . '/components/footer.php';

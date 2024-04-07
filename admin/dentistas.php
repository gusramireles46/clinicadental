<?php
include __DIR__ . '/dentistas.class.php';
include __DIR__ . '/components/header.php';
$app = new Dentista();
$dentistas = $app->getAll();
$action = isset($_GET['action']) ? $_GET['action'] : null;
$id_dentista = isset($_GET['id_dentista']) ? $_GET['id_dentista'] : null;
$datos = array();
$alert = array();
switch ($action) {
    case 'CREATE':
        include __DIR__ . '/views/dentistas/form.php';
        break;
    case 'UPDATE':
        $datos = $_POST;
        if ($app->update($id_dentista, $datos)) {
            $app->alert('success', '<i class="fa-solid fa-circle-check"></i> Dentista actualizada correctamente');
        } else {
            $app->alert('danger', '<i class="fa-solid fa-circle-xmark"></i> No se ha podido eliminar el dentista');
        }
        $datos = $app->getAll();
        include __DIR__ . '/views/dentistas/index.php';
        break;
    case 'DELETE':
        if ($app->delete($id_dentista)) {
            $app->alert('success', '<i class="fa-solid fa-circle-check"></i> Dentista eliminada correctamente');
        } else {
            $app->alert('danger', '<i class="fa-solid fa-circle-xmark"></i> No se ha podido eliminar el dentista');
        }
        $datos = $app->getAll();
        include __DIR__ . '/views/dentistas/index.php';
        break;
    case 'SAVE':
        $datos = $_POST;
        if ($app->insert($datos)) {
            $app->alert('success', '<i class="fa-solid fa-circle-check"></i> Servicio agregado correctamente');
        } else {
            $app->alert('danger', '<i class="fa-solid fa-circle-xmark"></i> No se ha podido registrar el servicio');
        }
        $datos = $app->getAll();
        include __DIR__ . '/views/dentistas/index.php';
        break;
    case 'EDIT':
        $datos = $app->getById($id_dentista);
        if (isset($datos['id_dentista'])) {
            include __DIR__ . '/views/dentistas/form.php';
        } else {
            $app->alert('danger', '<i class="fa-solid fa-circle-xmark"></i> No se ha podido encontrar el dentista');
            $app->getAll();
            include __DIR__ . '/views/dentistas/index.php';
        }
        break;
    default:
        $datos = $app->getAll();
        include __DIR__ . '/views/dentistas/index.php';
        break;

}
include __DIR__ . '/components/footer.php';

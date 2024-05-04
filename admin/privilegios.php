<?php
include __DIR__ . '/privilegios.class.php';
include __DIR__ . '/components/header.php';
$app = new Privilegio();
$app->checkRol('Administrador', true);
$privilegios = $app->getAll();
$action = isset($_GET['action']) ? $_GET['action'] : null;
$id_privilegio = isset($_GET['id_privilegio']) ? $_GET['id_privilegio'] : null;
$datos = array();
switch ($action) {
    case 'CREATE':
        include __DIR__ . '/views/privilegios/form.php';
        break;
    case 'SAVE':
        $datos = $_POST;
        if ($app->insert($datos)) {
            $app->alert('success', '<i class="fa-solid fa-circle-check"></i> Privilegio creado correctamente');
        } else {
            $app->alert('danger', '<i class="fa-solid fa-circle-xmark"></i> No se ha podido crear el privilegio');
        }
        $datos = $app->getAll();
        include __DIR__ . '/views/privilegios/index.php';
        break;
    case 'DELETE':
        if ($app->delete($id_privilegio)) {
            $app->alert('success', '<i class="fa-solid fa-circle-check"></i> Privilegio eliminado correctamente');
        } else {
            $app->alert('danger', '<i class="fa-solid fa-circle-xmark"></i> No se ha podido eliminar el privilegio');
        }
        $datos = $app->getAll();
        include __DIR__ . '/views/privilegios/index.php';
        break;
    case 'EDIT':
        $datos = $app->getById($id_privilegio);
        if (isset($datos['id_privilegio'])) {
            include __DIR__ . '/views/privilegios/form.php';
        } else {
            $app->alert('danger', '<i class="fa-solid fa-circle-xmark"></i> No se ha podido encontrar el privilegio');
            $datos = $app->getAll();
            include __DIR__ . '/views/privilegios/index.php';
        }
        break;
    case 'UPDATE':
        $datos = $_POST;
        if ($app->update($datos, $id_privilegio)) {
            $app->alert('success', '<i class="fa-solid fa-circle-check"></i> Privilegio actualizado correctamente');
        } else {
            $app->alert('danger', '<i class="fa-solid fa-circle-xmark"></i> No se ha podido actualizar el privilegio');
        }
        $datos = $app->getAll();
        include __DIR__ . '/views/privilegios/index.php';
        break;
    default:
        $datos = $app->getAll();
        include __DIR__ . '/views/privilegios/index.php';
        break;
}
include __DIR__ . '/components/footer.php';
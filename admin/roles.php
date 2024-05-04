<?php
include __DIR__ . '/roles.class.php';
include __DIR__ . '/privilegios.class.php';
include __DIR__ . '/components/header.php';
$app = new Rol();
$appPrivilegios = new Privilegio();
$app->checkRol('Administrador', true);
$privileges = $appPrivilegios->getAll();
$action = isset($_GET['action']) ? $_GET['action'] : null;
$id_rol = isset($_GET['id_rol']) ? $_GET['id_rol'] : null;
$datos = array();
$privilegios = array();
$alert = array();
switch ($action) {
    case 'CREATE':
        include __DIR__ . '/views/roles/form.php';
        break;
    case 'DELETE':
        if ($app->delete($id_rol)) {
            $app->alert('success', '<i class="fa-solid fa-circle-check"></i> Rol eliminado correctamente');
        } else {
            $app->alert('danger', '<i class="fa-solid fa-circle-xmark"></i> No se pudo eliminar el rol');
        }
        $datos = $app->getAll();
        include __DIR__ . '/views/roles/index.php';
        break;
    case 'EDIT':
        $datos = $app->getById($id_rol);
        $privilegios = $app->getPrivilegiosRol($id_rol);
        if (isset($datos['id_rol'])) {
            include __DIR__ . '/views/roles/form.php';
        } else {
            $app->alert('danger', '<i class="fa-solid fa-circle-xmark"></i> No se ha podido encontrar el rol');
            $datos = $app->getAll();
            include __DIR__ . '/views/roles/index.php';
        }
        break;
    case 'UPDATE':
        $datos = $_POST;
        if ($app->update($id_rol, $datos)) {
            $app->alert('success', '<i class="fa-solid fa-circle-check"></i> Rol actualizado correctamente');
        } else {
            $app->alert('danger', '<i class="fa-solid fa-circle-xmark"></i> No se ha podido actualizar el rol');
        }
        $datos = $app->getAll();
        include __DIR__ . '/views/roles/index.php';
        break;
    case 'SAVE':
        $datos = $_POST;
//        print_r($datos);
        if ($app->insert($datos)) {
            $app->alert('success', '<i class="fa-solid fa-circle-check"></i> Rol agregado correctamente');
        } else {
            $app->alert('danger', '<i class="fa-solid fa-circle-xmark"></i> No se ha podido agregar el rol');
        }
        $datos = $app->getAll();
        include __DIR__ . '/views/roles/index.php';
        break;
    default:
        $datos = $app->getAll();
        include __DIR__ . '/views/roles/index.php';
        break;
}
include __DIR__. '/components/footer.php';
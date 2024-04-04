<?php
include __DIR__ . '/categorias.class.php';
include __DIR__ . '/components/header.php';
$app = new Categoria();
$categorias = $app->getAll();
$action = isset($_GET['action']) ? $_GET['action'] : null;
$id_categoria = isset($_GET['id_categoria']) ? $_GET['id_categoria'] : null;
$datos = array();
$alert = array();
switch ($action) {
    case 'CREATE':
        include __DIR__ . '/views/categorias/form.php';
        break;
    case 'UPDATE':
        $datos = $app->getOne($id_categoria);
        if (isset($datos['id_categoria'])) {
            include __DIR__ . '/views/categorias/form.php';
        } else {
            $alert['type'] = 'danger';
            $alert['message'] = '<i class="fa-solid fa-circle-xmark"></i> No se ha encontrado la categoria especificada';
            $datos = $app->getAll();
            include __DIR__ . '/components/alert.php';
            include __DIR__ . '/views/categorias/index.php';
        }
        break;
    case 'DELETE':
        break;
    default:
        $datos = $app->getAll();
        include __DIR__ . '/views/categorias/index.php';
        break;
}
include __DIR__ . '/components/footer.php';
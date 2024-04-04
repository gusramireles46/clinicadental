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
            $datos = $app->getAll();
            $app->alert('danger', '<i class="fa-solid fa-circle-xmark"></i> No se ha encontrado la categoria especificada');
            include __DIR__ . '/views/categorias/index.php';
        }
        break;
    case 'DELETE':
        break;
    case 'SAVE':
        $datos = $_POST;
        if ($app->insert($datos)) {
            $app->alert('success', '<i class="fa-solid fa-circle-check"></i> Categoria agregada correctamente');
        } else {
            $app->alert('danger', '<i class="fa-solid fa-circle-xmark"></i> No se pudo registrar la categoria');
        }
        $datos = $app->getAll();
        include __DIR__ . '/views/categorias/index.php';
        break;
    default:
        $datos = $app->getAll();
        include __DIR__ . '/views/categorias/index.php';
        break;
}
include __DIR__ . '/components/footer.php';
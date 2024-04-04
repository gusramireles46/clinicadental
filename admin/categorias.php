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
        $datos = $_POST;
        if ($app->update($id_categoria, $datos)) {
            $app->alert('success', '<i class="fa-solid fa-circle-check"></i> Categoria actualizada correctamente');
        } else {
            $app->alert('danger', '<i class="fa-solid fa-circle-xmark"></i> No se ha podido actualizar la categoria especificada');
        }
        $datos = $app->getAll();
        include __DIR__ . '/views/categorias/index.php';
        break;
    case 'DELETE':
        if ($app->delete($id_categoria)) {
            $app->alert('success', '<i class="fa-solid fa-circle-check"></i> Categoria eliminada correctamente');
        } else {
            $app->alert('danger', '<i class="fa-solid fa-circle-xmark"></i> No se ha podido eliminar la categoria');
//            header("refresh:5;url=basename(__FILE__)");
        }
        $datos = $app->getAll();
        include __DIR__ . '/views/categorias/index.php';
        break;
    case 'EDIT':
        $datos = $app->getById($id_categoria);
        if (isset($datos['id_categoria'])) {
            include __DIR__ . '/views/categorias/form.php';
        } else {
            $datos = $app->getAll();
            $app->alert('danger', '<i class="fa-solid fa-circle-xmark"></i> No se ha encontrado la categoria especificada');
//            header("refresh:2;url=" . basename(__FILE__));
            include __DIR__ . '/views/categorias/index.php';
        }
        break;
    case 'SAVE':
        $datos = $_POST;
        if ($app->insert($datos)) {
            $app->alert('success', '<i class="fa-solid fa-circle-check"></i> Categoria agregada correctamente');
        } else {
            $app->alert('danger', '<i class="fa-solid fa-circle-xmark"></i> No se ha podido registrar la categoria');
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
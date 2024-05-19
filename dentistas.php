<?php
include __DIR__ . '/admin/dentistas.class.php';
include __DIR__ . '/components/header.php';
$web = new Dentista();
$action = isset($_GET['action']) ? $_GET['action'] : null;
$id_dentista = isset($_GET['id_dentista']) ? $_GET['id_dentista'] : null;
$datos = array();
$alert = array();
switch ($action) {
    case 'DETALLES':
        if ($datos = $web->getById($id_dentista)) {
            include __DIR__ . '/views/dentistas/detalles.php';
        } else {
            $web->alert('danger', 'El dentista no ha sido encontrado');
            header("refresh:3;url=servicios.php");
        }
        break;
    default:
        $datos = $web->getAll();
        include __DIR__ . '/views/dentistas/index.php';
        break;
}
include __DIR__ . '/components/footer.php';

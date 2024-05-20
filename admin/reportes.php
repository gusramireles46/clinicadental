<?php
include __DIR__ . '/reportes.class.php';
$app = new Reportes();
$app->checkRol('Administrador', true);
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
switch ($action) {
    case 'DENTISTAS':
        $app->dentistas();
        break;
    case "USUARIOS":
        $app->usuarios();
        break;
    default:
        include __DIR__ . '/components/header.php';
        break;
}
<?php
include __DIR__ . "/usuarios.class.php";
include __DIR__ . "/clientes.class.php";
include __DIR__ . "/components/header.php";
$app = new Usuario();
$app->checkRol("Administrador", true);
$usuarios = $app->getAll();
$action = isset($_GET["action"])? $_GET["action"] : null;
$id_usuario = isset($_GET["id_usuario"])? $_GET["id_usuario"] : null;
$clientes = new Cliente();
$datos = array();
$alert = array();
switch ($action) {
    case "CREATE":
        include __DIR__. "/views/usuarios/form.php";
        break;
    default:
        $datos = $usuarios;
        include __DIR__. "/views/usuarios/index.php";
        break;
}

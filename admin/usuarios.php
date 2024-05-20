<?php
include __DIR__ . "/usuarios.class.php";
include __DIR__ . "/roles.class.php";
include __DIR__ . "/components/header.php";
$app = new Usuario();
$app->checkRol("Administrador", true);
$appRoles = new Rol();
$usuarios = $app->getAll();
$roles = $appRoles->getAll();
$action = isset($_GET["action"])? $_GET["action"] : null;
$id_usuario = isset($_GET["id_usuario"])? $_GET["id_usuario"] : null;
$datos = array();
$roles = array();
$alert = array();
switch ($action) {
    case "CREATE":
        include __DIR__. "/views/usuarios/form.php";
        break;
    case "SAVE":
        $datos = $_POST;
        if ($app->insert($datos)) {
            $app->alert("success", "<i class='fa-solid fa-circle-check'></i> Usuario creado correctamente");
        } else {
            $app->alert("danger", "<i class='fa-solid fa-circle-xmark'></i> No se pudo crear el usuario");
        }
        break;
    case "UPDATE":
        $datos = $_POST;
        $app->update($datos, $id_usuario);
        header("refresh:2; url=". basename(__FILE__));
        break;
    case "EDIT":
        $datos = $app->getById($id_usuario);
        include __DIR__. "/views/usuarios/form.php";
        break;
    case "DELETE":
        break;
    default:
        $datos = $usuarios;
        include __DIR__. "/views/usuarios/index.php";
        break;
}

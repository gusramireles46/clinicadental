<?php
include __DIR__ . "/productos.class.php";
include __DIR__ . "/components/header.php";
$app = new Producto();
$app->checkRol("Administrador", true);
$productos = $app->getAll();
$action = isset($_GET["action"]) ? $_GET["action"] : null;
$id_producto = isset($_GET["id_producto"]) ? $_GET["id_producto"] : null;
$datos = array();
$alert = array();
switch ($action) {
    case "CREATE":
        include __DIR__ . "/views/productos/form.php";
        break;
    case "UPDATE":
        $datos = $_POST;
        if ($app->update($id_producto, $datos)) {
            $app->alert("success", "<i class='fa-solid fa-circle-check'></i> Producto actualizado correctamente");
        } else {
            $app->alert("danger", "<i class='fa-solid fa-circle-xmark'></i> Error al actualizar el producto");
        }
        $productos = $app->getAll();
        include __DIR__. "/views/productos/index.php";
        break;
    case "DELETE":
        if ($app->delete($id_producto)) {
            $app->alert("success", "<i class='fa-solid fa-circle-check'></i> Producto eliminado correctamente");
        } else {
            $app->alert("danger", "<i class='fa-solid fa-circle-xmark'></i> Error al eliminar el producto");
        }
        $productos = $app->getAll();
        include __DIR__. "/views/productos/index.php";
        break;
    case "EDIT":
        $datos = $app->getById($id_producto);
        if (isset($datos["id_producto"])) {
            include __DIR__. "/views/productos/form.php";
        } else {
            $app->alert("danger", "<i class='fa-solid fa-circle-xmark'></i> No se ha podido encontrar el producto");
        }
        break;
    case "SAVE":
        $datos = $_POST;
        if ($app->insert($datos)) {
            $app->alert("success", "<i class='fa-solid fa-circle-check'></i> Producto agregado correctamente");
        } else {
            $app->alert("danger", "<i class='fa-solid fa-circle-xmark'></i> Error al agregar el producto");
        }
        $productos = $app->getAll();
        include __DIR__. "/views/productos/index.php";
        break;
    default:
        include __DIR__ . "/views/productos/index.php";
        break;
}
include __DIR__ . "/components/footer.php";

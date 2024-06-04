<?php
/*echo "<pre>";
print_r($_SERVER);
echo "</pre>";
die();*/
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
include dirname(__DIR__) . "/admin/productos.class.php";
$id_producto = isset($_GET["id_producto"]) ? $_GET["id_producto"] : null;
$action = isset($_SERVER["REQUEST_METHOD"]) ? $_SERVER["REQUEST_METHOD"] : "GET";

class ProductosAPI extends Producto
{
    public function read()
    {
        $productos = $this->getAll();
        echo json_encode($productos);
    }

    public function readOne($id_producto)
    {
        $producto = $this->getById($id_producto);
        if (isset($producto['id_producto'])) {
            echo json_encode($producto);
        } else {
            $producto['message'] = "No se ha encontrado el producto";
            echo json_encode($producto);
        }
    }

    public function create($datos)
    {
        if ($this->insert($datos)) {
            $producto['message'] = "Producto insertado correctamente";
            echo json_encode($producto);
        } else {
            $producto['message'] = "No se ha podido insertar el producto";
            echo json_encode($producto);
        }
    }

    public function modify($id_producto, $datos)
    {
        if ($this->update($id_producto, $datos)) {
            $producto['message'] = "Producto actualizado correctamente";
            echo json_encode($producto);
        } else {
            $producto['message'] = "No se ha podido actualizar el producto";
            echo json_encode($producto);
        }
    }
}

$app = new ProductosAPI();
switch ($action) {
    case "GET":
    default:
        if (isset($_GET['id_producto'])) {
            $app->readOne($id_producto);
        } else {
            $app->read();
        }
        break;
    case "POST":
        $datos = $_POST;
        $datos['producto'] = $_POST['producto'];
        $datos['precio'] = $_POST['precio'];
        $datos['imagen'] = $_FILES;
        if (isset($_GET['id_producto'])) {
            $id_producto = $_GET['id_producto'];
            $app->modify($id_producto, $datos);
        } else {
            $app->create($datos);
        }
        break;
}
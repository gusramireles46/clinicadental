<?php
include __DIR__ . '/admin/productos.class.php';

$productos = new Producto();
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$cartContents = array();

foreach ($cart as $id_producto => $cantidad) {
    $producto = $productos->getById($id_producto);
    if ($producto) {
        $producto['cantidad'] = $cantidad;
        $producto['precio_total'] = $producto['precio'] * $cantidad;
        $cartContents[] = $producto;
    }
}

echo json_encode($cartContents);

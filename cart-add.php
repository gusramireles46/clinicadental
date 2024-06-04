<?php
error_reporting(0);
session_start();
include __DIR__ . '/admin/productos.class.php';
$web = new Producto();
$id_producto = isset($_GET['id_producto']) ? $_GET['id_producto'] : null;
$cantidad = 1;
$datos = $web->getById($id_producto);
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
$_SESSION['cart'][$id_producto] += $cantidad;

echo json_encode(array('status' => 'success', 'message' => 'Producto agregado al carrito'));

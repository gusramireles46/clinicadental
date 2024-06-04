<?php
include __DIR__ . '/admin/productos.class.php';
include __DIR__ . '/components/header.php';
$web = new Producto();
$productos = array();
$productos = $web->getAll();
print_r($_SESSION);
if (isset($_SESSION['valido'])) {
    if ($_SESSION['valido']) {
        $carrito = array();
        if (isset($_SESSION['cart']))
            $carrito = $_SESSION['cart'];
    } else {
        header('Location: login.php');
    }
} else {
    header('Location: login.php');
}
include __DIR__ . '/views/cart/checkout.php';
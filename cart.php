<?php
include __DIR__ . "/admin/productos.class.php";
include __DIR__ . "/components/header.php";
$web = new Producto();
$productos = array();
$productos = $web->getAll();
$cart = array();
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
}
include __DIR__ . "/views/cart/index.php";
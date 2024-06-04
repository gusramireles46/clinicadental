<?php
include __DIR__ . '/admin/productos.class.php';
$web = new Producto();
$datos = $web->productsFromApi();
include __DIR__. '/components/header.php';
include __DIR__. '/views/productos/index.php';
include __DIR__. '/components/footer.php';
/*echo '<pre>';
print_r($datos);
echo '</pre>';
die();*/


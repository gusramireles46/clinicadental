<?php
include __DIR__ . '/sistema.class.php';
include __DIR__ . '/components/header.php';
$app = new Sistema();
$app->checkRol('Administrador', true);
echo "Bievenido {$_SESSION['username']}";
include __DIR__ . '/components/footer.php';
<?php
include __DIR__ . '/components/header.php';
include __DIR__ . '/sistema.class.php';
$app = new Sistema();
$app->checkRol('Administrador', true);
echo "<pre>";
print_r($app->getRol('admin@clinicadental.com'));
echo "</pre>";

echo "<pre>";
print_r($app->getPrivilegio('admin@clinicadental.com'));
echo "</pre>";
?>

<?php
include __DIR__ . '/components/footer.php';
?>
<?php
include __DIR__ . '/sistema.class.php';
include __DIR__ . '/components/header.php';
$app = new Sistema();
$app->checkRol('Administrador', true);
echo '
<div class="container">
    <h1>Pagina de inicio del administrador</h1>
</div>
';
include __DIR__ . '/components/footer.php';
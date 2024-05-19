<div class="container">
    <p class="fs-3">Dentistas</p>
    <div class="row mb-3">
        <div class="col-lg-4">
            <a href="usuarios.php?action=CREATE" class="btn btn-success">Nuevo</a>
            <a href="reportes.php?action=USUARIOS" class="btn btn-warning" target="_blank">Generar lista</a>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <table class="table table-bordered">
                <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($datos as $dato) : ?>
                    <tr>
                        <td class="align-middle"><?php echo $dato['id_usuario']; ?></td>
                        <td class="align-middle"><?php echo $dato['username']; ?></td>
                        <td class="align-middle"><?php echo $dato['rol']; ?></td>
                        <td class="align-middle">
                            <div class="btn-group">
                                <a href="usuarios.php?action=EDIT&id_usuario=<?php echo $dato['id_usuario']; ?>"
                                   class="btn btn-primary mb-3">Editar</a>
                                <a href="usuarios.php?action=DELETE&id_usuario=<?php echo $dato['id_usuario']; ?>"
                                   class="btn btn-danger mb-3">Eliminar</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
    <p><?php if ($app->getCount() == 0) {
            echo "No se encontraron usuarios";
        } else if ($app->getCount() != 1) {
            echo "Se encontraron " . $app->getCount() . " usuarios";
        } else {
            echo "Se encontró " . $app->getCount() . " dentista";
        } ?></p>
</div>
<?php

<div class="container">
    <p class="fs-3">Roles</p>
    <div class="row mb-3">
        <div class="col-lg-4">
            <a href="roles.php?action=CREATE" class="btn btn-success">Nuevo</a>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <table class="table table-bordered">
                <thead class="table-dark">
                <tr>
                    <th scope="col" style="width: 50px;">ID</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Privilegios</th>
                    <th scope="col" >Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($datos as $dato) :?>
                    <tr>
                        <th class="align-middle" scope="row"><?php echo $dato['id_rol']; ?></th>
                        <td class="align-middle"><?php echo $dato['rol']; ?></td>
                        <td class="align-middle"><?php echo $app->getRolPrivilegio($dato['id_rol']); ?></td>
                        <td class="align-middle">
                            <div class="btn-group">
                                <a href="roles.php?action=EDIT&id_rol=<?php echo $dato['id_rol']; ?>"
                                   class="btn btn-primary mb-3">Editar</a>
                                <a href="roles.php?action=DELETE&id_rol=<?php echo $dato['id_rol']; ?>"
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
            echo "No se encontraron roles";
        } else if ($app->getCount() != 1) {
            echo "Se encontraron " . $app->getCount() . " roles";
        } else {
            echo "Se encontró " . $app->getCount() . " rol";
        } ?></p>
</div>

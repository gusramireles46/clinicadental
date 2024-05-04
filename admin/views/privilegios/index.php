<div class="container">
    <p class="fs-3">Privilegios</p>
    <div class="row mb-3">
        <div class="col-lg-4">
            <a href="privilegios.php?action=CREATE" class="btn btn-success">Nuevo</a>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <table class="table table-bordered">
                <thead class="table-dark">
                <tr>
                    <th scope="col" style="width: 50px;">ID</th>
                    <th scope="col">Privilegio</th>
                    <th scope="col" style="width: 150px;">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($datos as $dato) :?>
                    <tr>
                        <th class="align-middle" scope="row"><?php echo $dato['id_privilegio']; ?></th>
                        <td class="align-middle"><?php echo $dato['privilegio']; ?></td>
                        <td class="align-middle">
                            <div class="btn-group">
                                <a href="privilegios.php?action=EDIT&id_privilegio=<?php echo $dato['id_privilegio']; ?>"
                                   class="btn btn-primary mb-3">Editar</a>
                                <a href="privilegios.php?action=DELETE&id_privilegio=<?php echo $dato['id_privilegio']; ?>"
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
            echo "No se encontraron privilegios";
        } else if ($app->getCount() != 1) {
            echo "Se encontraron " . $app->getCount() . " privilegios";
        } else {
            echo "Se encontró " . $app->getCount() . " privilegio";
        } ?></p>
</div>

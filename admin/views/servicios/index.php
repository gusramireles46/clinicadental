<div class="container">
    <p class="fs-3">Servicios</p>
    <div class="row mb-3">
        <div class="col-lg-4">
            <a href="servicios.php?action=CREATE" class="btn btn-success">Nuevo</a>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <table class="table table-striped">
                <thead>
                <tr class="text-center">
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Categoría</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($datos as $dato) : ?>
                    <tr>
                        <th class="align-middle text-center" scope="row"><?php echo $dato['id_servicio']; ?></th>
                        <td class="align-middle"><?php echo $dato['servicio']; ?></td>
                        <td class="align-middle" style="text-align: justify;"><?php echo $dato['descripcion']; ?></td>
                        <td class="align-middle"><?php echo $dato['categoria']; ?></td>
                        <td class="align-middle text-center"><?php echo ($dato['precio'] == 0) ? 'GRATIS' : '$' .$dato['precio']; ?></td>
                        <td class="align-middle text-center"><img style="width: 85px; height: 85px;" src="../assets/images/servicios/<?php echo $dato['imagen']; ?>" alt="Imagen del <?php echo $dato['servicio'] ?>"></td>
                        <td class="align-middle text-center">
                            <div class="btn-group">
                                <a href="servicios.php?action=EDIT&id_servicio=<?php echo $dato['id_servicio']; ?>" class="btn btn-primary mb-3">Editar</a>
                                <a href="servicios.php?action=DELETE&id_servicio=<?php echo $dato['id_servicio']; ?>" class="btn btn-danger mb-3">Eliminar</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
    <p><?php echo ($app->getCount() != 1) ? "Se encontraron ".$app->getCount()." servicios" : "Se encontró ".$app->getCount()." servicio"?></p>
</div>

<div class="container">
    <p class="fs-3">Servicios</p>
    <div class="row mb-3">
        <div class="col-lg-4">
            <a href="servicios.php?action=CREATE" class="btn btn-success">Nuevo</a>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <table class="table">
                <thead>
                <tr>
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
                        <th class="align-middle" scope="row"><?php echo $dato['id_servicio']; ?></th>
                        <td class="align-middle"><?php echo $dato['servicio']; ?></td>
                        <td class="align-middle"><?php echo $dato['descripcion']; ?></td>
                        <td class="align-middle"><?php echo $dato['categoria']; ?></td>
                        <td class="align-middle">$<?php echo $dato['precio']; ?></td>
                        <td class="align-middle"><img style="width: 65px" src="../assets/images/servicios/<?php echo $dato['imagen']; ?>" alt="Imagen del <?php echo $dato['servicio'] ?>"></td>
                        <td class="align-middle">
                            <div class="btn-group">
                                <a href="servicios.php?action=EDIT&id_servicio=<?php echo $dato['id_servicio']; ?>" class="btn btn-warning mb-3">Editar</a>
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

<div class="container">
    <p class="fs-3">Productos</p>
    <div class="row mb-3">
        <div class="col-lg-4">
            <a href="productos.php?action=CREATE" class="btn btn-success">Nuevo</a>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <table class="table">
                <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($productos as $dato) : ?>

                    <tr>
                        <th class="align-middle" scope="row"><?php echo $dato['id_producto']; ?></th>
                        <td class="align-middle"><img style="width: 65px" src="../assets/images/productos/<?php echo $dato['imagen']; ?>" alt="Imagen de <?php echo $dato['producto'] ?>"></td>
                        <td class="align-middle"><?php echo $dato['producto']; ?></td>
                        <td class="align-middle text-justify">$<?php echo $dato['precio']; ?></td>
                        <td class="align-middle">
                            <div class="btn-group">
                                <a href="productos.php?action=EDIT&id_producto=<?php echo $dato['id_producto']; ?>" class="btn btn-primary mb-3">Editar</a>
                                <a href="productos.php?action=DELETE&id_producto=<?php echo $dato['id_producto']; ?>" class="btn btn-danger mb-3">Eliminar</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
    <p><?php echo ($app->getCount() > 1) ? "Se encontraron ".$app->getCount()." productos" : "Se encontró ".$app->getCount()." producto"?></p>
</div>

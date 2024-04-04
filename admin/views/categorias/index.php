<div class="container">
    <p class="fs-3">Categorias</p>
    <div class="row">
        <div class="col-lg-4">
            <a href="categorias.php?action=CREATE" class="btn btn-success">Nuevo</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($datos as $dato) : ?>
                    <tr>
                        <th class="align-middle" scope="row"><?php echo $dato['id_categoria']; ?></th>
                        <td class="align-middle"><?php echo $dato['categoria']; ?></td>
                        <td class="align-middle"><?php echo $dato['descripcion']; ?></td>
                        <td class="align-middle"><img style="width: 65px" src="../assets/images/categorias/<?php echo $dato['imagen'] ?>" alt="Imagen de <?php echo $dato['categoria'] ?>"></td>
                        <td class="align-middle">
                            <a href="categorias.php?action=UPDATE&id_categoria=<?php echo $dato['id_categoria']; ?>" class="btn btn-warning">Editar</a>
                            <a href="categorias.php?action=DELETE&id_categoria=<?php echo $dato['id_categoria']; ?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="container">
    <p class="fs-3">Dentistas</p>
    <div class="row mb-3">
        <div class="col-lg-4">
            <a href="dentistas.php?action=CREATE" class="btn btn-success">Nuevo</a>
            <a href="reportes.php?action=DENTISTAS" class="btn btn-warning" target="_blank">Generar lista</a>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <table class="table table-bordered">
                <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Fotografia</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido Paterno</th>
                    <th scope="col">Apellido Materno</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Especialidad</th>
                    <th scope="col">Dias hábiles</th>
                    <th scope="col" class="text-center" colspan="2">Horario</th>
                    <th scope="col">Acciones</th>
                </tr>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($datos as $dato) : ?>
                    <tr>
                        <th class="align-middle" scope="row"><?php echo $dato['id_dentista']; ?></th>
                        <td class="align-middle"><img style="width: 85px; height: 85px;"
                                                      src="<?php echo $dato['fotografia']; ?>"
                                                      alt="Foto de <?php echo $dato['nombre'] ?>"></td>
                        <td class="align-middle"><?php echo $dato['nombre']; ?></td>
                        <td class="align-middle"><?php echo $dato['apellido_paterno']; ?></td>
                        <td class="align-middle"><?php echo $dato['apellido_materno']; ?></td>
                        <td class="align-middle"><?php echo $dato['correo']; ?></td>
                        <td class="align-middle"><?php echo $dato['telefono']; ?></td>
                        <td class="align-middle"><?php echo $dato['especialidad']; ?></td>
                        <td class="align-middle"><?php echo $dato['dias_habiles']; ?></td>
                        <td class="align-middle"><?php echo $dato['hora_inicio']; ?></td>
                        <td class="align-middle"><?php echo $dato['hora_fin']; ?></td>
                        <td class="align-middle">
                            <div class="btn-group">
                                <a href="dentistas.php?action=EDIT&id_dentista=<?php echo $dato['id_dentista']; ?>"
                                   class="btn btn-primary mb-3">Editar</a>
                                <a href="dentistas.php?action=DELETE&id_dentista=<?php echo $dato['id_dentista']; ?>"
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
            echo "No se encontraron dentistas";
        } else if ($app->getCount() != 1) {
            echo "Se encontraron " . $app->getCount() . " dentistas";
        } else {
            echo "Se encontró " . $app->getCount() . " dentista";
        } ?></p>
</div>

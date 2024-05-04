<?php
// Obtener todos los privilegios
$allPrivileges = $appPrivilegios->getAll();

// Obtener los privilegios asociados con el rol actual
$privilegiosRol = $app->getPrivilegiosRol($id_rol);
$privilegiosRolIds = array_column($privilegiosRol, 'id_privilegio');
?>
<div class="container">
    <h1><?php echo ($action == 'EDIT') ? 'Actualizar rol' : 'Agregar nuevo rol'; ?></h1>
    <form action="roles.php?action=<?php echo ($action == 'EDIT') ? 'UPDATE&id_rol=' . $datos['id_rol'] : 'SAVE'; ?>"
          method="post">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="input-group mb-3">
                    <div class="form-floating">
                        <input required type="text" class="form-control" id="rol" placeholder="Rol"
                               name="rol"
                               value="<?php echo (isset($datos['rol'])) ? $datos['rol'] : '' ?>">
                        <label for="rol">Rol</label>
                    </div>
                </div>
            </div>
            <?php foreach ($allPrivileges as $privilegio) : ?>

                <div class="col-lg-8 col-md-12 mb-1">
                    <input type="checkbox" value="<?php echo $privilegio['id_privilegio']; ?>" name="privilegios[]" <?php echo in_array($privilegio['id_privilegio'], $privilegiosRolIds) ? 'checked' : ''; ?>> <?php echo $privilegio['privilegio']; ?>

                </div>
            <?php endforeach; ?>

        </div>
        <input type="submit" value="Guardar" class="btn btn-success mb-3 btn-lg" style="width: auto;"
               name="SAVE">
    </form>
</div>
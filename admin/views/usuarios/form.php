<?php
//Obtener todos los roles
$allRoles = $appRoles->getAll();

//Obtener los roles asociados con el usuario actual
$rolesUsuario = $app->getRolesUsuario($id_usuario);
$rolesUsuarioIds = array_column($rolesUsuario, 'id_rol');
?>
<div class="container">
    <h1><?php echo ($action == 'EDIT') ? 'Actualizar usuario' : 'Agregar nuevo usuario'; ?></h1>
    <form action="usuarios.php?action=<?php echo ($action == 'EDIT') ? 'UPDATE&id_usuario=' . $datos['id_usuario'] : 'SAVE'; ?>"
          method="post">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="input-group mb-3">
                    <div class="form-floating">
                        <input required type="email" class="form-control" id="correo" placeholder="Correo electrónico" name="correo"
                               value="<?php echo (isset($datos['username'])) ? $datos['username'] : '' ?>">
                        <label for="correo">Correo electrónico</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Roles del usuario -->
            <h3>Roles del usuario</h3>
            <?php foreach ($allRoles as $roles) : ?>
                <div class="col-lg-2 col-md-6 fs-5 mb-3">
                    <input type="checkbox" value="<?php echo $roles['id_rol']; ?>"
                           name="roles[]" <?php echo in_array($roles['id_rol'], $rolesUsuarioIds) ? 'checked' : ''; ?>> <?php echo $roles['rol']; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <input type="submit" value="Guardar" class="btn btn-success mb-3 btn-lg" style="width: auto;"
               name="SAVE">
    </form>
</div>

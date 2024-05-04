<div class="container">
    <h1><?php echo ($action == 'EDIT') ? 'Actualizar privilegio' : 'Agregar nuevo privilegio'; ?></h1>
    <form action="privilegios.php?action=<?php echo ($action == 'EDIT') ? 'UPDATE&id_privilegio=' . $datos['id_privilegio'] : 'SAVE'; ?>"
          method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="input-group mb-3">
                    <div class="form-floating">
                        <input required type="text" class="form-control" id="privilegio" placeholder="Privilegio"
                               name="privilegio"
                               value="<?php echo (isset($datos['privilegio'])) ? $datos['privilegio'] : '' ?>">
                        <label for="privilegio">Privilegio</label>
                    </div>
                </div>
                <input type="submit" value="Guardar" class="btn btn-success mb-3 btn-lg" style="width: auto;"
                       name="SAVE">
            </div>
        </div>
    </form>
</div>
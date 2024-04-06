<div class="container">
    <h1><?php echo ($action == 'EDIT') ? 'Actualizar información de la categoria' : 'Agregar nueva categoria'; ?></h1>
    <form action="categorias.php?action=<?php echo ($action == 'EDIT') ? 'UPDATE&id_categoria=' . $datos['id_categoria'] : 'SAVE'; ?>"
          method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-tooth"></i></span>
                    <div class="form-floating">
                        <input required type="text" class="form-control" id="categoria" placeholder="Categoria"
                               name="categoria"
                               value="<?php echo (isset($datos['categoria'])) ? $datos['categoria'] : '' ?>">
                        <label for="categoria">Categoria</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-body-text"></i></span>
                    <div class="form-floating">
                        <input required type="text" class="form-control" id="descripcion" placeholder="Descripción"
                               name="descripcion"
                               value="<?php echo (isset($datos['descripcion'])) ? $datos['descripcion'] : '' ?>">
                        <label for="descripcion">Descripción</label>
                    </div>
                </div>
                <?php if ($action == 'EDIT') : ?>
                    <label for="">Imágen actual</label>
                    <div class="mb-3 col-lg-4 col-md-12">
                        <img class="img-form-style" src="../assets/images/categorias/<?php echo $datos['imagen']; ?>"
                             alt="Imagen de <?php echo $datos['categoria']; ?>">
                    </div>
                <?php endif; ?>

                <div class="input-group mb-3">
                    <label class="input-group-text" for="imagen"><i class="fa-solid fa-images"></i></label>
                    <div class="form-floating">
                        <input accept="image/jpeg, image/png" type="file" class="form-control" id="imagen"
                               placeholder="Imagen" name="imagen"
                               value="<?php echo (isset($datos['imagen'])) ? $datos['imagen'] : '' ?>">
                        <label for="imagen">Imagen</label>
                    </div>
                </div>
                <input type="submit" value="Guardar" class="btn btn-success mb-3 btn-lg" style="width: auto;"
                       name="SAVE">
            </div>
        </div>
    </form>
</div>
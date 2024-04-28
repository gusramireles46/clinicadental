<div class="container">
    <h1><?php echo ($action == 'EDIT') ? 'Actualizar información del servicio' : 'Agregar nuevo servicio'; ?></h1>
    <form action="servicios.php?action=<?php echo ($action == 'EDIT') ? 'UPDATE&id_servicio=' . $datos['id_servicio'] : 'SAVE'; ?>"
          method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="material-symbols-outlined">oral_disease</i></span>
                    <div class="form-floating">
                        <input required type="text" class="form-control" id="servicio" placeholder="Servicio"
                               name="servicio"
                               value="<?php echo (isset($datos['servicio'])) ? $datos['servicio'] : '' ?>">
                        <label for="servicio">Servicio</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-body-text"></i></span>
                    <div class="form-floating">
                        <input type="text" class="form-control" placeholder="Descripcion" name="descripcion"
                               id="descripcion"
                               value="<?php echo (isset($datos['descripcion'])) ? $datos['descripcion'] : '' ?>">
                        <label for="descripcion">Descripcion</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-tooth"></i></span>
                    <div class="form-floating">
                        <select name="id_categoria" id="id_categoria" class="form-select">
                            <?php
                            foreach ($categorias as $categoria) :
                                $selected = ($categoria['id_categoria'] == $datos['id_categoria']) ? 'selected' : '';
                                ?>

                                <option value="<?php echo $categoria['id_categoria']; ?>" <?php echo $selected; ?>><?php echo $categoria['categoria']; ?></option>
                            <?php endforeach; ?>

                        </select>
                        <label for="categoria">Categoria</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-currency-dollar"></i></span>
                    <div class="form-floating">
                        <input required type="text" class="form-control" id="precio" placeholder="Precio"
                               name="precio"
                               value="<?php echo (isset($datos['precio'])) ? $datos['precio'] : '' ?>">
                        <label for="precio">Precio</label>
                    </div>
                </div>
                <?php if ($action == 'EDIT') : ?>
                    <label for="">Imágen actual</label>
                    <div class="mb-3 col-lg-4 col-md-12">
                        <img class="img-form-style" src="../assets/images/servicios/<?php echo $datos['imagen']; ?>"
                             alt="Imagen de <?php echo $datos['servicio']; ?>">
                    </div>
                <?php endif; ?>

                <div class="input-group mb-3">
                    <label class="input-group-text" for="imagen"><i class="fa-solid fa-images"></i></label>
                    <div class="form-floating">
                        <input accept="image/jpeg, image/png" type="file" class="form-control" id="imagen"
                               placeholder="Imagen" name="imagen"
                               value="<?php echo (isset($datos['imagen'])) ? $datos['imagen'] : '' ?>">
                        <label for="marca">Imagen</label>
                    </div>
                </div>
                <input type="submit" value="Guardar" class="btn btn-success mb-3 btn-lg" style="width: auto;"
                       name="SAVE">
            </div>
        </div>
    </form>
</div>
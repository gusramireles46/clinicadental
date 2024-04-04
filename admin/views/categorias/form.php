<div class="container">
    <h1><?php echo ($action == 'UPDATE') ? 'Actualizar información de la categoria' : 'Agregar nueva categoria'; ?></h1>
    <form action="marca.php?action=<?php echo ($action == 'UPDATE') ? 'EDIT&id_marca=' . $datos['id_categoria'] : 'SAVE'; ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                    <div class="form-floating">
                        <input required type="text" class="form-control" id="categoria" placeholder="Categoria" name="categoria" value="<?php echo (isset($datos['categoria'])) ? $datos['categoria'] : '' ?>">
                        <label for="marca">Categoria</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                    <div class="form-floating">
                        <input required type="text" class="form-control" id="descripcion" placeholder="Descripción" name="descripcion" value="<?php echo (isset($datos['descripcion'])) ? $datos['descripcion'] : '' ?>">
                        <label for="marca">Descripción</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="fotografia"><i class="fa-solid fa-images"></i></label>
                    <input accept="image/jpeg, image/png" type="file" class="form-control" id="fotografia" placeholder="Fotografia" name="fotografia" value="<?php echo (isset($datos['fotografia'])) ? $datos['fotografia'] : '' ?>">
                </div>
                <input type="submit" value="Guardar" class="btn btn-success mb-3 btn-lg" style="width: auto;" name="SAVE">
            </div>
        </div>
    </form>
</div>
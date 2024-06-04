<div class="container">
    <h1><?php echo ($action == 'EDIT') ? 'Actualizar información del producto' : 'Agregar nuevo producto'; ?></h1>
    <form id="productForm" action="productos.php?action=<?php echo ($action == 'EDIT') ? 'UPDATE&id_producto=' . $datos['id_producto'] : 'SAVE'; ?>" method="post" enctype="multipart/form-data" novalidate>
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-body-text"></i></span>
                    <div class="form-floating">
                        <input required type="text" class="form-control" id="producto" placeholder="Producto" name="producto" value="<?php echo (isset($datos['producto'])) ? $datos['producto'] : '' ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Por favor, introduce un producto.">
                        <label for="producto">Producto</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                    <div class="form-floating">
                        <input type="number" name="precio" id="precio" class="form-control" placeholder="Precio" min="0" value="<?php echo isset($datos['precio']) ? $datos['precio'] : ''; ?>" required data-bs-toggle="tooltip" data-bs-placement="top" title="Por favor, introduce un precio válido.">
                        <label for="precio">Precio</label>
                    </div>
                </div>
                <?php if ($action == 'EDIT') : ?>
                    <label for="">Imágen actual</label>
                    <div class="mb-3 col-lg-4 col-md-12">
                        <img class="img-form-style" src="../assets/images/productos/<?php echo $datos['imagen']; ?>" alt="Imagen de <?php echo $datos['producto']; ?>">
                    </div>
                <?php endif; ?>

                <div class="input-group mb-3">
                    <label class="input-group-text" for="imagen"><i class="fa-solid fa-images"></i></label>
                    <div class="form-floating">
                        <input accept="image/jpeg, image/png" type="file" class="form-control" id="imagen" placeholder="Imagen" name="imagen" value="<?php echo (isset($datos['imagen'])) ? $datos['imagen'] : '' ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Por favor, selecciona una imagen válida.">
                        <label for="imagen">Imagen</label>
                    </div>
                </div>
                <input type="submit" value="Guardar" class="btn btn-success mb-3 btn-lg" style="width: auto;" name="SAVE">
            </div>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="views/productos/js/script.js"></script>
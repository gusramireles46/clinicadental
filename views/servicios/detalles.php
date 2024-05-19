<div class="container">
    <div class="row">
        <h2>Detalles del servicio "<?php echo $datos['servicio']; ?>"</h2>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div style="text-align: center;">
                        <img src="assets/images/servicios/<?php echo $datos['imagen'];?>" class="card-img-top card-image" alt="Servicios">
                    </div>
                    <h5 class="card-title"><?php echo $datos['servicio'];?></h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary"><strong>Categoria: </strong><?php echo $categoria['categoria']; ?></h6>
                    <h6 class="card-subtitle mb-2 text-body-secondary"><?php echo $datos['descripcion'];?></h6>
                    <a href="" class="btn btn-success">$ <?php echo $datos['precio']; ?></a>
                </div>
            </div>
        </div>
    </div>
</div>
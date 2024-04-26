<section>
    <div class="container" style="padding-top: 50px; padding-bottom: 50px;">
        <div class="row">
            <h3>Servicios</h3>

            <?php foreach ($datos as $servicio) : ?>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body">
                            <div style="text-align: center;">
                                <img src="assets/images/servicios/<?php echo $servicio['imagen']; ?>"
                                     class="card-img-top card-image" alt="Servicios">
                            </div>
                            <h5 class="card-title"><?php echo $servicio['servicio']; ?></h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary"><?php echo $servicio['descripcion']; ?></h6>
                            <div class="text-center">
                                <a href="?action=DETALLES&id_servicio=<?php echo $servicio['id_servicio']; ?>"
                                   class="btn btn-primary">Ver detalles</a>
                                <a href="#"
                                   class="btn btn-success"><?php echo $servicio['precio'] == 0 ? 'GRATIS' : '$ '. $servicio['precio']; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<section>
    <div class="container py-5">
        <div class="row">
            <h2>Servicios</h2>

            <?php foreach ($datos as $servicio) : ?>
                <div class="col-lg-3 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div style="text-align: center;">
                                <img src="assets/images/servicios/<?php echo $servicio['imagen']; ?>"
                                     class="card-img-top card-image" alt="Servicios">
                            </div>
                            <h5 class="card-title"><?php echo $servicio['servicio']; ?></h5>
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
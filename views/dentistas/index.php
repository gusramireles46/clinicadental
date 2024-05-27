<section>
    <div class="container" style="padding-top: 50px; padding-bottom: 50px;">
        <div class="row">
            <h3>Dentistas</h3>

            <?php foreach ($datos as $dentista) : ?>
                <div class="col-lg-3 col-md-12 mb-4">
                    <div class="card" style="height: 380px;">
                        <div class="card-body">
                            <div style="text-align: center;">
                                <img src="<?php echo $dentista['fotografia']; ?>"
                                     class="card-img-top card-image" alt="Dentista" style="width: 100%; height: 200px;">
                            </div>
                            <h4 class="card-title text-center"><?php echo $dentista['nombre'] . ' ' . $dentista['apellido_paterno'] . ' ' . $dentista['apellido_materno']; ?></h4>
                            <h5 class="card-subtitle mb-2 text-body-secondary text-center"><?php echo $dentista['especialidad']; ?></h5>
                        </div>
                        <div class="text-center mb-3">
                            <a href="?action=DETALLES&id_dentista=<?php echo $dentista['id_dentista']; ?>"
                               class="btn btn-primary">Ver detalles</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section><?php

<div class="container">
    <div class="row py-5">
        <h2>Detalles del dentista "<?php echo "{$datos['nombre']} {$datos['apellido_paterno']} {$datos['apellido_materno']}"; ?>"</h2>
        <div class="col">
            <div class="card mb-4 mt-4 py-3 px-3">
                <div class="card-body">
                    <div style="text-align: center;" class="mb-4">
<!--                        style="width: 640px; height: 360px;"-->
                        <img src="<?php echo $datos['fotografia'];?>" class="card-img-top w-50 img-details" alt="<?php echo "Dentista: {$datos['nombre']}";?>">
                    </div>
                    <h3 class="card-title text-center"><?php echo "{$datos['nombre']} {$datos['apellido_paterno']} {$datos['apellido_materno']}";?></h3>
                    <h4 class="card-subtitle mb-2 text-body-secondary text-center"><?php echo $datos['especialidad'];?></h4>
                    <h6 class="card-subtitle mb-2 text-body-secondary text-center"><strong>Días de atención</strong>: <?php echo $datos['dias_habiles'];?></h6>
                    <h6 class="card-subtitle mb-2 text-body-secondary text-center"><strong>Horario de atención</strong>: <?php echo "{$datos['f_hora_inicio']} - {$datos['f_hora_fin']}";?></h6>
                    <hr>
                    <h4 class="card-title text-center">Datos de contacto</h4>
                    <h6 class="card-subtitle mb-2 text-body-secondary text-center"><strong><i class="fa fa-phone"></i></strong> <a href="tel:<?php echo $datos['telefono']; ?>"><?php echo $datos['telefono']; ?></a></h6>
                    <h6 class="card-subtitle mb-2 text-body-secondary text-center"><strong><i class="fa fa-at"></i></strong> <a href="mailto:<?php echo $datos['correo']; ?>"><?php echo $datos['correo']; ?></a></h6>
                </div>
            </div>
        </div>
    </div>
</div>
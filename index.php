<?php
include __DIR__ . '/admin/servicios.class.php';
include __DIR__ . '/components/header.php';
$web = new Servicio();
$datos = array();
$datos = $web->getAll();
?>
    <link rel="stylesheet" href="./styles/calendar.css">
    <section class="container">
        <div class="col-lg-12 col-md-12">
            <div id="carouselCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                    <!-- <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button> -->
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="./assets/images/banner1.jpg" alt="Banner 1" class="d-block w-100">
                        <div class="carousel-caption d-md-block">
                            <h5>Clínica Dental Integral</h5>
                            <p>Agenda tu cita, la consulta es gratis.</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselCaptions"
                        data-bs-slide="prev">
                    <i class="fa-solid fa-angle-left" style="color: #000000; font-size: 32px;"></i>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselCaptions"
                        data-bs-slide="next">
                    <i class="fa-solid fa-angle-right" style="color: #000000; font-size: 32px;"></i>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>
        </div>
    </section>
    <section class="bg-body-secondary" style="padding-top: 50px; padding-bottom: 50px;">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card w-100">
                        <div style="text-align: center;">
                            <img src="assets/images/categorias/default.png" class="card-img-top card-image"
                                 alt="Categorias">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Categorias</h5>
                            <p class="card-text">Categorias de servicios dentales ofrecidos por la clínica dental.</p>
                            <a href="#" class="card-link">Ver todas las categorias</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card w-100">
                        <div style="text-align: center;">
                            <img src="assets/images/servicios/default.png" class="card-img-top card-image"
                                 alt="Servicios">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Servicios</h5>
                            <p class="card-text">Clasificacion de los servicios dentales por especialidad ofrecidos por
                                la clínica dental.</p>
                            <a href="#" class="card-link">Ver todos los servicios</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card w-100">
                        <div style="text-align: center;">
                            <img src="assets/images/cita.png" class="card-img-top card-image" alt="Cita">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Agenda tu cita</h5>
                            <p class="card-text">Puedes agendar tu cita desde la comodidad de tu hogar, la consulta es
                                gratuita.</p>
                            <a href="#" class="card-link">Agendar cita</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
                                    <a href="servicios.php?action=DETALLES&id_servicio=<?php echo $servicio['id_servicio']; ?>"
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
    <section class="bg-body-secondary">
        <div class="container" style="padding-bottom: 50px; padding-top: 50px;">
            <div class="row">
                <h3>Contactanos o visitanos</h3>
                <div class="col-4">
                    <div class="card" style="height: 300px;">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa fa-hospital"></i> Direccion</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary">Clínica Dental Integral</h6>
                            <p class="card-text">38160, C. Nicolás Bravo 202, Zona Centro, Apaseo el Grande, Gto</p>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa fa-phone"></i> Teléfono</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary">Clínica Dental Integral</h6>
                            <p class="card-text"><a href="tel:+524131234567">(+52) 413 123 4567</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card" style="height: 300px; padding: 10px;">
                        <h5 class="card-title"><i class="fa fa-map"></i> Ubicación del consultorio</h5>
                        <p class="card-text">38160, C. Nicolás Bravo 202, Zona Centro, Apaseo el Grande, Gto</p>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2641.82010614531!2d-100.6886817696393!3d20.543178027856495!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x842cb240986629e1%3A0x5b4d303b14763c52!2sCl%C3%ADnica%20Dental%20Integral!5e0!3m2!1ses-419!2smx!4v1713505507341!5m2!1ses-419!2smx"
                                style="border:0; padding: 20px;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
include __DIR__ . '/components/footer.php';
?>
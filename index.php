<?php
include __DIR__ . '/components/header.php';
?>
<link rel="stylesheet" href="./styles/calendar.css">
<section class="container">
    <div class="col-lg-12 col-md-12">
        <div id="carouselCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
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
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselCaptions" data-bs-slide="prev">
                <i class="fa-solid fa-angle-left" style="color: #000000; font-size: 32px;"></i>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselCaptions" data-bs-slide="next">
                <i class="fa-solid fa-angle-right" style="color: #000000; font-size: 32px;"></i>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
    </div>
</section>
<section>
    <div class="container-fluid">
        <div class="row" style="margin-top: 10px; margin-bottom: 10px;">
            <div class="col-lg-2">
                <h5 class="text-center"><i class="bi bi-calendar3"></i> Calendario</h5>
                <div class="row">
                    <div class="col d-block w-100" style="margin: 10px">
                        <table class="calendar" id="calendar"></table>
                    </div>
                </div>
            </div>
            <div class="col-lg-8" style="background-color: green;">
                <h5 class="text-center"><i class="fa-solid fa-ghost"></i> Servicios (Vista general)</h5>
            </div>
            <div class="col-lg-2 blur-background-transparent">
                <h5 class="text-center"><i class="fa-solid fa-tooth"></i> Opciones de tratamientos</h5>
            </div>
        </div>
        <div class="row" style="margin-top: 10px; margin-bottom: 10px;">
            <div class="col-lg-2" style="background-color: yellow;">
                <h5 class="text-center"><i class="fa-solid fa-cat"></i></h5>
            </div>
            <div class="col-lg-8" style="background-color: green;">
                <h5 class="text-center"><i class="fa-solid fa-dog"></i></h5>
            </div>
            <div class="col-lg-2" style="background-color: aqua;">
                <h5 class="text-center"><i class="fa-solid fa-cat"></i></h5>
            </div>
        </div>
    </div>
</section>
<script src="./js/calendar.js"></script>
<?php
include __DIR__ . '/components/footer.php';
?>
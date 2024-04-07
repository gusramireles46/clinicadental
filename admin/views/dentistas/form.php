<div class="container">
    <h1><?php echo ($action == 'EDIT') ? 'Actualizar información del dentista' : 'Agregar nuevo dentista'; ?></h1>
    <form action="dentistas.php?action=<?php echo ($action == 'EDIT') ? 'UPDATE&id_dentista=' . $datos['id_dentista'] : 'SAVE'; ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa fa-user-doctor"></i></span>
                    <div class="form-floating">
                        <input required type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" value="<?php echo (isset($datos['nombre'])) ? $datos['nombre'] : '' ?>">
                        <label for="nombre">Nombre</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                    <div class="form-floating">
                        <input required type="text" class="form-control" id="apellido_paterno" placeholder="Primer Apellido" name="apellido_paterno" value="<?php echo (isset($datos['apellido_paterno'])) ? $datos['apellido_paterno'] : '' ?>">
                        <label for="apellido_paterno">Primer Apellido</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                    <div class="form-floating">
                        <input required type="text" class="form-control" id="apellido_materno" placeholder="Segundo Apellido" name="apellido_materno" value="<?php echo (isset($datos['apellido_materno'])) ? $datos['apellido_materno'] : '' ?>">
                        <label for="apellido_materno">Segundo Apellido</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                    <div class="form-floating">
                        <input required type="text" class="form-control" id="telefono" placeholder="Teléfono" name="telefono" value="<?php echo (isset($datos['telefono'])) ? $datos['telefono'] : '' ?>">
                        <label for="telefono">Teléfono</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa fa-at"></i></span>
                    <div class="form-floating">
                        <input required type="text" class="form-control" id="correo" placeholder="Correo electrónico" name="correo" value="<?php echo (isset($datos['correo'])) ? $datos['correo'] : '' ?>">
                        <label for="correo">Correo electrónico</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa fa-calendar-check"></i></span>
                    <div class="form-floating">
                        <input required type="text" class="form-control" id="dias_habiles" placeholder="Días Hábiles" name="dias_habiles" value="<?php echo (isset($datos['dias_habiles'])) ? $datos['dias_habiles'] : '' ?>">
                        <label for="dias_habiles">Dias Hábiles</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-regular fa-clock"></i></span>
                    <div class="form-floating">
                        <input required type="time" class="form-control" id="hora_inicio" placeholder="Horario de inicio" name="hora_inicio" value="<?php echo (isset($datos['hora_inicio'])) ? $datos['hora_inicio'] : '' ?>">
                        <label for="hora_inicio">Horario de inicio</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-clock"></i></span>
                    <div class="form-floating">
                        <input required type="time" class="form-control" id="hora_fin" placeholder="Horario de finalización" name="hora_fin" value="<?php echo (isset($datos['hora_fin'])) ? $datos['hora_fin'] : '' ?>">
                        <label for="hora_fin">Horario de finalización</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa fa-notes-medical"></i></span>
                    <div class="form-floating">
                        <input required type="text" class="form-control" id="especialidad" placeholder="Especialidad" name="especialidad" value="<?php echo (isset($datos['especialidad'])) ? $datos['especialidad'] : '' ?>">
                        <label for="especialidad">Especialidad</label>
                    </div>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="tomar-foto-checkbox">
                    <label class="form-check-label" for="tomar-foto-checkbox">Tomar Fotografía</label>
                </div>
                <img src="<?php echo (isset($datos['fotografia'])) ? $datos['fotografia'] : ''; ?>" alt="" class="mb-3">
                <div id="foto-container" style="display: none;">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <video id="video" width="400" height="300" autoplay></video>
                        </div>
                        <div>
                            <img id="photo" src="#" alt="Fotografía" style="display:none; width: 400px; height: 300px;">
                        </div>
                    </div>
                    <button id="capture-btn" type="button" class="btn btn-primary mb-3">Tomar Foto</button>
                    <button id="repeat-btn" type="button" class="btn btn-danger mb-3" style="display:none;">Repetir Fotografía</button>
                    <input type="hidden" id="fotografia" name="fotografia">
                </div>
                <div class="row">
                    <div class="col">
                        <input type="submit" value="Guardar" class="btn btn-success mb-3 btn-lg" style="width: auto;" name="SAVE">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script src="views/dentistas/js/script.js"></script>
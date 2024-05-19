<link rel="stylesheet" href="../styles/style.css">
<form action="login.php?action=REGISTRO" method="POST">
    <section class="vh-100 background-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center body-custom">

                            <div class="mb-md-5 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2 text-uppercase">Registrate</h2>

                                <div class="input-group mb-3 text-black">
                                    <span class="input-group-text"><i class="fa fa-at"></i></span>
                                    <div class="form-floating">
                                        <input required type="email" class="form-control" id="username"
                                               placeholder="Correo electrónico"
                                               name="username">
                                        <label for="username">Correo electrónico</label>
                                    </div>
                                </div>

                                <div class="input-group mb-3 text-black">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                    <div class="form-floating">
                                        <input required type="password" class="form-control" id="password"
                                               placeholder="Contraseña"
                                               name="password">
                                        <label for="password">Contraseña</label>
                                    </div>
                                </div>

                                <div class="input-group mb-3 text-black">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    <div class="form-floating">
                                        <input required type="text" class="form-control" id="nombre"
                                               placeholder="Nombre"
                                               name="nombre">
                                        <label for="nombre">Nombre</label>
                                    </div>
                                </div>

                                <div class="input-group mb-3 text-black">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    <div class="form-floating">
                                        <input required type="text" class="form-control" id="apellido_paterno"
                                               placeholder="Apellido Paterno"
                                               name="apellido_paterno">
                                        <label for="nombre">Apellido Paterno</label>
                                    </div>
                                </div>

                                <div class="input-group mb-3 text-black">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    <div class="form-floating">
                                        <input required type="text" class="form-control" id="apellido_materno"
                                               placeholder="Apellido Materno"
                                               name="apellido_materno">
                                        <label for="nombre">Apellido Materno</label>
                                    </div>
                                </div>

                                <div class="input-group mb-3 text-black">
                                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                    <div class="form-floating">
                                        <input required type="text" class="form-control" id="telefono"
                                               placeholder="Telefono"
                                               name="telefono">
                                        <label for="nombre">Teléfono</label>
                                    </div>
                                </div>

                                <div class="input-group mb-3 text-black">
                                    <span class="input-group-text"><i class="fa fa-home"></i></span>
                                    <div class="form-floating">
                                        <input required type="text" class="form-control" id="direccion"
                                               placeholder="Dirección"
                                               name="direccion">
                                        <label for="nombre">Dirección</label>
                                    </div>
                                </div>

                                <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="?action=FORGOT">Recuperar
                                        cuenta</a></p>

                                <input class="btn btn-outline-light btn-lg px-5" type="submit" value="Iniciar sesión">

                            </div>
                            <div>
                                <p class="mb-0">¿Aún no tienes cuenta?<br>Registrate <a href="#!"
                                                                                        class="text-white-50 fw-bold">aquí</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>
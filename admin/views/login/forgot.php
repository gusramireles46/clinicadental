<link rel="stylesheet" href="../styles/style.css">
<form action="login.php?action=RESET" method="POST">
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center body-custom">
                            <div class="mb-md-5 mt-md-4 pb-5">
                                <h2 class="fw-bold mb-2 text-uppercase">Recupera tu contraseña</h2>
                                <p class="text-white-50 mb-5">Ingresa tu correo electrónico</p>
                                <div class="input-group mb-3 text-black">
                                    <span class="input-group-text"><i class="fa fa-at"></i></span>
                                    <div class="form-floating">
                                        <input required type="email" class="form-control" id="username"
                                               placeholder="Correo electrónico"
                                               name="username">
                                        <label for="username">Correo electrónico</label>
                                    </div>
                                </div>
                                <input class="btn btn-outline-light btn-lg px-5" type="submit" value="Validar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>
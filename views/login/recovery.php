<link rel="stylesheet" href="../styles/style.css">
<form action="login.php?action=RECOVERY&token=<?php echo $token; ?>" method="POST">
    <section class="vh-100 background-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center body-custom">
                            <div class="mb-md-5 mt-md-4 pb-5">
                                <h2 class="fw-bold mb-2 text-uppercase">Recupera tu contraseña</h2>
                                <p class="text-white-50 mb-5">Establezca su nueva contraseña</p>
                                <div class="input-group mb-3 text-black">
                                    <span class="input-group-text"><i class="fa fa-at"></i></span>
                                    <div class="form-floating">
                                        <input required type="password" class="form-control" id="password"
                                               placeholder="Nueva contraseña"
                                               name="password">
                                        <label for="password">Nueva contraseña</label>
                                    </div>
                                </div>
                                <input class="btn btn-outline-light btn-lg px-5" type="submit" value="Reestablecer contraseña">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>
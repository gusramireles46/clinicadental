<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clínica Dental Integral "Dr. José Alfredo García Oliveros"</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/fontawesome.min.css" integrity="sha512-d0olNN35C6VLiulAobxYHZiXJmq+vl+BGIgAxQtD5+kqudro/xNMvv2yIHAciGHpExsIbKX3iLg+0B6d0k4+ZA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand me-auto text-wrap text-center fs-6" href="./">
            <img src="./assets/logo/logo.png" alt="Clinica Dental Integral" style="width: 45px; height: 45px;">
            Clinica Dental Integral "Dr. José Alfredo García Oliveros"
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="./">Inicio</a>
                </li>
                <?php if (isset($_SESSION['valido']) && $_SESSION['roles'][0] == "Administrador") : ?>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="./admin/">Panel del administrador</a>
                </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="./servicios.php">Servicios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="./dentistas.php">Dentistas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="./productos.php">Productos</a>
                </li>
                <li class="nav-item" id="login-logout">
                    <a class="nav-link" href="<?php echo isset($_SESSION['valido']) && $_SESSION['valido'] ? 'login.php?action=LOGOUT' : 'login.php'; ?>">
                        <?php if (isset($_SESSION['valido'])): ?>
                            <?php echo $_SESSION['valido'] ? '<i class="fas fa-sign-out-alt"></i> Cerrar sesión' : '<i class="fas fa-sign-in-alt"></i> Iniciar sesión'; ?>
                        <?php else: ?>
                            <i class="fas fa-sign-in-alt"></i> Iniciar sesión
                        <?php endif; ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
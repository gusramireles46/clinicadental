<?php
$content = "
<style>
    body {
        font-family: Arial, sans-serif;
    }
    .container {
        text-align: center;
    }
    h1 {
        color: #9d0000;
        font-weight: bold;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: left;
        word-wrap: break-word;
    }
    th {
        background-color: #e2e2e2;
        font-weight: bold;
        text-align: center;
    }
    img {
        display: block;
        margin: 0 auto;
    }
    .container {
        text-align: center;
    }
    a {
        color: #000;
        text-decoration: none;
    }
</style>
<div>
    <div class='logo'>
        <img src='../assets/logo/logo.png' style='width: 100px; height: 100px;' alt='Dentistas'> <label style='font-size: 25px;'>Clínica Dental Integral \"José Alfredo García Oliveros\"</label>
    </div>
    <div class='container'>
    <h1>Listado de usuarios</h1>
    <table align='center'>
        <thead>
            <tr>
                <th>ID</th>
                <th>Correo electrónico</th>
                <th>Roles</th>
            </tr>
        </thead>
        <tbody>";
foreach ($datos as $usuario) {
    $content .= "
            <tr>
                <td style='background-color: #FAFAFA; font-weight: bold'>{$usuario['id_usuario']}</td>
                <td>{$usuario['username']}</td>
                <td>{$usuario['rol']}</td>
            </tr>";
}
$content .= "
        </tbody>
    </table>
    </div>
</div>
";

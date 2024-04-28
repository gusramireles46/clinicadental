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
</style>
<div>
    <div class='logo'>
        <img src='../assets/logo/logo.png' style='width: 100px; height: 100px;' alt='Dentistas'> <label style='font-size: 25px;'>Clinica Dental Integral \"{$datos[0]['nombre']} {$datos[0]['apellido_paterno']} {$datos[0]['apellido_materno']}\"</label>
    </div>
    <div class='container'>
    <h1>Listado de dentistas</h1>
    <table align='center'>
        <thead>
            <tr>
                <th width=''>ID</th>
                <th width=''>Apellidos</th>
                <th width=''>Nombre</th>
                <th width=''>Especialidad</th>
                <th width=''>Correo</th>
                <th width=''>Teléfono</th>
                <th width=''>Dias habiles</th>
                <th width=''>Horario</th>
            </tr>
        </thead>
        <tbody>";
foreach ($datos as $dato) {
    $content .= "
            <tr>
                <td style='background-color: #FAFAFA; font-weight: bold'>{$dato['id_dentista']}</td>
                <td>{$dato['apellido_paterno']} {$dato['apellido_materno']}</td>
                <td>{$dato['nombre']}</td>
                <td>{$dato['especialidad']}</td>
                <td>{$dato['correo']}</td>
                <td>{$dato['telefono']}</td>
                <td>{$dato['dias_habiles']}</td>
                <td>{$dato['hora_inicio']} a {$dato['hora_fin']}</td>
            </tr>";
}
$content .= "
        </tbody>
    </table>
    </div>
</div>
";

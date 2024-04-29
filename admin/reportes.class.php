<?php
require_once __DIR__ . '/sistema.class.php';
require_once dirname(__DIR__) . '/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

class Reportes extends Sistema
{
    public function dentistas(): void
    {
        try {
            $this->connect();
            $stmt = $this->conn->prepare("SELECT id_dentista, nombre, apellido_paterno, apellido_materno, telefono, dias_habiles, especialidad, TIME_FORMAT(hora_inicio, '%h:%i %p') AS hora_inicio, TIME_FORMAT(hora_fin, '%h:%i %p') AS hora_fin, fotografia, correo FROM dentista ORDER BY apellido_paterno;");
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $datos = $stmt->fetchAll();
            ob_start();
            $content = ob_get_clean();
            include __DIR__ . '/views/reportes/dentistas.php';
            $html2pdf = new Html2Pdf('L', 'USLETTER', 'es');
            $html2pdf->writeHTML($content);
            $html2pdf->output('dentistas.pdf');
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function servicios(): void
    {
        try {
            $this->connect();
            $stmt = $this->conn->prepare("SELECT id_servicio, nombre, descripcion, precio FROM servicio ORDER BY nombre;");
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $datos = $stmt->fetchAll();
            ob_start();
            $content = ob_get_clean();
            include __DIR__ . '/views/reportes/servicios.php';
            $html2pdf = new Html2Pdf('L', 'A4', 'es');
            $html2pdf->writeHTML($content);
            $html2pdf->output('servicios.pdf');
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}
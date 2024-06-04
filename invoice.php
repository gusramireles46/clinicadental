<?php
include __DIR__ . '/admin/sistema.class.php';
include __DIR__ . '/components/headerSinNavbar.php';
$datos = $_POST;
$app = new Sistema();
$app->checkRol("Cliente");
try {
    $app->connect();
    $app->conn->beginTransaction();
    if (isset($_SESSION['cart'])) {
        $correo = $_SESSION['username'];
        $sql = "SELECT c.id_cliente FROM clientes c JOIN usuarios u ON c.id_usuario = u.id_usuario WHERE u.username = :correo";
        $stmt = $app->conn->prepare($sql);
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $cliente = $stmt->fetchAll();
        if (isset($cliente[0])) {
            $id_cliente = $cliente[0]['id_cliente'];
            $sql = "INSERT INTO ventas (id_cliente, fecha) VALUES (:id_cliente, now());";
            $stmt = $app->conn->prepare($sql);
            $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $venta = $stmt->fetchAll();
            $filasAfectadas = $stmt->rowCount();
            if ($filasAfectadas) {
                $sql = "SELECT v.id_venta FROM ventas v WHERE v.id_cliente = :id_cliente ORDER BY v.id_venta DESC LIMIT 1;";
                $stmt = $app->conn->prepare($sql);
                $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $venta = $stmt->fetchAll();
                if (isset($venta[0])) {
                    $id_venta = $venta[0]['id_venta'];
                    $cart = $_SESSION['cart'];
                    $filasAfectadas = 0;
                    foreach ($cart as $key => $value) {
                        $id_producto = $key;
                        $cantidad = $value;
                        $sql = "INSERT INTO venta_detalle (id_venta, id_producto, cantidad) VALUES (:id_venta, :id_producto, :cantidad);";
                        $stmt = $app->conn->prepare($sql);
                        $stmt->bindParam(':id_venta', $id_venta, PDO::PARAM_INT);
                        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
                        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
                        $stmt->execute();
                        $filasAfectadas += $stmt->rowCount();
                    }
                    if ($filasAfectadas) {
                        $app->conn->commit();
                        unset($_SESSION['cart']);
                        $app->alert("success", "<i class='fa fa-check'></i> Compra realizada");
                        $sql = "SELECT CONCAT(c.nombre, ' ', c.apellido_paterno, ' ', c.apellido_materno) AS nombre, u.username FROM clientes c JOIN usuarios u ON c.id_usuario = u.id_usuario WHERE u.username = :correo;";
                        $stmt = $app->conn->prepare($sql);
                        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
                        $stmt->execute();
                        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        $cliente = $stmt->fetchAll();
                        if (isset($cliente[0])) {
                            $nombre = $cliente[0]['nombre'];
                            $correo = $cliente[0]['username'];
                            $mensaje = "Estimado $nombre, su compra ha sido realizada con éxito.<br>Agradecemos su preferencia.<br>Atentamente, Clinica Dental Integral";
                            $app->sendMail($nombre, $correo, "Compra realizada con éxito", $mensaje);
                            header("Location: index.php");
                        }
                    }
                } else {
                    $app->conn->rollBack();
                    $app->alert("danger", "<i class='fa fa-times'></i> Error al realizar la compra");
                }
            } else {
                $app->conn->rollBack();
                $app->alert("danger", "<i class='fa fa-times'></i> Error al realizar la compra");
            }
        } else {
            $app->conn->rollBack();
            $app->alert("danger", "<i class='fa fa-times'></i> Error al realizar la compra");
        }
    } else {
        $app->conn->rollBack();
        $app->alert("danger", "<i class='fa fa-times'></i> Error al realizar la compra");
    }
} catch (Exception $e) {
    $app->conn->rollBack();
    $app->alert("danger", "<i class='fa fa-times'></i> Error al realizar la compra");
}
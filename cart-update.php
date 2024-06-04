<?php
session_start();
$id_producto = isset($_POST['id_producto']) ? $_POST['id_producto'] : null;
$action = isset($_POST['action']) ? $_POST['action'] : null;

if ($id_producto !== null && $action !== null) {
    switch ($action) {
        case 'increase':
            $_SESSION['cart'][$id_producto]++;
            break;
        case 'decrease':
            if ($_SESSION['cart'][$id_producto] > 1) {
                $_SESSION['cart'][$id_producto]--;
            } else {
                unset($_SESSION['cart'][$id_producto]);
            }
            break;
        case 'remove':
            unset($_SESSION['cart'][$id_producto]);
            break;
    }
}

echo json_encode(array('status' => 'success'));

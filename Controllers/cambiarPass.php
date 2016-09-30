<?php
require_once '../Models/Database.php';
session_start();
if ($_SESSION['tipo_usu'] == 'Administrador' or $_SESSION['tipo_usu'] == 'Gerente') {
    
} else {
    header('location:../index.php');
}

$id = $_POST['id'];
$actual = $_POST['pass'];
$ingresado = $_POST['actual'];
$nueva = $_POST['nueva'];
$confirmar = $_POST['confirma'];

if ($actual == $ingresado) {
    if ($nueva == $confirmar) {
        try {
            $db = Database::getConexion();
            $sql = "update usuario set password=? where id=?";

            if (!$stm = $db->prepare($sql))
                throw new Exception("" . $db->error);
            $stm->bind_param("si", $nueva, $id);
            if ($stm->execute()) {
                echo '<script>alert("La contraseña ha sido modificada");</script>';
                echo '<script>window.history.back();</script>';
            } else {
                echo '<script>alert("Ocurrio un error al intetar cambiar la contraseña");</script>';
                echo '<script>window.history.back();</script>';
            }
        } catch (Exception $ex) {
            echo '<script>alert("Ocurrio un error al intetar cambiar la contraseña");</script>';
            echo '<script>window.history.back();</script>';
        }
    } else {
        echo '<script>alert("Las contraseñas ingresadas no coinciden");</script>';
        echo '<script>window.history.back();</script>';
    }
} else {
    echo '<script>alert("La contraseña ingresada no coincide con la actual");</script>';
    echo '<script>window.history.back();</script>';
}
?>
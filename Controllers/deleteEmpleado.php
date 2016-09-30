<?php
include_once '../Models/usuario.php';
include_once '../Models/Database.php';
$id = $_REQUEST['id'];
$usuario = new Usuario();

try {
    $db = Database::getConexion();
    $sql = "DELETE FROM usuario WHERE id=$id";
    if (!$stm = $db->prepare($sql))
        throw new Exception("" . $db->error);

    if($stm->execute()){
        echo '<script>alert("Empleado eliminado");</script>';
        echo '<script>window.history.back();</script>';
    }
} catch (Exception $e) {
    echo "Archivo: " . $e->getFile() . " Linea" . $e->getLine() . " Descripcion: " . $e->getMessage();
    return false;
}
?>
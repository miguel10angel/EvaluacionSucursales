<?php
session_start();
if ($_SESSION['tipo_usu'] == 'Administrador' or $_SESSION['tipo_usu'] == 'Gerente') {
    
} else {
    header('location:../index.php');
}

$id = $_POST['id'];
$d1 = $_POST['inicio'];
$d2 = $_POST['fin'];
$t = $_POST['turno'];
$tipo = $_POST['tipo'];

$inicio = strtotime($d1);
$fin = strtotime($d2);

$dt1 = new DateTime($d1);
$dt2 = new DateTime($d2);
$interval = $dt1->diff($dt2);
$diferiencia = $interval->format('%R%a días');

if ($inicio < $fin) {
    if ($diferiencia < 16) {
        if ($tipo == 'externo') {
            echo '<script>location.assign("../Views/graficasexternas.php?id=' . $id . '& d1=' . $d1 . '& d2=' . $d2 . '&turno=' . $t . '")</script>';
        } else if ($tipo == 'interno'){
            echo '<script>location.assign("../Views/graficasEval.php?id=' . $id . '& d1=' . $d1 . '& d2=' . $d2 . '&turno=' . $t . '")</script>';
        }
    } else {
        echo '<script>alert("La fecha de finalizacion no puede ser mayor a 15 dias en comparacion con la fecha de inicio, por favor verifique las fechas");</script>';
        echo '<script>window.history.back()</script>';
    }
} else {
    echo '<script>alert("La fecha de inicio no puede ser posterior a la de la finalizacion, por favor verifique las fechas");</script>';
    echo '<script>window.history.back()</script>';
}
?>
<?php

include_once '../Models/Evaluacion.php';

$contador = 0;
$total = $_POST["total"];
$fecha = $_POST["fecha"];
$fechaCom = strtotime($fecha);
$hoy = strtotime(date("Y-m-d"));
if ($fechaCom < $hoy) {
    echo '<script>alert("No se puede programar evaluaciones para dias anteriores, por favor verifique la fecha");</script>';
    echo '<script>window.history.back();</script>';
} else {
    $evaluacion = new Evaluacion();
    $evaluacion->setFecha($fecha);
    $evaluacion->setCalificacion(0);
    $evaluacion->delete($fecha);
    for ($i = 1; $i <= $total; $i++) {
        $nombreU = $i . "usuario";
        $valorU = $_POST[$nombreU];
        $nombreS = $i . "sucursal";
        $valorS = $_POST[$nombreS];
        $nombreT = $i . "turno";
        $valorT = $_POST[$nombreT];
        $evaluacion->setIdUsuario($valorU);
        $evaluacion->setIdSucursal($valorS);
        $evaluacion->setTurno($valorT);
        
        if ($evaluacion->insert()) {
            $contador++;
        }
    }
    if ($contador == $total) {
        echo '<script>alert("REGISTRO REALIZADO");</script>';
        echo '<script>location.assign("../Views/EvaluacionesProgramadas.php?f=' . $fecha . '");</script>';
    } else {
        echo '<script>alert("Ocurrio un error al guardar");window.history.back();</script>';
    }
}
?>


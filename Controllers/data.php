<?php

function exception_error_handler($errno, $errstr, $errfile, $errline) {
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

if ($_SESSION['tipo_usu'] == 'Administrador' or $_SESSION['tipo_usu'] == 'Gerente') {
    
} else {
    header('location:../index.php');
}

set_error_handler("exception_error_handler");

require_once("../Models/Database.php");

Class Datos {

    private $_suc;
    private $_emp;
    private $_sucEva;

    public function __construct() {
        $this->_suc = 0;
        $this->_emp = 0;
        $this->_sucEva = 0;
    }


    public static function suc() {
        try {
            $db = Database::getConexion();
            $sql="select count(clave)as sucursales from sucursal";
            
            if (!$stm = $db->prepare($sql))
                throw new Exception("" . $db->error);
            
            $stm->execute();
            $stm->bind_result($sucursales);
            
            $stm->fetch();
            return $sucursales;
        } catch (Exception $ex) {
            echo "Archivo: " . $e->getFile() . " Linea" . $e->getLine() . " Descripcion: " . $e->getMessage();
            return false;
        }
    }
    
    public static function emple() {
        try {
            $db = Database::getConexion();
            $sql="select count(id)as empleados from usuario";
            
            if (!$stm = $db->prepare($sql))
                throw new Exception("" . $db->error);
            
            $stm->execute();
            $stm->bind_result($empleaddos);
            
            $stm->fetch();
            return $empleaddos;
        } catch (Exception $ex) {
            echo "Archivo: " . $e->getFile() . " Linea" . $e->getLine() . " Descripcion: " . $e->getMessage();
            return false;
        }
    }
    
    
    public static function sucEva() {
        try {
            $db = Database::getConexion();
            $sql="select count(idSucursal)as sucursales from evaluaciones where fecha=date(now())";
            
            if (!$stm = $db->prepare($sql))
                throw new Exception("" . $db->error);
            
            $stm->execute();
            $stm->bind_result($evaluaciones);
            
            $stm->fetch();
            return $evaluaciones;
        } catch (Exception $ex) {
            echo "Archivo: " . $e->getFile() . " Linea" . $e->getLine() . " Descripcion: " . $e->getMessage();
            return false;
        }
    }

}

?>

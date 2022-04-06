<?php 
    session_start();
    //si no hay session te devuelve al indice
    if(!isset($_SESSION['dni']) && !isset($_SESSION['apellido'])){
        header("Location: ../index.php");
    }
    require_once "../models/basedatos.php";
    $conn= connDB();
    
    if($_GET){
    $id = $_GET['id'];
    $tabla = $_GET['tbl'];
    $clave= $_GET['al'];
    
    if($tabla === 'nota'){
        $query= "DELETE FROM $tabla WHERE alumno='" . $id . "' and asignatura=" . $_GET['asig'];        
    }else{
        $query= "DELETE FROM $tabla WHERE $clave='" . $id . "'";        
    }

   
    $resultado = consultaBasica($conn, $query);

        if($resultado){
            header("Refresh: 2; url= modificar_datos.php");
            echo "Exito al borrar";        
        }else{
            echo "Error al borrar";
        }
    }

?>
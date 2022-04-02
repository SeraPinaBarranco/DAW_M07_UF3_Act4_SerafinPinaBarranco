<?php
    function connDB()
    {
        $server= "localhost";
        $user="root";
        $pass="";
        $db="daw_m07_actividad4";

        $mysqli = mysqli_connect($server,$user,$pass,$db)or die("Failed to connect to MySQL: ") ;

        return $mysqli;
    }

    function comprobarUsuario($conn, $query)
    {
        return mysqli_query($conn, $query);
    }

    function consulta($conn, $query){
        $resultado= mysqli_query($conn, $query);
        $filas= mysqli_fetch_array($resultado);
        return $filas;
    }

    function cerrarConexion($conn)
    {
        mysqli_close($conn);
    }

?>
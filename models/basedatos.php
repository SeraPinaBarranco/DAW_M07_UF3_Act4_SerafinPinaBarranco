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



    function consultaBasica($conn, $query)
    {
        return mysqli_query($conn, $query);
    }

    function consulta($conn, $query){
        $resultado= mysqli_query($conn, $query);
        $filas= mysqli_fetch_array($resultado);
        return $filas;
    }

    function consulta_assoc($conn, $query){
        $resultado= mysqli_query($conn, $query);
        $filas= mysqli_fetch_assoc($resultado);
        return $filas;
    }

    
    //devuelve el número de filas afectadas en la consulta previa
    function obtener_num_filas($query){
        return mysqli_num_rows($query);
	}
    
    function duplicados($conn){
        $num = mysqli_affected_rows($conn);
        return $num;

    }

    function cerrarConexion($conn)
    {
        mysqli_close($conn);
    }

?>
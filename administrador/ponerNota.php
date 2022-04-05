<?php
    require_once "../models/basedatos.php";
    $conn= connDB();

    if($_POST){
        $alumno = $_POST['alumno'];
        $asignatura = $_POST['asignatura'];
        $nota = floatval($_POST['nota']);

        $query= "INSERT INTO nota (alumno, asignatura, nota) VALUES ('".$alumno . "'," . $asignatura . ", $nota)";   

        //echo($alumno . " - " . $asignatura . " - "  . $nota);
        //echo $query;
        $c = consultaBasica($conn, $query);//Guarda el resultado de la consulta
        $n = filas_afectadas($conn);//Guarda el numero de filas affectadad

        if($c){     
            $msg = "";       
            header("Location: ../administradores.php");
        }else{
            $msg= "No guardado, Valores duplicados o mal introducidos";
        }    
        cerrarConexion($conn);
    }
    
    //traer los alumnos
    $conn= connDB();
    $query = "SELECT * FROM usuario WHERE tipo_usuario=1";
    $resultado_alumumnos= consultaBasica($conn, $query);  

    //traer las asignaturas
    $query = "SELECT * FROM asignatura";
    $resultado_asignatura= consultaBasica($conn, $query);  
    cerrarConexion($conn);
    
    // }else{
    //     echo "Error al recibir kis alumnos";
    // }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Pon Notas</title>
</head>
<body>
    <div class="row"><a href="../administradores.php">Ir a menú administradores</a></div>
    <div class="container col-3 mt-5">
        <div class="row">
            <h3>Poner nota</h3>
        </div>
        <div class="row">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="row m-3">
                        <label for="alumno">Alumno</label>
                        <select name="alumno" id="alumno" name="alumno">
                            <option value='none' selected disabled>------</option>
                            <?php
                                while($fila = mysqli_fetch_array($resultado_alumumnos)){
                                    extract($fila);
                                    echo "<option value='$dni'>$apellido</option>";
                                }
                                mysqli_free_result($resultado_alumumnos);
                                cerrarConexion($conn);                                
                            ?>                           
                        </select>
                    </div>
                    <div class="row m-3">
                        <label for="asignatura">Asignatura</label>
                        <select name="asignatura" id="asignatura" name="asignatura">
                            <option value='none' id='asignatura' selected disabled>------</option>
                            <?php
                                while($fila = mysqli_fetch_array($resultado_asignatura)){
                                    extract($fila);
                                    echo "<option  value='$identificador'>$nombre</option>";
                                }
                                mysqli_free_result($resultado_asignatura);
                                cerrarConexion($conn);                                
                            ?>                           
                        </select>
                    </div>

                    <div class="row m-3">
                        <input class="form-control" type="text" name="nota" id="nota">
                    </div>
                  
                    <div class="row">
                        <input class="btn btn-primary col-3 m-4" type="submit" value="Guardar" name="guardar">
                    </div>
                    <div>
                        <span class="badge bg-danger"><?php if(!empty($msg))echo $msg; ?></span>
                    </div>
            
            </form>
        </div>
    </div>

    
</body>
</html>
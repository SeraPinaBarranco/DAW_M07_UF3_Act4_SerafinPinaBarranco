<?php

    require_once "../models/basedatos.php";
    $conn= connDB();
    
    if($_GET){
        $mi_dni = $_GET['dni'];  
        $mi_alumno= $_GET['apellido'];
        $mi_asignatura = $_GET['id_asignatura'];  
        $mi_nota = $_GET['nota']; 
        
        //$GLOBALS['midni'] = $dni;

       // $query = "SELECT * FROM nota WHERE alumno= '" . $mi_dni . "' and asignatura= $mi_asignatura ";  
        
        $query= "SELECT u.dni, u.apellido, u.tipo_usuario, 
                    a.identificador, a.nombre, 
                    n.alumno, n.asignatura, n.nota 
                    FROM nota n, usuario u, asignatura a
                    where n.alumno = u.dni and
                    n.asignatura = a.identificador
                    and u.dni= '" . $mi_dni . "' and a.identificador=$mi_asignatura";
        
        $resultado= consulta($conn, $query);
        extract($resultado);       
    }

    if($_POST){
        //$old_dni= $_POST['old_dni'];  
        $alumno= $_POST['dni'];
        $asignatura= $_POST['asignatura'];
        $nota = floatval($_POST['nota']);

        $query = "UPDATE nota SET nota=" . $nota . " WHERE alumno= '" . $alumno . "' and asignatura= $asignatura ";
        
        if(consultaBasica($conn,$query)){
            cerrarConexion($conn);
            header("Location: modificar_datos.php");
        }else{
            echo "Error al actualizar";
        }
    }   
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <div class="container col-3 mt-5">
        <div class="row">
            <h3>Editar Nota</h3>
        </div>
        <div class="row">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="row m-3">
                        <label for="apellido">Apellido</label>
                        <input disabled class="form-control col-6" id="apellido" name="apellido" type="text" value="<?php if(isset($apellido))echo $apellido ?>">   
                        <input hidden id="dni" name="dni" type="text" value="<?php echo $dni ?>">   
                    </div>
                    <div class="row m-3">
                        <label for="apellido">Asignatura</label>
                        <input disabled class="form-control col-6" id="asignatura" name="asignatura" type="text" value="<?php if(isset($nombre)) echo $nombre ?>">                      
                        <input hidden id="asignatura" name="asignatura" type="text" value="<?php echo $identificador ?>">                      
                    </div>
                    <div class="row m-3">
                        <label for="nota">Nota</label>
                        <input class="form-control col-6" id="nota" name="nota" type="text" value="<?php if(isset($nota)) echo $nota ?>">                      
                    </div>
                   
                    
                    <div class="row">
                        <input class="btn btn-primary col-3 m-4" type="submit" value="Guardar" name="guardar">
                    </div>
            
            </form>
        </div>
    </div>
</body>
</html>
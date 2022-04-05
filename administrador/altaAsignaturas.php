<?php
require_once "../models/basedatos.php";
    
    if($_POST){
        $id = intval($_POST['id']);
        $asignatura = $_POST['asignatura'];
      
        if($_POST['id'] !== "0" && !empty($asignatura)){                
            $conn= connDB();
            $query= "INSERT INTO asignatura (identificador, nombre) VALUES (".$id . ", '" . $asignatura . "')";   
            
            if(consultaBasica($conn, $query)){
                header("Location: ../administradores.php");
            }else{
            echo "No guardado";
            }    
            cerrarConexion($conn);
        }else{
            echo "Error en los campos";
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
    <title>Alta Asignaturas</title>
</head>
<body>
    <div class="row"><a href="../administradores.php">Ir a menú administradores</a></div>
    <div class="container col-3 mt-5">
        <div class="row">
            <h3>Nueva asignatura</h3>
        </div>
        <div class="row">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="row m-3">
                        <label for="id">Identicifador de asignatura</label>
                        <input class="form-control col-6" id="id" name="id" type="number" value="" placeholder="Introduce el ID">   
                    </div>
                    <div class="row m-3">
                        <label for="apellido">Asignatura</label>
                        <input class="form-control col-6" id="asignatura" name="asignatura" type="text" value="" placeholder="Nombre de la asignatura">                      
                    </div>
                  
                    <div class="row">
                        <input class="btn btn-primary col-3 m-4" type="submit" value="Guardar" name="guardar">
                    </div>
            
            </form>
        </div>
    </div>
</body>
</html>


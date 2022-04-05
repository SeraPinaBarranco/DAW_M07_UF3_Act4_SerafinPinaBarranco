<?php
require_once "../models/basedatos.php";
$conn= connDB();
    if($_POST){
        $dni = $_POST['dni'];
        $apellido = $_POST['apellido'];
        $tipo = intval($_POST['tipo']);

        //Si los campos de entrada no estan vacios o no hay usuario seleccionado
        if(!empty($_POST['dni']) && !empty($_POST['apellido']) && $tipo !== -1){
    
            
            $conn= connDB();
            $query= "INSERT INTO usuario (dni, apellido, tipo_usuario ) VALUES ('".$dni . "', '" . $apellido . "', '" . $tipo . "'   )";
            
            if(consultaBasica($conn, $query)){
                echo ("Guardado");
            }else{
            echo "No guardado";
            }
    
        }else{
            echo "Error en los campos";
        }
        
    }
    cerrarConexion($conn);

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
    <div class="row"><a href="../administradores.php">Ir a menú administradores</a></div>
    <div class="container col-3 mt-5">
        <div class="row">
            <h3>Nuevo usuario</h3>
        </div>
        <div class="row">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="row m-3">
                        <label for="dni">DNI</label>
                        <input class="form-control col-6" id="dni" name="dni" type="text" value="" placeholder="Introduce el DNI">   
                    </div>
                    <div class="row m-3">
                        <label for="apellido">Apellido</label>
                        <input class="form-control col-6" id="apellido" name="apellido" type="text" value="" placeholder="Introduce el apellido">                      
                    </div>
                    <div class="row m-3">
                        <label for="tipo">Tipo de usuario</label>
                        <select name="tipo" id="tipo">
                            <option value="-1" selected>-----</option>
                            <option value="0">Administrador</option>
                            <option value="1">Usuario</option>
                        </select>                    
                    </div>
                    <div class="row">
                        <input class="btn btn-primary col-3 m-4" type="submit" value="Guardar" name="guardar">
                    </div>
            
            </form>
        </div>
    </div>
</body>
</html>


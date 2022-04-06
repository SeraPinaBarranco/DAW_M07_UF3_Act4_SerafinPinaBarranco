<?php
    session_start();
    //si no hay session te devuelve al indice
    if(!isset($_SESSION['dni']) && !isset($_SESSION['apellido'])){
        header("Location: ../index.php");
    }
    //si la session no es de administrador no deja entrar
    if($_SESSION['tipo']=== "1"){
        header("Location: ../logout.php");
    }

    require_once "../models/basedatos.php";
    $conn= connDB();
    global $mi_dni;
   
    if($_GET){
        $dni = $_GET['dni'];        
        $GLOBALS['midni'] = $dni;

        $query = "SELECT * FROM usuario WHERE dni= '" . $GLOBALS['midni'] . "'";       
        $resultado= consulta($conn, $query);
        extract($resultado);       
    }

    if($_POST){
        $old_dni= $_POST['old_dni'];                      
        $query = "UPDATE usuario SET dni='" . $_POST['dni'] . "', apellido= '" . $_POST['apellido'] . "' WHERE dni='" . $old_dni . "'";
        echo $query;
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
    <div class="row" style="text-align: right;">
        <a href="../logout.php">LOGOUT</a>
    </div>
    <div class="container col-3 mt-5">
        <div class="row">
            <h3>Editar alumno</h3>
        </div>
        <div class="row">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="row m-3">
                        <label for="dni">DNI</label>
                        <input class="form-control col-6" id="dni" name="dni" type="text" value="<?php if(isset($dni))echo $dni ?>" placeholder="Introduce el DNI">   
                    </div>
                    <div class="row m-3">
                        <label for="apellido">Apellido</label>
                        <input class="form-control col-6" id="apellido" name="apellido" type="text" value="<?php if(isset($apellido)) echo $apellido ?>" placeholder="Introduce el apellido">                      
                    </div>
                    <input type="text" name="old_dni" value="<?php echo $dni; ?>" hidden >
                    
                    <div class="row">
                        <input class="btn btn-primary col-3 m-4" type="submit" value="Guardar" name="guardar">
                    </div>
            
            </form>
        </div>
    </div>
</body>
</html>
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

    <div class="container mt-5" id="contenedor">
        <div class="row mb-3">
            <h3>Validación de usuarios</h3>
        </div>
        <div class="row col-3">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="mb-3">
                    <label for="dni" class="form-label">Introduce el DNI</label>
                    <input type="text" class="form-control" id="dni" name="dni">

                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido">
                </div>

                <input type="submit" name="submit" class="btn btn-primary">
            </form>

        </div>

        <?php
        require_once "models/basedatos.php";
        $conexion = connDB();

        // if(isset($_POST['dni']) && isset($_POST['apellido'])){
        if (isset($_POST['dni']) && isset($_POST['apellido'])) {
            if(!empty($_POST['dni']) || !empty($_POST['apellido'])){
                $dni = $_POST['dni'];
                $apellido = $_POST['apellido'];
    
                //realizar consulta
                $query = "SELECT tipo_usuario FROM usuario WHERE dni='" . $dni . "' and apellido= '" . $apellido . "'";
                $resultado = consulta($conexion, $query);

                $num_filas= duplicados($conexion);
                
                //si trae resultados de la base de datos
                if($num_filas == 1){
                    extract($resultado);
                    $tipo = $tipo_usuario;
                    echo $tipo;
                    cerrarConexion($conexion);
                    if ($tipo == 0) {
                        header("Location: administradores.php");
                    }
                    if ($tipo == 1) {
                        header("Location: alumnos.php");
                    }
                    $num_filas = 0;
                }else{
                    error();
                }    
             }else{
                 error();
            }
        }

        function error(){

            echo "error";
                       
        }
        ?>

        <!-- <script>
            setTimeout(() => {
                let contenedor= document.getElementById('contenedor');
                let div= document.createElement('div');
                div.setAttribute('class', 'badge bg.danger');
                div.setAttribute('class', 'col-6');
                div.innerHTML="Error";

                contenedor.append(div);

            }, 2000);
        </script> -->

    </div>

   
        
    
</body>

</html>
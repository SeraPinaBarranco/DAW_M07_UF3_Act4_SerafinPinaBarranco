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
    
    //traer los alumnos
    $conn= connDB();
    $query = "SELECT * FROM usuario WHERE tipo_usuario=1";
    $resultado_alumumnos= consultaBasica($conn, $query);  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Ver notas de usuario</title>
</head>
<body>
    <div class="row" style="text-align: right;">
        <a href="../logout.php">LOGOUT</a>
    </div>
    <div class="row"><a href="../administradores.php">Ir a menú administradores</a></div>
    <div class="container col-3">
        <div class="row">
            <h3>Selección de usuario</h3>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <select class="form-control" name="alumno" id="alumno">
                <option selected disabled value="">------</option>
            <?php
                while($fila = mysqli_fetch_array($resultado_alumumnos)){
                    extract($fila);                
                    echo "<option value='$dni'>$apellido</option>";                                
                
                }
                mysqli_free_result($resultado_alumumnos);
                //cerrarConexion($conn); 
            ?> 

            </select>

            <input class="btn btn-primary mt-3" type="submit" value="Ver">
        </form>

        <?php
        if($_POST){
            //Traer la consulta con las notas
            $dni = $_POST['alumno'];
            $query="SELECT apellido FROM usuario WHERE dni= '" . $dni ."'";
            $alumn= consulta_assoc($conn,$query);
            extract($alumn);

            $query = "SELECT u.dni, u.apellido, u.tipo_usuario, 
                a.identificador, a.nombre, 
                n.alumno, n.asignatura, n.nota 
                FROM nota n, usuario u, asignatura a
                where n.alumno = u.dni and
                n.asignatura = a.identificador
                and n.alumno= '" . $dni ."' ";
             $res= consultaBasica($conn, $query);
             
                echo "<div class='row mt-5'>
                        <h3>Notas de <strong>$apellido</strong></h3>
                    </div>";

                echo "<table class='table'>
                        <tr>
                            <td>Asisnatura</td>
                            <td>Calificación</td>
                    </tr>";
            while($fila = mysqli_fetch_array($res)){
                extract($fila);
                    echo "<tr>";
                    echo "<td>";
                    echo $nombre;
                    echo "</td>";
                    echo "<td>";
                    echo $nota;
                    echo "</td>";
                    echo "</tr>";
                    
            }  
                echo "</table>";
        }else{
            echo "Este alumno no tiene notas";
        }

      
        ?>





    </div>
    
</body>
</html>
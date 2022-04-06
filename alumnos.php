<?php
    session_start();
    //si no hay session te devuelve al indice
    if(!isset($_SESSION['dni']) && !isset($_SESSION['apellido'])){
        header("Location: index.php");
    }
    require_once "models/basedatos.php";
    $conn = connDB();

    $query= "SELECT u.dni, u.apellido, u.tipo_usuario, 
                a.identificador, a.nombre, 
                n.alumno, n.asignatura, n.nota 
                FROM nota n, usuario u, asignatura a
                where n.alumno = u.dni and
                n.asignatura = a.identificador
                and n.alumno= '". $_SESSION['dni'] ."'";    
    $resultado_alumumnos= consultaBasica($conn, $query);

    //Traer los datos del usuario que estan almacenados en la sesion

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Alumnos</title>
</head>
<body>

    <div class="container col-3">
        <div class="row" style="text-align: right;">
            <a href="logout.php">LOGOUT</a>
        </div>
        <div class="row">
            <h3><?php echo $_SESSION['apellido']  ?>, estas son tus notas</h3>
        </div>
        <div class="row">
            <table class="table">
                <tr>
                    <th>
                        Asignatura
                    </th>
                    <th>
                        Nota
                    </th>
                </tr>
            <?php 
                while($fila = mysqli_fetch_array($resultado_alumumnos)){
                    extract($fila);                
                    echo "<tr>";
                    echo "<td>";
                    echo $nombre;
                    echo "</td>";
                    echo "<td class='badge bg-success'>";
                    echo $nota;
                    echo "</td>";
                    echo "</tr>";                                
                    
                }
                mysqli_free_result($resultado_alumumnos);
                cerrarConexion($conn);
            ?>
            </table>
        </div>
    </div>

    
</body>
</html>
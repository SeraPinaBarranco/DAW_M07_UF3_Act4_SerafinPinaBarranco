<?php
    require_once "../models/basedatos.php";
    $conn= connDB();
    
    //traer los alumnos
    $conn= connDB();
    $query = "SELECT * FROM usuario WHERE tipo_usuario=1";
    $resultado_alumumnos= consultaBasica($conn, $query);  

    //traer las asignaturas
    $query = "SELECT * FROM asignatura";
    $resultado_asignatura= consultaBasica($conn, $query);  
    
    //traer las notas
    $query= "SELECT u.dni, u.apellido, u.tipo_usuario, 
                    a.identificador, a.nombre, 
                    n.alumno, n.asignatura, n.nota 
                    FROM nota n, usuario u, asignatura a
                    where n.alumno = u.dni and
                    n.asignatura = a.identificador";
    $notas= consultaBasica($conn, $query);

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Modificar datos</title>
</head>
<body>
    <div class="row"><a href="../administradores.php">Ir a menú administradores</a></div>
    <div class="container col-4 mt-5">
        <div class="row">
            <h2 style="color:white" class="barge bg-primary text-center">Modificar datos</h2>
        </div>
        <div class="row text-center mb-5">
            <h3>Modificar alumno</h3>
            <!-- Poner tabla alumnos -->
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" >
                <table class="table">
                    <thead>
                        <tr>
                            <td>
                                Alumno
                            </td>
                            <td>
                                Editar
                            </td>
                            <td>
                                Borrar
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($fila = mysqli_fetch_array($resultado_alumumnos)){
                                extract($fila);
                                echo "<tr>";
                                echo "<td>$apellido</td>";                                
                                echo "<td><a href='editar_alumno.php?dni=$dni'>Editar</a></td>";
                                echo "<td><a href='borrar.php?id=$dni&tbl=usuario&al=dni'>Borrar</a></td>";
                                echo "</tr>";
                            }
                            mysqli_free_result($resultado_alumumnos);
                            //cerrarConexion($conn);                                
                        ?> 
                    </tbody>
                </table>
            </form>
        </div>
        <div class="row text-center mb-5">
            <h3>Modificar asignatura</h3>
            <!-- Poner tabla asignaturas -->
            <table class="table">
                <thead>
                    <tr>
                        <td>
                            Asignatura
                        </td>
                        <td>
                            Editar
                        </td>
                        <td>
                            Borrar
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($fila = mysqli_fetch_array($resultado_asignatura)){
                            extract($fila);
                            echo "<tr>";
                            echo "<td>$nombre</td>";
                            echo "<td><a href='editar_asignatura.php?id=$identificador'>Editar</a></td>";
                            echo "<td><a href='borrar.php?id=$identificador&tbl=asignatura&al=identificador'>Borrar</a></td>";
                            echo "</tr>";
                        }
                        mysqli_free_result($resultado_asignatura);
                        //cerrarConexion($conn);                                
                    ?> 
                </tbody>
            </table>
        </div>
        <div class="row text-center">
            <h3>Modificar nota</h3>            
            <!-- Nota -->
            <table class="table">
                <thead>
                    <tr>
                        <td>
                            Alumno
                        </td>
                        <td>
                            Asignatura
                        </td>
                        <td>
                            Nota
                        </td>
                        <td>
                            Editar
                        </td>
                        <td>
                            Borrar
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($fila = mysqli_fetch_array($notas)){
                            extract($fila);
                            echo "<tr>";
                            echo "<td>$apellido</td>";
                            echo "<td>$nombre</td>";
                            echo "<td>$nota</td>";
                            echo "<td><a href='editar_nota.php?dni=$dni&apellido=$apellido&id_asignatura=$identificador&nota=$nota'>Editar</a></td>";
                            echo "<td><a href='borrar.php?id=$dni&asig=$asignatura&tbl=nota&al=none'>Borrar</a></td>";
                            echo "</tr>";
                        }
                        mysqli_free_result($notas);
                        cerrarConexion($conn);                                
                    ?> 
                </tbody>
            </table>
        </div>
    </div>
    
</body>
</html>
<?php
    session_start();
    //si no hay session te devuelve al indice
    if(!isset($_SESSION['dni']) && !isset($_SESSION['apellido'])){
        header("Location: index.php");
    }
    //si la session no es de administrador no deja entrar
    if($_SESSION['tipo']=== "1"){
        header("Location: logout.php");

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
    <title>ADMINISTRADORES</title>
</head>
<body>
    <div class="container">
        <div class="row text-end">
            <a href="logout.php">LOGOUT</a>
        </div>
    </div>
    <div class="container">
        <div class="row mt-5">
            <h3>MENÚ ADMINISTRADOR</h3>
        </div>
        <div class="row m-3">
            <a href="administrador/altaUsuarios.php">Dar alta <strong>usuarios</strong></a>
        </div>
        <div class="row m-3">
            <a href="administrador/altaAsignaturas.php">Dar alta <strong>asignaturas</strong></a>
        </div>
        <div class="row m-3">
            <a href="administrador/ponerNota.php">Poner <strong>nota</strong> </a>
        </div>
        <div class="row m-3">
            <a href="administrador/modificar_datos.php">Modificar <strong>datos</strong></a>
        </div>
        <div class="row m-3">
            <a href="administrador/modificar_datos.php">Eliminar <strong>usuarios (ESTA OPCION ESTA HECHA EN MODIFICAR DATOS)</strong></a>
        </div>
        <div class="row m-3">
            <a href="administrador/visualizar_notas.php">Visualizar notas</a>
        </div>
    </div>
    
</body>
</html>
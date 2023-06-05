<?php 
require('inc/conexion.php');

// Recogemos la id de la url
if($_GET){
    // Como en eventosCalendar la hemos llamado id a secas la almacenamos en una variable
$idEvento = $_GET['id'];

    // Consulta en la cual coincida la id, cuando hagamos un execute le pasamos el parametro $idEvento para que la reemplace por ese ?
    $consulta3 = "SELECT * FROM tb_eventos WHERE idEvento = ?";
    $sentencia3 = $conexion->prepare($consulta3);
    $sentencia3->execute([$idEvento]);
    $resultados3= $sentencia3->fetch();


};

// Al pulsar el boton de añadir evento pasará lo siguiente 
// Haremos una consulta en la cual se realizará un update de los valores
if($_POST){
   
    $titulo = $_POST['titulo'];
    $inicio = $_POST['inicio'];
    $fin = $_POST['fin'];
    $descripcion = $_POST['descripcion'];
    $color = $_POST['color'];

    $consulta = "UPDATE tb_eventos SET Titulo_Evento = ?,Inicio_Evento = ? ,Fin_Evento = ?,Descripcion_Evento = ?,Color_Evento = ? WHERE idEvento = ?";
    $sentencia = $conexion->prepare($consulta);
    $sentencia->execute([$titulo,$inicio,$fin,$descripcion,$color,$idEvento]);


    if($sentencia){
        header('Location:eventosCalendar.php');
    }

};


?> 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- Include the Dark theme -->
    <link rel="stylesheet" href="node_modules/@sweetalert2/theme-dark/dark.css">



</head>
<body>
    
    <div class="container my-5 p-5 ">
        <div class="row p-5 border d-flex justify-content-center text-center">
            <h1 class="my-3">Añadir Evento</h1>
            <div class="col-md-6 offeset-md-3">
                <form action="#" method="post">
                    <input type="text" value="<?= $resultados3['Titulo_Evento']?>" class="form-control my-3" name="titulo" placeholder="Titulo evento" required>
                    <input type="datetime-local" value="<?= $resultados3['Inicio_Evento']?>" class="form-control my-3" name="inicio" required>
                    <input type="datetime-local" value="<?= $resultados3['Fin_Evento']?>" class="form-control my-3" name="fin" required>
                    <textarea name="descripcion" value="<?= $resultados3['Descripcion_Evento']?>"  class="form-control my-3" cols="30" rows="10" required placeholder="Descripción"></textarea>
                    <label for="color" class="form-control">
                        <input type="color" value="<?= $resultados3['Color_Evento']?>" id="color" name="color">
                        Color del evento
                    </label>
                    <input type="submit" class="btn btn-primary my-3" value="Añadir evento">
                </form>

            </div>
        </div>
    </div>
</body>
</html>
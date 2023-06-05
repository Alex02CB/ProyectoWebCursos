<?php require_once('header.php')?>
<?php require_once('./inc/conexion.php')?>

<?php

// En $idCurso almacenamos el id que hemos mandado al hacer click en el heder junto al boton de cursos

if(isset($_GET['idCurso'])){

    $idCurso= $_GET['idCurso'];
    // echo "<h1>$idCurso</h1>";

}

require_once ("./inc/conexion.php");

$consulta2 = "SELECT * FROM tb_cursos,tb_profesores WHERE idCurso = ?";
$sentencia2= $conexion->prepare($consulta2);
$sentencia2->execute([$idCurso]);
$resultado2 = $sentencia2->fetch();


// Ejecutamos la siguiente condicion en la cual cada vez que un usuario quiera cambiar el id de la url y no exista en la base de datos los redirigirá a la home

if($resultado2['idCurso'] != $idCurso){
    header('Location:index.php');
}


?>

<div class="container border p-5">
    <div class="row my-5">
        <div class="col-12">
            <div><img src="img/<?php echo $resultado2['imagenCurso']?>" alt=""></div>
            <h1><?php echo $resultado2['nombreCurso']?></h1>
            <h2><?php echo $resultado2['nombreProfesor']?></h2>
            <p><?php echo $resultado2['textoCurso']?></p>
            <a href="index.php" class="btn btn-primary">Volver</a>
        </div>
    </div>
</div>

<!-- <?php require_once('footer.php')?> -->
<?php require('inc/conexion.php');?>
<?php include('function.php');?>


<?php require('./header.php');?>

<?php

if($_GET){
    require('inc/conexion.php');
    $buscaCurso="%".$_GET['buscarCurso']."%";


    $consultaTabla = "SELECT * FROM tb_cursos WHERE nombreCurso LIKE ?"; 
    $sentencia = $conexion->prepare($consultaTabla);
    $sentencia->execute([$buscaCurso]);
    $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    // echo "<pre>";
    //     var_dump($resultados);
    // echo "</pre>";

}else{
    header('Location:index.php');
}

?>

<main>

<!-- Cuando hay coincidencia -->

<?php if($resultados != NULL){ ?>


    <div class="container">
        <div class="row border p-5">
            <div class="col-12">
                <h1>Resultado busqueda</h1>
                <p>Se han encontrado los siguientes cursos:</p>
                <div class="container">
                    <div class="row">
                    <?php foreach($resultados as $fila) { ?>
                        <div class="col-md-4">
                            <div class="sombra">
                                <img src="img/<?php echo $fila['imagenCurso']?>" alt="<?= $fila ['seoCurso'] ?>">
                                <h3><?php echo$fila['nombreCurso']?></h3>
                                <p><?php echo extraer($fila['textoCurso'],20).'...'?> 
                                <div>
                                    <!-- Cuando ponemos ? seguido de idCurso estamos creando una variable en la cual estamos almacenando la id del curso -->
                                    <a href="detalleCurso.php?idCurso=<?= $fila['idCurso']?>" class="btn btn-primary mt-4">+ Info</a>
                                </div>
                                </p>
                                <hr>

                            </div>
                        </div>
                    <?php } ?>
                </div>
                </div>
            </div>
        </div>
    </div>

<?php }else{?>

<!-- Cuando no hay coincidencia -->



<div class="container">
        <div class="row border p-5">
            <div class="col-12">
            <div class="alert alert-danger" role="alert">
                No he podido encontrar lo que buscabas
            </div>
            </div>
        </div>
    </div>

    <!-- Creamos un setTimeut tras 5 segundos te redirigirá a la página inicial -->
    <script>
        setTimeout (()=>{
            window.location = "index.php";
        },5000);
    </script>
    
    <?php }?>

</main>


<script src="bootstrap/js/bootstrap.min.js"></script>   
<?php include('modal.php');?>

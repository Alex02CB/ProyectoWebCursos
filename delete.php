<?php 
require_once('header.php');
require_once('inc/conexion.php');

if(isset($_GET['idCurso'])){

    $idCurso=$_GET['idCurso'];
    echo "Se borrará el curso con id ".$estado;

    $consulta="DELETE FROM tb_cursos WHERE idCurso=?";
    $sentencia=$conexion->prepare($consulta);
    $sentencia->execute([$idCurso]);

    if($sentencia){
        header("Location:admin.php");
    }
    else{
        header("Location:admin.php");
    }
}
    
?>
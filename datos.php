<?php require('inc/conexion.php'); ?>

<?php 
$consulta= "SELECT * FROM tb_eventos";
$sentencia= $conexion->prepare($consulta);
$sentencia->execute();
$resultadosBDcalendar = $sentencia->fetchAll();

// Mostramos los datos en formato json
echo json_encode($resultadosBDcalendar);
?>
<?php require('inc/conexion.php')?>

<?php
$texto = "Hola amigo del mundo mundial";

function extraer ($texto,$numPalabras){

    $palabras = explode(' ',$texto);
    $palabrasLimite = array_slice($palabras,0,$numPalabras);
    $resultado = implode(' ',$palabrasLimite);
    return $resultado;

}


// selecionamos la tabla de cursos
$consulta = "SELECT * FROM tb_cursos,tb_profesores WHERE tb_cursos.idProfesor = tb_profesores.idProfesor  LIMIT 3";

// Preparamos la consulta
$sentencia = $conexion->prepare($consulta);

// Ejecutamos la consulta
$sentencia->execute();

// Mostrar los datos
$resultados = $sentencia->fetchAll();


?>
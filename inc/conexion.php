<?php 

$user = "root";
$pass = "root";
$db = "escuela";
$host = "localhost";

try {
    $conexion = new PDO("mysql:host=$host; dbname=$db; charset=utf8",$user,$pass);
}

catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}

?>
<?php require_once('inc/conexion.php')?>
<?php require_once('header.php');?>


<?php 



// Realizamos una petecicion a la base de datos
$consulta = "SELECT * FROM tb_profesores";
$sentencia = $conexion->prepare($consulta);
$sentencia->execute();
$resultados= $sentencia->fetchAll();



if($_POST){
    $idProfesor = $_POST['idProfesor'];
    $nombreCurso = $_POST['nombreCurso'];
    $fecha = $_POST['fecha'];
    $textoCurso = $_POST['textoCurso'];
    $alumnosCurso = $_POST['alumnosCurso'];
    $precio = $_POST['precio'];
    $estado = $_POST['estado'];
    $seoCurso = $_POST['seoCurso'];
  

    // Cargamos la imagen para luego moverla a la carpeta que tenemos creada de img.
    // $nombreImagen = $imagenCurso['name'];
    $imagenCurso = $_FILES['imagenCurso']['name'];
    $imagenTemporal= $_FILES ['imagenCurso']['tmp_name'];
    $carpeta = 'img/'.$imagenCurso;
    move_uploaded_file($imagenTemporal,$carpeta);
    

    echo "<pre>";
    var_dump($imagenCurso);
    echo "</pre>";

    $consulta2 = "INSERT INTO tb_cursos (idProfesor,nombreCurso,fecha,textoCurso,alumnosCurso,precio,estado,seoCurso,imagenCurso) VALUES (?,?,?,?,?,?,?,?,?)";

    $sentencia2 = $conexion->prepare($consulta2);
    // En execute introducimos todos los datos que queremos que se ejecuten, al escribir en el form que hemos creado al darle a enviar esos datos se almacenarán en sus respectivas variables. Las culaes tienen que coincidir con el orden de la llamada a la base de datos 
    $sentencia2->execute([$idProfesor,$nombreCurso,$fecha,$textoCurso,$alumnosCurso,$precio,$estado,$seoCurso,$imagenCurso]);

    if($sentencia2){
        header('Location:admin.php');
    }

}

?>

<div class="container"></div>
    <div class="row">
        <div class="col-md-6 offset-3">
        <!-- Con el enctype podemos subir archivos como la imagenes -->
        <form action="#" method="POST" enctype="multipart/form-data">
            
            <select name="idProfesor" class="form-control my-5" >  
                <option value="">Seleccionar profesor </option> 
                <?php foreach($resultados as $fila){?> 
                    <option value="<?=  $fila['idProfesor'] ?>"> <?= $fila['nombreProfesor']?></option>
                <?php }?>
            </select>
            <input type="text" name="nombreCurso" placeholder="Nombre Curso"  class="form-control my-5">
            <input type="date" name="fecha" placeholder="Fecha Curso"  class="form-control my-5">
            <textarea name="textoCurso" placeholder="Texto descripción" rows="5" class="form-control my-5"></textarea>
            <input type="number" name="alumnosCurso"  placeholder="Alumnos curso" class="form-control my-5">
            <input type="number" name="precio"  placeholder="Precio Curso" class="form-control my-5">

            <select name="estado" class="form-control my-5">
                <option value="">Activar/Inactivo</option>
                <option value="1">Activo </option>
                <option value="0">Inactivo</option>
            </select>

            <textarea name="seoCurso" rows="3" class="form-control my-5" placeholder="Seo Curso"></textarea>
            
            <label for="imagenCurso" class="btn btn-warning">Subir imagen
                <input type="file" name="imagenCurso" id="imagenCurso"  class="d-none">
            </label>
            <input type="submit" class="btn btn-success" value="Enviar">

        </form>

        </div>
    </div>
</div>

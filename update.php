

<?php require('inc/conexion.php')?>
<?php require_once('header.php');?>
<?php include('function.php');?>


<?php 

// Creamos una funcion profe en la cual seleccionamos la tb_profesores
function profe(){
    // Consulta profesores
    include('inc/conexion.php');
    $consulta3 = "SELECT * FROM tb_profesores";
    $sentencia3 = $conexion->prepare($consulta3);
    $sentencia3->execute();
    $resultados3= $sentencia3->fetchAll();
    return $resultados3;
};

$profe = profe();

    echo "<pre>";
    var_dump($profe);
    echo "</pre>";
// ---------



if(isset($_GET['idCurso'])){
    $idCurso = $_GET['idCurso'];

    // CURSOS Y PROFESORES
    // Cuando trabajamos con fecth no necesitamos realizar un foreach, pero cuando hacemos un fetchAll si que es necesario realizar un foreach
    $consulta ="SELECT * FROM tb_cursos,tb_profesores WHERE tb_cursos.idProfesor = tb_profesores.idProfesor AND tb_cursos.idCurso = ? ";
    $sentencia = $conexion->prepare($consulta);
    $sentencia->execute([$idCurso]);
    $resultadoCursosProfesores= $sentencia->fetch(PDO::FETCH_ASSOC);
    
    // echo "<pre>";
    // var_dump($resultadoCursosProfesores);
    // echo "</pre>";

    
}

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
    

    // echo "<pre>";
    // var_dump($imagenCurso);
    // echo "</pre>";

    $consulta2 = "UPDATE tb_cursos SET idProfesor = ? ,nombreCurso = ?,fecha = ?,textoCurso = ? ,alumnosCurso = ?,precio  = ?,estado = ?,seoCurso = ?,imagenCurso = ? WHERE tb_cursos.idCurso = ? ";

    $sentencia2 = $conexion->prepare($consulta2);
    // En execute introducimos todos los datos que queremos que se ejecuten, al escribir en el form que hemos creado al darle a enviar esos datos se almacenarán en sus respectivas variables. Las culaes tienen que coincidir con el orden de la llamada a la base de datos 
    $sentencia2->execute([$idProfesor,$nombreCurso,$fecha,$textoCurso,$alumnosCurso,$precio,$estado,$seoCurso,$imagenCurso,$idCurso]);

    if($sentencia2){
        header('Location:admin.php');
    }

}

?>

<div class="container">
    <div class="row">
    <div class="col-md-6 offset-3">
            <h1>Editar Curso <?= $resultadoCursosProfesores['nombreCurso']?></h1>
            <img src="img/<?= $resultadoCursosProfesores['imagenCurso']?>" alt="" class="img-fluid">
            </div>
    </div>
</div>
    
        <div class="col-md-6 offset-3">
        <!-- Con el enctype podemos subir archivos como la imagenes -->
        <form action="#" method="POST" enctype="multipart/form-data">
            
            <select name="idProfesor" class="form-control my-5" > 
                <!-- Realizamos un foreach en el cual recorremos la tabla profesores -->
                <?php foreach($profe as $filaProfesor){?>
                <!-- Creamos una condicion si el hambos profesores coinciden en hambas tablas me devuelve un selected -->
                <option value="<?=$filaProfesor['idProfesor']?>" <?php if($resultadoCursosProfesores['idProfesor'] == $filaProfesor['idProfesor']){echo "selected";}?> > 
                    <?= $filaProfesor['nombreProfesor']?>
                </option>  

                <?php }?>
            </select>


            <input type="text" value="<?= $resultadoCursosProfesores['nombreCurso']?>" name="nombreCurso" placeholder="Nombre Curso"  class="form-control my-5">
            <input type="date"value="<?= $resultadoCursosProfesores['fecha']?>" name="fecha" placeholder="Fecha Curso"  class="form-control my-5">
            <textarea name="textoCurso" placeholder="Texto descripción" rows="5" class="form-control my-5"><?= $resultadoCursosProfesores['textoCurso']?></textarea>
            <input type="number" value="<?= $resultadoCursosProfesores['alumnosCurso']?>" name="alumnosCurso"  placeholder="Alumnos curso" class="form-control my-5">
            <input type="number" value="<?= $resultadoCursosProfesores['precio']?>" name="precio"  placeholder="Precio Curso" class="form-control my-5">

            <select name="estado" class="form-control my-5">
                <option value="">Activar/Inactivo</option>
                <option value="1"<?php if($resultadoCursosProfesores['estado'] == 1){echo "selected";}?> >Activo </option>
                <option value="0"<?php if($resultadoCursosProfesores['estado'] == 0){echo "selected";}?>>Inactivo</option>
            </select>

            <textarea name="seoCurso" rows="3" class="form-control my-5" placeholder="Seo Curso"><?= $resultadoCursosProfesores['seoCurso']?></textarea>
            
            <label for="imagenCurso" class="btn btn-warning">Subir imagen
                <input type="file" name="imagenCurso" id="imagenCurso"  class="d-none">
            </label>
            <input type="submit" class="btn btn-success" value="Guardar Cambios">

        </form>

        </div>
    </div>
</div>
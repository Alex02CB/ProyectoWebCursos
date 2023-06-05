<?php

// INICIO LIBRERIA

ob_start();

// include autoloader
require_once './library/dompdf/autoload.inc.php';

// Llamamos a dompdf
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

// FIN LIBRERIA 

?>

<?php require_once('inc/conexion.php');?>
<?php 



// PAGINACION
// En la variable rgPorPagina almacenamos el numero de filas que queremos que aparezca
$rgPorPagina=5;
$paginaActual= isset($_GET['pagina'])? $_GET['pagina'] : 1 ;
$inicio = ($paginaActual-1)*$rgPorPagina;
// FIN PAGINACION

// Preparamos la consulta
$consulta = "SELECT * FROM tb_cursos LIMIT $inicio,$rgPorPagina";
$sentencia= $conexion->prepare($consulta);
$sentencia -> execute();
$resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
// Fin consulta

// Consulta para poder mostrar todas las filas que tenemos

$consultaPagina = "SELECT * FROM tb_cursos";
$sentencia2= $conexion->prepare($consultaPagina);
$sentencia2->execute();
// Con rowCount sacamos el numero de filas
$totalFilas = $sentencia2->rowCount();

// ceil() devuelve el entero mayor o igual más próximo a un número dado.
$totalPaginas= ceil($totalFilas/$rgPorPagina);


?>

<?php include_once('./header.php');?>

<?php require_once('function.php');?>

<div class="container">
    <div class="row">
        <div class="col-10 offset-1">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Id Curso</th>
                <th scope="col">Nombre Curso</th>
                <th scope="col">Fecha</th>
                <th scope="col">Foto</th>
                <th scope="col">Precio</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Visible</th>
                <th scope="col"><a href="add.php" class="btn btn-primary">Añadir <i class="bi bi-plus-circle-fill"></i></a></th>
                <th scop="col">
                    <a href="imprimir_pdf.php" target="_Blank" class="btn btn-secondary">Imprimir <i class="bi bi-filetype-pdf"></i></a>
                </th>
                </tr>
            </thead>

<?php foreach($resultado as $fila) {?>
            <tbody>
                <tr>
                <td><?= $fila['idCurso']?></td>
                <td><?= $fila['nombreCurso']?></td>
                <td><?= $fila['fecha']?></td>
                <td><img src="http://<?= $_SERVER["HTTP_HOST"]?>/ProyectoWebCursos/img/<?= $fila['imagenCurso']?>" alt="" class="img-fluid" width="70"></td>
                <td><?= $fila['precio']?></td>
                <td><?= extraer($fila['textoCurso'],5)?></td>
                <td><?= $fila['estado'] == 1 ? "Si" : "No" ?></td>
                <td><a href="update.php?idCurso=<?=$fila['idCurso']?>" class="btn btn-success ">Editar <i class="bi bi-pencil"></i> </a></td>
                <!-- Al pulsar el boton borrar redirigimos a delete.php con el id de esa fila  -->
                <td><a href="#" onClick="eliminar(<?= $fila['idCurso']?>,`<?= $fila['nombreCurso']?>`)" class="btn btn-danger ">Borrar <i class="bi bi-trash"></i></a></td>
                </tr>
                <?php }?>
            </tbody>

        </table>
        </div>
    </div>
</div>

<!-- PAGINACION  -->

<div class="container">
    <div class="row">
        <div class="col-10 offset-1 my-5">
            <nav aria-label="Page navigation example">
                <ul class="pagination">

                    <!-- Mostrar flecha retroceder -->
                    <?php if($paginaActual != 1){ ?> 
                        <li class="page-item">
                        <a class="page-link" href="?pagina<?= $paginaActual - 1?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    
                    <?php }?>

                    <?php for($i=1;$i<=$totalPaginas;$i++){ ?>
                        <!-- Creamos una condicion para decirle que si $i es igual a la pagina actual se pone la clase active, que se encargará de motrar el boton en azul -->
                    <li class="page-item "><a class="page-link <?php if($i == $paginaActual){echo "active";}?>" href="?pagina=<?= $i ?>"><?php echo $i ?></a></li>
                    <?php }; ?>

                    <!-- No se muestra las flechas ya que estamos en la última página y no sería necesario -->
                    <?php if($paginaActual < $rgPorPagina){ ?>
                    <li class="page-item">
                        <a class="page-link " href="?pagina=<?= $paginaActual + 1?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                    <?php }?>

                </ul>
            </nav>
        </div>
    </div>
</div>


<!-- INICIO RENDER -->

<?php 

// Entre ob_start y ob_get_clean metemos todo el código que queremos mostrar, lo almacenamos en la variable $html y lo mostramos en loadHTML

$html = ob_get_clean();

$dompdf->loadHtml(utf8_decode($html));

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');


use Dompdf\Options;

$options = new Options();
$options->set(array("isRemoteEnabled"=>true));

$dompdf->setOptions($options);



// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('Listado.pdf',array("Attachment"=>false));


// FIN RENDER
?>
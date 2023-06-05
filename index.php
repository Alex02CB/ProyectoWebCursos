 <?php include('./inc/conexion.php');?>
 <?php include('function.php');?> 
 <?php include('./header.php');?>
<main id="index">
    <section id="banner">

        <h1>Cursos Online</h1>
        <h2>Html5 - CSS - PHP - MySql - JavaScript - Wordpress - Prestashop</h2>
        
        <a href="cursos.php">Mas información</a>

    </section>
    
    <section id="plataforma">
        <div class="bienvenido">
            <h4>Bienvenido a la plataforma E-Web</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat, voluptatibus! Sit, doloribus qui! Ratione tenetur suscipit ipsam minima corrupti aut fuga delectus magni.</p>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <img src="img/icon_1.png" alt="">
                    <h3>Expertos</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
                <div class="col-md-3">
                    <img src="img/icon_2.png" alt="">
                    <h3>Recursos</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
                <div class="col-md-3">
                    <img src="img/icon_3.png" alt="">
                    <h3>Cursos</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
                <div class="col-md-3">
                    <img src="img/icon_4.png" alt="">
                    <h3>Premios</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="cursos">

        <div class="container">

            <h2>Cursos Online</h2>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Maiores perspiciatis suscipit qui quibusdam, molestiae inventore? Donec vel gavidra venterum. Vestibulum feiugat, sapiens ultrices. Maiores perspiciatis suscipit qui quibusdam, molestiae inventore?</p>
            <div class="row">
                <?php foreach($resultados as $fila) { ?>
                <div class="col-md-4">
                    <div class="sombra">
                        <img src="img/<?php echo $fila['imagenCurso']?>" alt="<?= $fila ['seoCurso'] ?>">
                        <h3><?php echo$fila['nombreCurso']?></h3>
                        <h4><?php echo $fila['nombreProfesor']?></h4>
                        <time><?php echo date("d-m-y", strtotime($fila['fecha']))?></time>
                        <p><?php echo extraer($fila['textoCurso'],20).'...'?> 
                        <div>
                            <!-- Cuando ponemos ? seguido de idCurso estamos creando una variable en la cual estamos almacenando la id del curso -->
                            <a href="detalleCurso.php?idCurso=<?= $fila['idCurso']?>" class="btn btn-primary mt-4">+ Info</a>
                        </div>
                        </p>
                        <hr>
                        <div class="estudent"><i class="bi bi-mortarboard-fill"></i><span><?php echo $fila['alumnosCurso']?></span><span><?php echo $fila['precio']?></span></div>
                    </div>
                </div>
                <?php } ?>
            </div>
           
        </div>

        <a href="">Ver todos los cursos</a>

    </section>

    <section id="noticias" class="container">
        <h3>Noticias</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae necessitatibus voluptate alias quisquam id. Ipsam dolorem nobis ullam maiores a. Nostrum accusantium perferendis perspiciatis omnis obcaecati facere quisquam ipsam ut.</p>
        <div class="row">
            <div class="col-md-4">
                <img src="" alt="">
                <div class="news">
                    <time>21Feb</time>
                    <div>
                        <h4>Insercion laboral</h4>
                        <i class="icon"></i>
                        <time>15:00 - 18:00</time>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum praesentium minus, voluptatem amet similique cupiditate voluptatibus quis repellat voluptates eaque ex error consequatur obcaecati cumque quo sit. Eius, ipsum est?</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <img src="" alt="">
                <div class="news">
                    <time>21Feb</time>
                    <div>
                        <h4>Insercion laboral</h4>
                        <i class="icon"></i>
                        <time>15:00 - 18:00</time>
                        <p>Neque, sapiente illo doloremque esse magnam eveniet ullam corrupti, minima aspernatur fuga asperiores vero odio maiores placeat quia! Et autem neque itaque quia suscipit nisi. Dolore ut aspernatur dignissimos temporibus.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <img src="" alt="">
                <div class="news">
                    <time>21Feb</time>
                    <div>
                        <h4>Insercion laboral</h4>
                        <i class="icon"></i>
                        <time>15:00 - 18:00</time>
                        <p>Deleniti quam sapiente repellat eos optio temporibus dicta maiores dignissimos autem molestiae. Doloremque atque hic esse ipsum, sit temporibus saepe totam. Tempora voluptas eligendi porro illum tempore obcaecati sit! Quis?</p>
                    </div>
                </div>
            </div>
        </div>
        <a href="">suscribir</a>
    </section>
</main>

<?php include_once ('footer.php')?>
<script src="bootstrap/js/bootstrap.min.js"></script>  
</body>
</html>  
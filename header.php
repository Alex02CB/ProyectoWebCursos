<?php 

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Práctica Sass - Php</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="scss/estilo.scss">
    <link rel="stylesheet" href="css/estilo.css">
    <script src="js/script.js"></script>
</head>
<body>
    
<header id="header">
    <div class="navTop">
        <div class="container">
            <div>
                <p>¿Tienes alguna pregunta?</p>
            </div>
    
            <div>
                <i class="bi bi-telephone-fill"></i>
                <a href="tel:958453213">958 453 213</a>
            </div>
    
            <div>
                <i class="bi bi-envelope"></i>
                <a href="contacto.php">info@escuelaartegranada.com</a>
            </div>
    
            <div>
                <a href="login.php">
                    <i class="bi bi-person-fill"></i>
                </a>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg container">

        <div class="container">

          <a class="navbar-brand" href="index.php">
            E-<span>Web</span>
          </a>

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

            <?php include('modal.php');?>

          <div class="collapse navbar-collapse" id="menu">

            <div class="navbar-nav ms-auto">
                <a class="nav-link" aria-current="page" href="#">Home</a>
                <a class="nav-link" href="#">Escuela</a>
                <a class="nav-link" href="#">Cursos</a>
                <a class="nav-link" href="#">Blog</a>
                <a class="nav-link" href="#">Contacto</a>
                <button class="buscar" data-bs-toggle="modal" data-bs-target="#buscar" >
                    <!-- <input type="search"> -->
                    <i class="bi bi-search"></i>
            </button>
            </div>
          </div>
        </div>
      </nav>
</header>

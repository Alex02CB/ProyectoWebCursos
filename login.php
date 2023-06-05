<?php

$login = "";
$pass = "";

if($_POST){
    $login = $_POST['usuario'];
    $pass = $_POST['password'];

}


if($login == "admin" && $pass == "admin"){
    header("Location:admin.php");
}else{
    ?>
    <?php include_once ('./header.php');?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form action="#" method="POST">
                <input type="text" class="form-control my-2" name="usuario" placeholder="Usuario" required>
                <input type="password" class="form-control my-2" name="password" placeholder="Contraseña" required>
                <input type="submit" value="enviar" class="btn btn-primary my-2">
            </form>
        </div>
    </div>
</div>

<?php }?>
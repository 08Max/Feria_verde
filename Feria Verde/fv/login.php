<?php

$user = $_POST['user'];
$pass = $_POST['pass'];

if (isset($user)&&isset($pass)) {

    require('bd.php');

    session_start();

    $consulta = mysqli_query($conexion,"select * from feriante where user='$user' AND pass='$pass'")or die (mysqli_error());
    $fila=mysqli_fetch_assoc($consulta);

      if(!$fila['id']){
        header("location:index.php");
      }else{
          $_SESSION['id_feriante'] = $fila['id'];
          $_SESSION['user'] = $fila['user'];

          //acceso administrador-tabla feriante/admin/1
          $var = $fila['admin'];
          if ($var==1) {
            $_SESSION['admin'] = $fila['admin'];
            header("location:administrador.php"); 
          //acceso al feriante para iniciar sesion-tabla feriante/vista/1
          } else {
            $var2 = $fila['vista'];
            if ($var2==0) {                     //feriante activo - tiene acceso para iniciar sesion
              header("location:feriante.php");
            } else {                            //feriante inactivo - no tiene acceso para iniciar sesion
               header("location:index.php");
            }
            
          }      
      }

} else {
    header("location:index.php");
}


?>


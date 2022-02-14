<?php   
require('bd.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Contacto | FeriaVerde</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="estilos.css" rel="stylesheet">
    <link href="social/css/social.css" rel="stylesheet">
    <link href="social/css/font.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="header.js"></script>

</head>

<body class="body_contacto">
<div class="HEADER">
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <h7 class="text-logo"><img src="img/logo.jpg" class="img-logo"> FeriaVerde</h7>
          <br>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
         
          <ul class="nav5 navbar-nav5">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="acercade.php">Acerca de</a></li>
            <li class="active"><a>Contacto</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right align-nav6">
              <li><a class="btn btn-lg" role="button" href="https://www.facebook.com/profile.php?id=100009164895357&fref=ts" target="_blank"><span class="fa fa-facebook"></span></a></li>
              <li><a class="btn" role="button" href="#VENTANA1" data-toggle="modal"><samp class="glyphicon glyphicon-user"></samp> INICIAR SESIÓN</a></li>
          </ul>         
        </div> 
      </div>
    </nav>
  </div>  

  <!--VENTANA INICIAR SESION-->  
    <div class="modal fade" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="VENTANA1" >
      <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header"><!--Encabezado-->  
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title text-center title3" id="myModalLabel">Iniciar sesión</h4>
            </div><!--/Encabezado--> 
            <div class="modal-body" ><!--Contenido-->
              <div class="login-form">
                  <form action="login.php" method="post" >
                     <div class="form-group">
                    <label>Nombre de usuario:</label> 
                    <input type="text" name="user" class="form-control" required="" >
                    </div>
                    <div class="form-group">
                    <label>Contraseña:</label>
                    <input type="password" name="pass" class="form-control" required="" >
                    </div> 
                    <div class="form-group">
                    <button class="btn btn-success btn-lg btn-block" type="submit">Ingresar</button>
                    </div>
                  </form>
              </div>
            </div><!--/Contenido-->
          </div>
      </div>
    </div>
  <!--/VENTANA INICIAR SESION--> 
 


	<!-- alertas -->
	<?php
		$a = (isset($_GET['a']) ? $_GET['a'] : null);

		if ($a != null){
			if ($a == 1){
				echo
					"<div class='alert alert-success alert-dismissible fade in' role='alert'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
							<span aria-hidden='true'>&times;</span>
						</button>
						<strong>¡Gracias!</strong> El mensaje fue enviado con éxito.
					</div>"
				;
			}else{
				if ($a == 2){
					echo
						"<div class='alert alert-danger alert-dismissible fade in' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
								<span aria-hidden='true'>&times;</span>
							</button>
							<strong>¡Atención!</strong> Ocurrió un error al intentar enviar el mensaje.
						</div>"
					;
				}
			}
		}
	?>
	<!-- /alertas -->

		<div class="container">
			<div class="col-sm-12">
			<h2 class="title3">Enviar un e-mail:</h2>
				<form action="contacto2.php" method="POST">
					<div class="form-group">
						<label for="nombre" class="title1">Nombre:</label>
						<input type="text" class="form-control" id="nombre" name="nombre" required="" />
					</div>
					<div class="form-group">
						<label for="email" class="title1">E-mail:</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="ejemplo@hotmail.com" required="" />
					</div>
					<div class="form-group">
						<label for="asunto" class="title1">Asunto:</label>
						<input type="text" class="form-control" id="asunto" name="asunto" required="" />
					</div>
					<div class="form-group">
						<label for="mensaje" class="title1">Mensaje:</label>
						<textarea class="form-control" rows="3" id="mensaje" name="mensaje" required="" ></textarea>
					</div>
					<button type="submit" class="btn btn-primary">Enviar</button>
				</form>
			</div>
		</div>
		<br>

	<!--Pie de pagina-->
    <div class="info-footer">
      <div class="container-fluid">
          <div class="col-sm-6">
             <p>
              <?php 
                   $cod_adm=1;
                   $res = mysqli_query($conexion,"select * from feriante where admin = $cod_adm");
              while ($fila_adm=mysqli_fetch_assoc($res)) { 
              ?>  
              <br> 
                <h4>Cominicate con el administrador:</h4>
                <strong>Nombre y Apellido: </strong><?php echo $fila_adm['nombre']." ".$fila_adm['apellido']; ?><br>
                <strong>Teléfono: </strong><?php echo $fila_adm['telefono']; ?><br>
                <strong>Dirección: </strong><?php echo $fila_adm['direccion']; ?><br>
                <strong>Localidad: </strong><?php echo $fila_adm['localidad']; ?><br>
                <strong>E-mail: </strong><?php echo $fila_adm['email']; ?><br>
                <strong>Enviar mensaje: </strong><ins><a class="link_contacto" href="contacto.php">Contacto</a></ins>
              <?php  } ?> 
             </p>
             <h2><img src="img/logo.jpg" width="60"> FeriaVerde</h2>
             <br><br>
          </div>

          <div class="col-sm-6">
            
            <div class="text-center">
            <br>  
            <a class="btn btn-social btn-facebook btn-lg" href="https://www.facebook.com/profile.php?id=100009164895357&fref=ts" target="_blank">
              <span class="fa fa-facebook"></span> Facebook
            </a>
            </div>
              <div>
                <br>
                <br>
                <p>
                  <br>
                </p>
              </div> 
          </div>
        </div>  
    </div>
    
    <div class="footer">
        <div  class="container-fluid">
          <div class="text-center">
            <h6>© 2016 Feria verde. Todos los derechos reservados. Creadores del sitio: <a class="btn btn-facebook btn-xs" role="button" href="" target="_blank"><span class="fa fa-facebook"></span> Facebook</a></h6>
          </div>  
        </div>  
    </div> 
<!--/Pie de pagina-->

</body>
</html>

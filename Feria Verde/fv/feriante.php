<?php
	session_start();

	if (!$_SESSION) {
		header("location:index.php?e=2");
	}

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Feriante | FeriaVerde</title>
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

<body class="body_feriante">
	<div class="container">
		<div class="row">
			<div class="text-center">
				<h1>Bienvenido feriante: <?php echo $_SESSION['user']; ?></h1>
			</div>
		</div>
		<div class="row">
			<div class="text-center">
				<div class="form-group">
					<a class="btn btn-info btn-lg" href="productos.php" ><img src="img/carro.png" width="70"> Mis productos</a>
				</div>
				<div class="form-group">	
					<a class="btn btn-success btn-lg" href="modificar_perfil.php"><img src="img/perfil.png" width="70"> Mi perfil</a>
				</div>
				<div class="form-group">	
					<a class="btn btn-danger btn-lg" href="cerrarsesion.php"><img src="img/cerrar.png" width="70"> Cerrar sesion</a>
				</div>	
			</div>
		</div>
	</div>


</body>
</html>

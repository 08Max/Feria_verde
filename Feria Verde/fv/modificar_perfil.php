<?php
	session_start();

	if (!$_SESSION) {
		header("location:index.php?e=2");
	}

	require('bd.php');

	if (isset($_POST['boton'])) {
		mysqli_query($conexion, "UPDATE feriante SET nombre='$_POST[nombre]' WHERE id='$_POST[id]'") or die("No se pudo realizar la conexion".mysqli_error($conexion));

		mysqli_query($conexion, "UPDATE feriante SET apellido='$_POST[apellido]' WHERE id='$_POST[id]'") or	die("No se pudo realizar la conexion".mysqli_error($conexion));

		mysqli_query($conexion, "UPDATE feriante SET telefono='$_POST[tel]'	WHERE id='$_POST[id]'") or die("No se pudo realizar la conexion".mysqli_error($conexion));

		mysqli_query($conexion, "UPDATE feriante SET direccion='$_POST[direccion]' WHERE id='$_POST[id]'") or die("No se pudo realizar la conexion".mysqli_error($conexion));

		mysqli_query($conexion, "UPDATE feriante SET localidad='$_POST[localidad]' WHERE id='$_POST[id]'") or die("No se pudo realizar la conexion".mysqli_error($conexion));

		mysqli_query($conexion, "UPDATE feriante SET user='$_POST[user]' WHERE id='$_POST[id]'") or	die("No se pudo realizar la conexion".mysqli_error($conexion));

		mysqli_query($conexion, "UPDATE feriante SET pass='$_POST[pass]' WHERE id='$_POST[id]'") or	die("No se pudo realizar la conexion".mysqli_error($conexion));

		mysqli_query($conexion, "UPDATE feriante SET email='$_POST[email]' WHERE id='$_POST[id]'") or die("No se pudo realizar la conexion".mysqli_error($conexion));

		header("location:modificar_perfil.php?m=1");
	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Modificar Perfil | Feria Verde</title>
	<meta charset="utf-8,ISO-8859-1">
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

<body class="modificar_perfil">
	<div class="container">
		<div class="row">
			<br>
			<div class="col-lg-10 col-lg-offset-2 col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-2">
				<?php
					@$admin = $_SESSION['admin'];
					if ($admin==1) { ?>
						<a class="btn btn-primary" href="administrador.php" role="button"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Volver</a>
					<?php }else{ ?>
						<a class="btn btn-primary" href="feriante.php" role="button"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Volver</a>
					<?php }
				?>
				<?php 
					$id= $_SESSION['id_feriante'];
					$sql= "SELECT * FROM feriante WHERE id = $id";
					$res= mysqli_query($conexion,$sql);
					$fila=mysqli_fetch_assoc($res);
				?>
			</div>
		</div>

		<!-- alertas -->
		<?php
			$m = (isset($_GET['m']) ? $_GET['m'] : null);

			if ($m != null){
				if ($m == 1){ ?>
					<div class="row">
						<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
							<div class="alert alert-success alert-dismissible fade in" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<strong>¡Correcto!</strong> Los datos fueron modificado con éxito.
							</div>
						</div>
					</div>
				<?php }
			}
		?>
		<!-- /alertas -->

		<div class="col-lg-10 col-lg-offset-2 col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-2">
			<h3>MODIFICAR INFORMACIÓN</h3>
		</div>
		<form action="" class="form-horizontal" method="POST">
			<div class="form-group">
				<label for="nombre" class="control-label col-lg-2 col-md-2 col-sm-2">Nombre</label>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<input class="form-control" type="text" name="nombre" value="<?php echo $fila['nombre'] ?>" required/>
				</div>
			</div>
			<div class="form-group">
				<label for="apellido" class="control-label col-lg-2 col-md-2 col-sm-2">Apellido</label>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<input class="form-control" type="text" name="apellido" value="<?php echo $fila['apellido'] ?>" required/>
				</div>
			</div>
			<div class="form-group">
				<label for="tel" class="control-label col-lg-2 col-md-2 col-sm-2">Telefono</label>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<input class="form-control" type="tel" name="tel" value="<?php echo $fila['telefono'] ?>" required/>
				</div>
			</div>
			<div class="form-group">
				<label for="direccion" class="control-label col-lg-2 col-md-2 col-sm-2">Dirección</label>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<input class="form-control" type="text" name="direccion" value="<?php echo $fila['direccion'] ?>" required/>
				</div>
			</div>
			<div class="form-group">
				<label for="localidad" class="control-label col-lg-2 col-md-2 col-sm-2">Localidad</label>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<input class="form-control" type="text" name="localidad" value="<?php echo $fila['localidad'] ?>" required/>
				</div>
			</div>
			<div class="form-group">
				<label for="user" class="control-label col-lg-2 col-md-2 col-sm-2">Nombre de usuario</label>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<input class="form-control" type="text" name="user" value="<?php echo $fila['user'] ?>" required/>
				</div>
			</div>
			<div class="form-group">
				<label for="pass" class="control-label col-lg-2 col-md-2 col-sm-2">Contraseña</label>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<input class="form-control" type="password" name="pass" value="<?php echo $fila['pass'] ?>" required/>
				</div>
			</div>
			<div class="form-group">
				<label for="email" class="control-label col-lg-2 col-md-2 col-sm-2">Correo</label>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<input class="form-control" type="email" name="email" value="<?php echo $fila['email'] ?>"/>
				</div>
			</div>
			<div class="form-group">   
				<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
					<input type="hidden" name="id" value="<?php echo $fila['id'] ?>"/>
					<input class="btn btn-success" type="submit" value="Modificar" name="boton"/>
				</div>
			</div>
		</form>
	</div>

</body>
</html>



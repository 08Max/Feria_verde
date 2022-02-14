<?php
	session_start();

	if (!$_SESSION) {
		header("location:index.php?e=2");
	}

	$id_feriante = $_SESSION['id_feriante'];

	require('bd.php');

	$formatos = array('.jpg', '.png');

	if (isset($_POST['boton'])) {
		//subir imagen a una carpeta:
		$nombreArchivo = $_FILES['archivo']['name'];
		$nombreTmpArchivo = $_FILES['archivo']['tmp_name'];
		$ext = substr($nombreArchivo, strrpos($nombreArchivo, '.'));
		if (in_array($ext, $formatos)) {
			if (move_uploaded_file($nombreTmpArchivo, "img/productos/$nombreArchivo")) {
				//subir todo el formulario a la BD
				mysqli_query($conexion, "INSERT INTO producto (nombre, detalle, imagen, id_feriante, id_categoria, vista) VALUES ('$_POST[nombre]', '$_POST[detalle]', '$nombreArchivo', '$_POST[id]', '$_POST[id_categoria]', 0)")or die("No se pudo realizar la conexion".mysqli_error($conexion));
				mysqli_close($conexion);

				header("location:productos.php?p=1");
			}else{ ?>
				<div class="row">
					<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
						<div class="alert alert-warning alert-dismissible fade in" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<strong>¡Atención!</strong> Ocurrió un error al intentar agregar un producto.
						</div>
					</div>
				</div>
			<?php }
		}else{ ?>
			<div class="row">
				<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
					<div class="alert alert-warning alert-dismissible fade in" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<strong>¡Atención!</strong> Archivo de imagen no permitido. Intente con una imagen distinta.
					</div>
				</div>
			</div>
		<?php }
	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Agregar Producto | Feria Verde</title>
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

<body class="body_prod_agregar">
	<div class="container">
		<div class="row">
			<br>
			<div class="col-lg-10 col-lg-offset-2 col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-2">
				<a class="btn btn-primary" href="productos.php" role="button"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Volver</a>
			</div>
		</div>
		<div class="col-lg-10 col-lg-offset-2 col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-2">
			<h3>AGREGAR UN PRODUCTO</h3>
		</div>
		<form action="" class="form-horizontal" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="nombre" class="control-label col-lg-2 col-md-2 col-sm-2">Nombre</label>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<input class="form-control" type="text" name="nombre" required/>
				</div>
			</div>
			<div class="form-group">
				<label for="detalle" class="control-label col-lg-2 col-md-2 col-sm-2">Detalle</label>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<textarea class="form-control" rows="5" cols="80" name="detalle" required></textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="archivo" class="control-label col-lg-2 col-md-2 col-sm-2">Selecciona una imagen</label>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<input class="form-control" type="file" name="archivo" required/>
				</div>
			</div>
			<div class="form-group">
				<label for="id_categoria" class="control-label col-lg-2 col-md-2 col-sm-2">Selecciona una Categoria</label>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<select class="form-control" name="id_categoria" required>
						<option value="" selected="selected">Seleccionar</option>
						<?php
							$sql = "SELECT * FROM categoria ORDER BY nombre";
							$result = mysqli_query($conexion,$sql);
							while ($fila = mysqli_fetch_assoc($result)) { 
						?>
						<option value="<?php echo $fila['id']; ?>"><?php echo $fila['nombre']; ?></option>
						<?php  } ?> <!-- cierra el while -->
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
					<input type="hidden" name="id" value="<?php echo $id_feriante; ?>"/>
					<input class="btn btn-success" type="submit" value="Agregar" name="boton"/>
				</div>
			</div>
		</form>
	</div>

</body>
</html>

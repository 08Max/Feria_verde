<?php
session_start();

if (!$_SESSION) {
	header("location:index.php?e=2");
}

require('bd.php');
	$id_prod = $_GET['cod'];
	$sql = "SELECT * FROM producto WHERE id = $id_prod";
	$res= mysqli_query($conexion,$sql);
	$fila= mysqli_fetch_assoc($res);

if (isset($_POST['boton'])) {

			//subir imagen nueva a una carpeta:
			$formatos = array('.jpg', '.png');
			$nombreArchivo = $_FILES['archivo']['name'];
			$nombreTmpArchivo = $_FILES['archivo']['tmp_name'];
			$ext = substr($nombreArchivo, strrpos($nombreArchivo, '.'));
			if ($nombreArchivo !="") {
				if (in_array($ext, $formatos)) { 
					if (move_uploaded_file($nombreTmpArchivo, "img/productos/$nombreArchivo")) { 
								//borrar imagen que se reemplazo por otra de la carpeta 
								$res=mysqli_query($conexion, "SELECT imagen FROM producto WHERE id=$id_prod") or die("No se pudo realizar la conexion".mysqli_error($conexion));
					            $fila=mysqli_fetch_assoc($res);
					          	$imagen = $fila['imagen'];
								array_map('unlink', glob("img/productos/$imagen")); 
					}
				}

				//modificar registro en la tabla producto de la BD
						mysqli_query($conexion, "UPDATE producto SET imagen='$nombreArchivo' WHERE id='$_POST[id]'") or die("No se pudo realizar la conexion".mysqli_error($conexion)); 
			}		

				//modificar registro en la tabla producto de la BD, sin modif imagen
				mysqli_query($conexion, "UPDATE producto SET nombre='$_POST[nombre]' WHERE id='$_POST[id]'") or die("No se pudo realizar la conexion".mysqli_error($conexion));

				mysqli_query($conexion, "UPDATE producto SET detalle='$_POST[detalle]' WHERE id='$_POST[id]'") or die("No se pudo realizar la conexion".mysqli_error($conexion));	

				mysqli_query($conexion, "UPDATE producto SET id_categoria='$_POST[id_categ]' WHERE id='$_POST[id]'") or die("No se pudo realizar la conexion".mysqli_error($conexion));

				header("location:productos.php");
}


?>
<html lang="es">
<head>
	<title>Modificar Producto | Feria Verde</title>
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

<body class="body_prod_modificar">

	<div class="container">
		<div class="row">
			<br>
			<div class="col-lg-10 col-lg-offset-2 col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-2">
				<a class="btn btn-primary" href="productos.php" role="button"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Volver</a>
			</div>
		</div>
		<div class="col-lg-10 col-lg-offset-2 col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-2">
			<h3>MODIFICAR DATOS DEL PRODUCTO</h3>
		</div>
		<form action="" class="form-horizontal" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="nombre" class="control-label col-lg-2 col-md-2 col-sm-2">Nombre</label>
				<div class="col-lg-8 col-md-8 col-sm-8">		
					<input class="form-control" type="text" name="nombre" value="<?php echo $fila['nombre']; ?>" required/>
				</div>
			</div>
			<div class="form-group">
				<label for="nombre" class="control-label col-lg-2 col-md-2 col-sm-2">Detalle</label>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<textarea class="form-control" rows="5" cols="80" name="detalle" required><?php echo $fila['detalle']; ?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="archivo" class="control-label col-lg-2 col-md-2 col-sm-2">Imagen</label>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<input class="form-control" type="file" name="archivo"/>
					<p class="text-warning">
					<?php 
						if ($fila['imagen']!="") {
							echo "Nombre de la imagen:".$fila['imagen'];
						} else {
							echo "No exite imagen";
						}
		
					 ?>
					 </p>
				</div>
			</div>
			<div class="form-group">
				<label for="id_categoria" class="control-label col-lg-2 col-md-2 col-sm-2">Categoria</label>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<select class="form-control" name="id_categ" required>
						<?php
							$sql = "SELECT * FROM categoria ORDER BY nombre";
							$res = mysqli_query($conexion,$sql);
							while ($fila2=mysqli_fetch_assoc($res)) {

										if($fila2['id']==$fila['id_categoria']) { ?>
											<option value="<?php echo $fila2['id']; ?>" selected="selected"><?php echo $fila2['nombre']; ?></option>
								<?php	} else { ?>
											<option value="<?php echo $fila2['id']; ?>"><?php echo $fila2['nombre']; ?></option>
								<?php	}

							} ?><!-- cierra el while -->
					</select>
				</div>
			</div>
			<div class="form-group">   
				<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
					<input type="hidden" name="id" value="<?php echo $fila['id']; ?>"/>
					<input class="btn btn-success" type="submit" value="Modificar" name="boton"/>
				</div>
			</div>
		</form>
	</div>

</body>
</html>

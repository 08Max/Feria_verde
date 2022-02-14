<?php
	session_start();

	if (!$_SESSION) {
		header("location:index.php?e=2");
	}

	require('bd.php');

	@$id_feriante = $_SESSION['id_feriante'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Productos | FeriaVerde</title>
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

<body class="body_productos">
	<div class="container">
		<div class="row">
			<br>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<a class="btn btn-primary" href="feriante.php" role="button"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Volver</a>
			</div>
			<div class="col-lg-3 col-lg-offset-3 col-md-3 col-md-offset-3 col-sm-3 col-sm-offset-3 col-xs-3 col-xs-offset-3">
				<a class="btn btn-success" href="prod_agregar.php" role="button"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Agregar un producto</a>
			</div>
		</div>
		<!-- alertas -->
		<?php
			$p = (isset($_GET['p']) ? $_GET['p'] : null);

			if ($p != null){
				if ($p == 1){ ?>
					<div class="row">
						<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
							<div class="alert alert-success alert-dismissible fade in" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								Un nuevo producto fue registrado con exito.
							</div>
						</div>
					</div>
				<?php }else{
					if ($p == 2){ ?>
						<div class="row">
							<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
								<div class="alert alert-success alert-dismissible fade in" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<strong>El producto fue modificado con exito.
								</div>
							</div>
						</div>
					<?php }else{
						if ($p == 3){ ?>
							<div class="row">
								<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
									<div class="alert alert-info alert-dismissible fade in" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										<strong>El estado de un producto ha cambiado con exito.
									</div>
								</div>
							</div>
						<?php }else{
							if ($p == 4){ ?>
								<div class="row">
									<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
										<div class="alert alert-success alert-dismissible fade in" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											El producto fue eliminado con exito.
										</div>
									</div>
								</div>
							<?php }else{
								if ($p == 5){ ?>
									<div class="row">
										<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
											<div class="alert alert-danger alert-dismissible fade in" role="alert">
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
												<strong>¡Error!</strong> No se pudo eliminar el producto vulve a intentar.
											</div>
										</div>
									</div>
								<?php }
							}
						}
					}
				}
			}
		?>
		<!-- /alertas -->
		<div class="row">
			<h3>PRODUCTOS ACTIVOS:</h3>
			<table class="table table-bordered table-responsive">
				<tr class="success">
					<td>NOMBRE</td>
					<td>DETALLE</td>
					<td>IMAGEN</td>
					<td>CATEGORIA</td>
					<td>MODIFICAR</td>
					<td>VISTA</td>
					<td>ELIMINAR</td>
				</tr>
				<?php
					//selec y muestra todos los prod del feriante
					$vista=0;
					$consulta = mysqli_query($conexion,"SELECT * FROM producto WHERE id_feriante=$id_feriante and vista=$vista ORDER BY nombre");                
					while ($fila=mysqli_fetch_assoc($consulta)) { 
				?>
				<tr>
					<!--NOMBRE-->
					<td><h4 class="parrafo1"><?php echo $fila['nombre']; ?></h4></td>
					<!--DETALLE-->
					<td><p class="parrafo2"><tt><?php echo $fila['detalle']; ?></tt></p></td>
					<!--IMAGEN-->
					<td><img class="img" height=100 src="img/productos/<?php echo $fila['imagen']; ?>"/></td>
					<!--CATEGORIA-->
					<td>
						<?php
							$cod = $fila['id_categoria'];
							$sql = "SELECT nombre FROM categoria WHERE id = $cod";
							$res= mysqli_query($conexion,$sql);
							$fila2=mysqli_fetch_assoc($res);
						?>
						<p class="parrafo1"><?php echo $fila2['nombre']; ?></p>
					</td>
					<!--EDITAR-->
					<td>
						<a class="btn btn-primary" href="prod_modificar.php?cod=<?php echo $fila['id'];?>">
						<span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Modificar</a>
					</td>
					<!--DESACTIVAR-->
					<td>
						<a class="btn btn-warning" href="activ_prod.php?cod=<?php echo $fila['id'];?>&vista=1;">
						<span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span> Desactivar</a>
					</td>
					<!--ELIMINAR-->
					<td>
						<a class="btn btn-danger" href="#VENTANAx<?php echo $fila['id'];?>" data-toggle="modal"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Eliminar</a>
					</td>
					<!--VENTANA ELIMINAR PRODUCTO-->
					<div class="modal fade" id="VENTANAx<?php echo $fila['id']; ?>" tabindex="-1" role="dialog">
						<div class="modal-dialog modal-sm" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title">Eliminar producto</h4>
								</div>
								<div class="modal-body">
									<p>Esta acción NO puede deshacerse ¿desea <strong>eliminar</strong> el producto <strong><?php echo $fila['nombre']; ?></strong>?</p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-link" data-dismiss="modal">Cancelar</button>
									<a class="btn btn-primary" href="eliminar.php?cod=<?php echo $fila['id'];?>">Confirmar</a>
								</div>
							</div>
						</div>
					</div>
					<!--/VENTANA ELIMINAR PRODUCTO-->
				</tr>
				<?php  } ?> <!-- cierra el while -->
			</table>
		</div>
		<div class="row">
			<h3>PRODUCTOS INACTIVOS:</h3>
			<table class="table table-bordered">
				<tr class="success">
					<td>NOMBRE</td>
					<td>DETALLE</td>
					<td>IMAGEN</td>
					<td>CATEGORIA</td>
					<td>MODIFICAR</td>
					<td>VISTA</td>
					<td>ELIMINAR</td>  
				</tr>
				<?php
					$vista=1;
					$consulta = mysqli_query($conexion,"SELECT * FROM producto WHERE id_feriante=$id_feriante and vista=$vista ORDER BY nombre");                
					while ($fila=mysqli_fetch_assoc($consulta)) { 
				?>
				<tr>
					<!--NOMBRE-->
					<td><h4 class="parrafo1"><?php echo $fila['nombre']; ?></h4></td>
					<!--DETALLE-->
					<td><p class="parrafo2"><tt><?php echo $fila['detalle']; ?></tt></p></td>
					<!--IMAGEN-->
					<td><img class="img" height="100" src="img/productos/<?php echo $fila['imagen']; ?>"/></td>
					<!--CATEGORIA-->
					<td>
						<?php
							$cod = $fila['id_categoria'];
							$sql = "SELECT nombre FROM categoria WHERE id = $cod";
							$res= mysqli_query($conexion,$sql);
							$fila2=mysqli_fetch_assoc($res); 
						?>
						<p class="parrafo1"><?php echo $fila2['nombre']; ?></p>
					</td>
					<!--EDITAR-->
					<td>
						<a class="btn btn-default" href="prod_modificar.php?cod=<?php echo $fila['id'];?> ">
						<span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Modificar</a>
					</td>
					<!--ACTIVAR-->
					<td>
						<a class="btn btn-info" href="activ_prod.php?cod=<?php echo $fila['id'];?>&vista=0;">
						<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Activar</a>
					</td>
					<!--ELIMINAR-->
					<td>
						<a class="btn btn-danger" href="#VENTANAy<?php echo $fila['id'];?>" data-toggle="modal"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Eliminar</a>
					</td>
					<!--VENTANA ELIMINAR PRODUCTO-->
					<div class="modal fade" id="VENTANAy<?php echo $fila['id']; ?>" tabindex="-1" role="dialog">
						<div class="modal-dialog modal-sm" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title">Eliminar producto</h4>
								</div>
								<div class="modal-body">
									<p>Esta acción NO puede deshacerse ¿desea <strong>eliminar</strong> el producto <strong><?php echo $fila['nombre']; ?></strong>?</p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-link" data-dismiss="modal">Cancelar</button>
									<a class="btn btn-primary" href="eliminar.php?cod=<?php echo $fila['id'];?>">Confirmar</a>
								</div>
							</div>
						</div>
					</div>
					<!--/VENTANA ELIMINAR PRODUCTO-->
				</tr>
				<?php  } ?> <!-- cierra el while -->
			</table>
		</div>
	</div>

</body>
</html>

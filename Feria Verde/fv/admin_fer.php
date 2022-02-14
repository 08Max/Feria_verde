<?php
	session_start();

	if (!$_SESSION) {
		header("location:index.php?e=2");
	}

	require('bd.php');

	if (isset($_POST['boton'])) {
		$nombre=$_POST['nombre'];
		$apellido=$_POST['apellido'];
		$telefono=$_POST['telefono'];
		$direccion=$_POST['direccion'];
		$localidad=$_POST['localidad'];

		$email=$_POST['email'];
		$user=$_POST['user'];
		$pass=$_POST['pass'];

		//que el usuario no se pueda duplicar
		$consulta = "SELECT user FROM feriante WHERE user='$user'"; 
		$res = mysqli_query($conexion,$consulta); 
		$num = mysqli_num_rows($res); 
		if ($num > 0) {
			header("location:admin_fer.php?dup=1");
			//FIN que el usuario no se pueda duplicar
		}else{		
		//SINO SI EL USUARIO NO ESTA DUPLICADO ENTONCES

		$sql_insertar="INSERT INTO feriante SET  nombre='$nombre',apellido='$apellido',telefono='$telefono',direccion='$direccion',localidad='$localidad',user='$user',pass='$pass',email='$email'";
		mysqli_query($conexion,$sql_insertar)or die (mysql_error());

		header("location:admin_fer.php");	
	   }
	}
?>


<!DOCTYPE html>
<html lang="es">
<head>
	<title>Administrar Feriantes | Feria Verde</title>
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

<?php
//que el usuario no se pueda duplicar
//aca abre la ventana modal automaticamente de vuelta al recargar la pagina
@$dup=$_GET['dup'];
if ($dup==1) {
	echo "<script>
		$(document).ready(function(){ $('#VENTANA2').modal('show'); });
	</script>";
}
?>

</head>
<body>
	<div class="container">
		<div class="row">
			<br>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<a class="btn btn-primary" href="administrador.php" role="button"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Volver</a>
			</div>
			<div class="col-lg-3 col-lg-offset-3 col-md-3 col-md-offset-3 col-sm-3 col-sm-offset-3 col-xs-3 col-xs-offset-3">
				<a class="btn btn-success" href="#VENTANA2" data-toggle="modal"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Agregar un feriante</a>
			</div>
		</div>

		<!--VENTANA REGISTRAR FERIANTE-->
		<div class="modal" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="VENTANA2">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<!--Encabezado--> 
					<div class="modal-header"> 
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title t1" id="myModalLabel">Agregar un nuevo feriante</h4>
					</div> 
					<!--/Encabezado-->
					<!--Contenido-->
					<div class="signup-form">
						<form action="" method="post" autocomplete="off" class="t1">
							<div class="modal-body">
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label for="nombre">Nombre *</label>
											<input type="text" name="nombre" id="nombre" class="form-control" required/>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label for="apellido">Apellido *</label>
											<input type="text" name="apellido" id="apellido"  class="form-control" required/>	
										</div>
									</div>	
									<div class="col-sm-4">
										<div class="form-group">
											<label for="telefono">Telefono *</label>
											<input type="tel" name="telefono" id="telefono" class="form-control" required/>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label for="direccion">Direccion *</label>
											<input type="text" name="direccion" id="direccion" class="form-control" required/>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label for="localidad">Localidad *</label>
											<input type="text" name="localidad" id="localidad" class="form-control" required/>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label for="correo">Correo</label>
											<input type="email" name="email" id="correo" class="form-control"/>
										</div>	
									</div>
								</div>
								<div class="row">
									<div class="col-sm-4">
										<?php if ($dup==1) { ?>
											<div class="form-group has-warning ">
												<label class="control-label" for="usuario">Nombre de usuario *</label>
												<input type="text" name="user" id="usuario" class="form-control" autofocus required placeholder="Ya exite! ingresar otro" />
											</div>
										<?php } else { ?>
											<div class="form-group">
												<label class="control-label" for="usuario">Nombre de usuario *</label>
												<input type="text" name="user" id="usuario" class="form-control" required/>
											</div>	
										<?php } ?>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label for="contrasena">Contraseña *</label>
											<input type="password" name="pass" id="contrasena" class="form-control" required/>
										</div>	
									</div>
								</div>
							</div>
							<!--/Contenido-->
							<!--Pie-->
							<div class="modal-footer">
								<div class="row">
									<div class="col-sm-6">
										<button type="submit" class="btn btn-primary" name="boton">Agregar</button>
									</div>
									<div class="col-sm-6">
										<h5>(*) CAMPOS OBLIGATORIOS</h5>
									</div>
								</div>
							</div>
						</form><!--/FORMULARIO-->
					</div>
					<!--/Pie-->
				</div>
			</div>
		</div> 
		<!--/VENTANA REGISTRAR FERIANTE-->

		<!-- alertas -->
		<?php
			$f = (isset($_GET['f']) ? $_GET['f'] : null);

			if ($f != null){
				if ($f == 1){ ?>
					<div class="row">
						<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
							<div class="alert alert-info alert-dismissible fade in" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								El estado de un feriante ha cambiado con exito.
							</div>
						</div>
					</div>
				<?php }else{
					if ($f == 2){ ?>
						<div class="row">
							<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
								<div class="alert alert-success alert-dismissible fade in" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									El feriante fue eliminado con exito.
								</div>
							</div>
						</div>
					<?php }else{
						if ($f == 3){ ?>
							<div class="row">
								<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
									<div class="alert alert-danger alert-dismissible fade in" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										<strong>¡Error!</strong> No se pudo eliminar el feriante.
									</div>
								</div>
							</div>
						<?php }
					}
				}
			}
		?>
		<!-- /alertas -->

		<div class="row">
			<h2>FERIANTES CON ACCESO:</h2>
			<table class="table table-bordered table-responsive">
				<tr class="success">
					<td>NOMBRE</td>
					<td>APELLIDO</td>
					<td>TELEFONO</td>
					<td>DIRECCION</td>
					<td>LOCALIDAD</td>
					<td>USUARIO</td>
					<td>CONTRASEÑA</td>
					<td>CANT<BR>PROD</td>
					<td>PROD<BR>ACT</td>
					<td>PROD<BR>INACT</td>
					<td>EMAIL</td>
					<td>VISTA</td>
				</tr>
				<?php
					$vista=0;
					$consulta = mysqli_query($conexion,"SELECT * FROM feriante WHERE vista=$vista ORDER BY nombre, apellido");                
					while ($fila=mysqli_fetch_assoc($consulta)) { 
				?>
				<tr>
					<!--NOMBRE-->
					<td><p><?php echo $fila['nombre'];?></p></td>
					<!--APELLIDO-->
					<td><p><?php echo $fila['apellido'];?></p></td>
					<!--TEL-->
					<td><p><?php echo $fila['telefono'];?></p></td>
					<!--DIRECCION-->
					<td><p><?php echo $fila['direccion'];?></p></td>
					<!--LOCALIDAD-->
					<td><p><?php echo $fila['localidad'];?></p></td>
					<!--NOMBRE DE USUARIO-->
					<td><p><?php echo $fila['user'];?></p></td>
					<!--CONTRASEÑA-->
					<td><p><?php echo $fila['pass'];?></p></td>
					<!--CANTIDAD PROD-->
					<td><p class="text-center">
					<?php 
						$cod_fer=$fila['id'];
                   		$total_res = mysqli_query($conexion,"select * from producto where id_feriante = $cod_fer");
                   		$total_prod_fer = mysqli_num_rows($total_res);
                   		echo $total_prod_fer;
					?>	
					</p></td>
					<!--CANTIDAD PROD ACTIVOS-->
					<td><p class="text-center">
					<?php 
						$vista_activos=0;
						$cod_fer=$fila['id'];
                   		$total_res = mysqli_query($conexion,"select * from producto where id_feriante = $cod_fer and vista=$vista_activos");
                   		$total_prod_fer = mysqli_num_rows($total_res);
                   		echo $total_prod_fer;
					?>	
					</p></td>
					<!--CANTIDAD PROD INACTIVOS-->
					<td><p class="text-center">
					<?php 
						$vista_inactivos=1;
						$cod_fer=$fila['id'];
                   		$total_res = mysqli_query($conexion,"select * from producto where id_feriante = $cod_fer and vista=$vista_inactivos");
                   		$total_prod_fer = mysqli_num_rows($total_res);
                   		echo $total_prod_fer;
					?>	
					</p></td>										
					<!--EMAIL-->
					<td><p><?php echo $fila['email'];?></p></td>
					<!--EDITAR-->
					<td>
						<a class="btn btn-warning btn-sm" href="activ_fer.php?cod=<?php echo $fila['id'];?>&vista=1;"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Bloquear</a>
					</td>
				</tr>
				<?php  } ?> <!-- cierra el while -->
			</table>
		</div>

		<div class="row">
			<h2>FERIANTES SIN ACCESO:</h2>
			<table class="table table-bordered table-responsive">
				<tr class="success">
					<td>NOMBRE</td>
					<td>APELLIDO</td>
					<td>TELEFONO</td>
					<td>DIRECCION</td>
					<td>LOCALIDAD</td>
					<td>USUARIO</td>
					<td>CONTRASEÑA</td>
					<td>CANT<BR>PROD</td>
					<td>EMAIL</td>
					<td>VISTA</td>
					<td>ELIMINAR</td>
				</tr>
				<?php
					$vista=1;
					$consulta = mysqli_query($conexion,"SELECT * FROM feriante WHERE vista=$vista ORDER BY nombre, apellido");                
					while ($fila=mysqli_fetch_assoc($consulta)) { 
				?>  
				<tr>
					<!--NOMBRE-->
					<td><p><?php echo $fila['nombre'];?></p></td>
					<!--APELLIDO-->
					<td><p><?php echo $fila['apellido'];?></p></td>
					<!--TEL-->
					<td><p><?php echo $fila['telefono'];?></p></td>
					<!--DIRECCION-->
					<td><p><?php echo $fila['direccion'];?></p></td>
					<!--LOCALIDAD-->
					<td><p><?php echo $fila['localidad'];?></p></td>
					<!--NOMBRE DE USUARIO-->
					<td><p><?php echo $fila['user'];?></p></td>
					<!--CONTRASEÑA-->
					<td><p><?php echo $fila['pass'];?></p></td>
					<!--CANTIDAD PROD-->
					<td><p class="text-center">
					<?php 
						$cod_fer=$fila['id'];
                   		$total_res = mysqli_query($conexion,"select * from producto where id_feriante = $cod_fer");
                   		$total_prod_fer = mysqli_num_rows($total_res);
                   		echo $total_prod_fer;
					?>	
					</p></td>
					<!--EMAIL-->
					<td><p><?php echo $fila['email'];?></p></td>
					<!--EDITAR-->
					<td>
						<a class="btn btn-info btn-sm" href="activ_fer.php?cod=<?php echo $fila['id'];?>&vista=0;"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Desbloquear</a>
					</td>
					<td> 
						<a class="btn btn-danger btn-sm" href="#VENTANAx<?php echo $fila['id'];?>" data-toggle="modal"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Eliminar</a>
					</td>
					<!--VENTANA ELIMINAR FERIANTE-->
					<div class="modal fade" id="VENTANAx<?php echo $fila['id']; ?>" tabindex="-1" role="dialog">
						<div class="modal-dialog modal-sm" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title">Eliminar feriante</h4>
								</div>
								<div class="modal-body">
									<p>Esta acción NO puede deshacerse ¿desea <strong>eliminar</strong> al feriante <strong><?php echo $fila['user']; ?></strong>?</p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-link" data-dismiss="modal">Cancelar</button>
									<a class="btn btn-primary" href="eliminar.php?fer=<?php echo $fila['id'];?>">Confirmar</a>
								</div>
							</div>
						</div>
					</div>
					<!--/VENTANA ELIMINAR FERIANTE-->
				</tr>
				<?php  } ?> <!-- cierra el while -->
			</table>
		</div>
	</div>

</body>
</html>

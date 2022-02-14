<?php
	session_start();

	if (!$_SESSION) {
		header("location:index.php?e=2");
	}

	require('bd.php');

@$id_prod = $_GET['cod'];
@$id_fer = $_GET['fer'];

if (is_numeric($id_prod)){ //aca se va a eliminar el producto

		//selecciona el id del producto que se quiere eliminar en la tabla producto en la BD
		$registros=mysqli_query($conexion, "SELECT id FROM producto WHERE id=$id_prod") or die("No se pudo realizar la conexion".mysqli_error($conexion));
		if ($reg=mysqli_fetch_array($registros)){
			//aca se borra imagen de la carpeta del prod q se quiere eliminar
			$res=mysqli_query($conexion, "SELECT imagen FROM producto WHERE id=$id_prod") or die("No se pudo realizar la conexion".mysqli_error($conexion));
            $fila=mysqli_fetch_assoc($res);
          	$imagen = $fila['imagen'];
			array_map('unlink', glob("img/productos/$imagen")); 
			//se elimina el producto de la tabla productos en la BD
			mysqli_query($conexion,"DELETE FROM producto WHERE id=$id_prod") or	die("No se pudo realizar la conexion".mysqli_error($conexion));

			header("location:productos.php?p=4");
		}else{
			header("location:productos.php?p=5");
		}
		mysqli_close($conexion);

}elseif (is_numeric($id_fer)){ //y aca se va a eliminar el feriante con sus productos de la BD. TAMBN SE DEBEN ELIMINAR LAS IMAGENES DE ESE PRODUCTO

		$registros=mysqli_query($conexion, "SELECT id FROM feriante WHERE id=$id_fer") or die("No se pudo realizar la conexion".mysqli_error($conexion));
		if ($reg=mysqli_fetch_array($registros)){

			//Primero elimina las imagenes de todos los productos del feriante eliminado	
			$consulta = mysqli_query($conexion,"select imagen from producto where id_feriante = $id_fer");	
            while ($fila=mysqli_fetch_assoc($consulta)) {  
          		$imagen = $fila['imagen'];
				array_map('unlink', glob("img/productos/$imagen"));
			}

			//luego elimina en la BD el feriante y sus productos
			mysqli_query($conexion,"DELETE FROM feriante WHERE id=$id_fer") or die("No se pudo realizar la conexion".mysqli_error($conexion));
			mysqli_query($conexion,"DELETE FROM producto WHERE id_feriante=$id_fer") or die("No se pudo realizar la conexion".mysqli_error($conexion));


			header("location:admin_fer.php?f=2");
		}else{
			header("location:admin_fer.php?f=3");
		}
		mysqli_close($conexion);

}



?>


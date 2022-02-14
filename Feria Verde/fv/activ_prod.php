<?php
	session_start();

	if (!$_SESSION) {
		header("location:index.php?e=2");
	}

	$id_prod = $_GET['cod'];
	$vista = $_GET['vista'];

	require('bd.php');

	mysqli_query($conexion, "UPDATE producto SET vista='$vista' WHERE id='$id_prod'") or die("No se pudo realizar la conexion".mysqli_error($conexion));

	header("location:productos.php?p=3");
?>

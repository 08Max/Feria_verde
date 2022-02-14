<?php
	session_start();

	if (!$_SESSION) {
		header("location:index.php?e=2");
	}

	@$id_fer = $_GET['cod'];
	@$vista = $_GET['vista'];

	require('bd.php');

	mysqli_query($conexion, "UPDATE feriante SET vista='$vista' WHERE id='$id_fer'") or die("No se pudo realizar la conexion".mysqli_error($conexion));

	if ($vista==1) {
		mysqli_query($conexion, "UPDATE producto SET vista='$vista' WHERE id_feriante='$id_fer'") or die("No se pudo realizar la conexion".mysqli_error($conexion));
	}

	header("location:admin_fer.php?f=1");
?>

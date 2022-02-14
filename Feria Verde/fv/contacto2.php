<?php
	$para = "danitmp5@gmail.com";
	$nombre = $_POST['nombre'];
	$asunto = "Feria Verde - Asunto: " . $_POST['asunto'];
	$mensaje = $_POST['mensaje'];
	$de = $_POST['email'];

	$header = "MIME-Version:1.0;\r\n";
	$header .= "Content-type: text/html; \r\n charset=UTF-8" . "\r\n";
	$header .= "From: " . $de . "\r\n";
	$header .= "To: " . $para . "\r\n Subject: " . $asunto . "\r\n";

	$enviado = mail($para, $asunto, $mensaje, $header);

	if($enviado == true){
		header("location:contacto.php?a=1");
	}else{
		header("location:contacto.php?a=2");
	}
?>





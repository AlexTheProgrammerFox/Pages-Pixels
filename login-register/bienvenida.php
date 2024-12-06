<?php

  session_start();
  if (!isset($_SESSION['usuario'])) {

  	echo '
  	    <script>
  	          alert("Por favor debes iniciar sesion");
  	          window.location = "Sesion.php";
  	    </script>      


  	';
  	//header("Location: Sesion.php");
  	session_destroy();
  	die();
  }

  session_destroy();

?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Galeria</title>
	<script src="bienvenida.js"></script>
	<link rel="stylesheet" href="bienvenida.js">
</head>
<body>
	 <h2 id="bienvenidaMensaje"></h2>

	
	<a href="php/cerrar_sesion.php">Cerrar Sesion</a>

</body>
</html>
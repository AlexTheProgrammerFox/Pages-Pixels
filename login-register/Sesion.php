<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .fondo-color {
            background-color: whitesmoke;
        }
    </style>
	<title>Pages & Pixels - Iniciar Sesion</title>
	<link rel="stylesheet" type="text/css" href="sesion/Sesion.css">
    <link rel="stylesheet" href="../style.css">
    
</head>
<body class="fondo-color">
	
	<header>
    <nav>
	<img src="../logos/cecytem-logo-57EA94498B-seeklogo.com.png" alt="" width="80" height="100">
            <div class="container">
                <center><a href="#" class="logo">Pages & Pixels</a></center>
				<br>
                <ul>
                    <li><a href="../index.html">Inicio</a></li>
                    <li><a href="../papeleria.html">Papelería</a></li>
                    <li><a href="../integrantes.html">Integrantes</a></li>
                    <li><a href="../encargados.html">Encargados</a></li>
                    <li><a href="#">Iniciar Sesión</a></li>
                </ul>
            </div>
			<img src="../logos/logo.png" alt="" width="250" height="100">
        </nav>
    </header>
    <script src="main.js"></script>
    <br>
</>

<div>
<section class="hero">
            <div class="container">
                <h1>Pages & Pixels - Iniciar Sesion</h1>
                <p>Tu tienda online de papelería para el colegio.</p>
				<p>Inicia sesion para acceder a nuestro catalogo de produtos</p>
            </div>
        </section>
</div>
	<main>	
		<div class="contenedor__todo">

		<div class="caja__trasera">
			<div class="caja__trasera-login">
				<h3>¿Tienes una cuenta?</h3>
				<p>Inicia sesion para entrar en la pagina</p>
				<button id="btn__iniciar-sesion">Iniciar sesion</button>
			</div>
			<div class="caja__trasera-register">
				<h3>¿No tienes cuenta?</h3>
				<p>Registrate para que acceder</p>
				<button id="btn__registrarse">Registrarse</button>
			</div>
		</div>

		<div class="contenedor__login-register">
			<form action="php/login_usuario_be.php" method="POST" class="formulario__login">
				
				<h2>Inicia Sesion</h2>
				<input type="text" placeholder="Usuario" name="usuario" required>
				<input type="password" placeholder="Contraseña" name="contrasena" required>
				<button>Entrar</button>
			</form>

			<form action="php/registro_usuario_be.php" method="POST" class="formulario__register">
				<h2>Registrarse</h2>
				<input type="text" placeholder="Nombre completo" name="nombre_completo" required>
				<input type="email" placeholder="Correo Electronico" name="correo" required>
				<input type="text" placeholder="Usuario" name="usuario" required>
				<input type="password" placeholder="Contraseña" name="contrasena" required>
                <input type="date" placeholder="Fecha de registro" name="reg" required>
                <input type="text" placeholder="Turno" name="turno" required>
                <input type="text" placeholder="Grupo" name="grupo" required>
				<button>Registrarse</button>
			</form>
		</div>

		</div>




	</main>
	<script src="sesion/script.js"></script>

	<footer>
    <div class="container">
            <p>&copy; 2024 DeepSleep. Todos los derechos reservados.</p>
        </div>
        </footer>

</body>
</html>
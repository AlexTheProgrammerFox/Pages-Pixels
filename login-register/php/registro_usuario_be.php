<?php


   include 'conexion_be.php';
 

   $nombre_completo = $_POST['nombre_completo'];
   $correo = $_POST['correo'];
   $usuario = $_POST['usuario'];
   $contrasena = $_POST['contrasena'];
   $reg = $_POST['reg']; 
   $turno = $_POST['turno'];
   $grupo = $_POST['grupo']; 

   $query = "INSERT INTO usuarios(nombre_completo, correo, usuario, contrasena, reg, turno, grupo ) 
             VALUES('$nombre_completo', '$correo', '$usuario', '$contrasena', '$reg', '$turno', '$grupo')";

   $verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo' ");
   if(mysqli_num_rows($verificar_correo) > 0){
      echo '
          <script>
                  alert("Este correo ya esta registrado, intenta con otro");
                  window.location = "../Sesion.php";



          </script>

      ';
      exit();
   }   

   $verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario='$usuario' ");
   if(mysqli_num_rows($verificar_usuario) > 0){
      echo '
          <script>
                  alert("Este usuario ya esta registrado, intenta con otro");
                  window.location = "../Sesion.php";



          </script>

      ';
      exit();
   }       

   $ejecutar = mysqli_query($conexion, $query);

   if($ejecutar){
   	echo '
   	      <script>
   	            alert("usuario almacenado exitosamente");
   	            window.location = "../Sesion.php";
   	            </script>
   	            ';
   }else{
   		echo '
   	      <script>
   	            alert("Intentalo de nuevo");
   	            window.location = "../Sesion.php";
   	            </script>
   	            ';

   }
   mysqli_close($conexion);



?>
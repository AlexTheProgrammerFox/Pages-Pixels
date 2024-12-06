<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbpaper";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta SQL para obtener los pedidos
$sql = "SELECT * FROM productos";
$result = $conn->query($sql);

// Crear un array para almacenar los pedidos
$pedidos = array();

// Iterar sobre los resultados y agregar cada pedido al array
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $pedidos[] = $row;
    }
}

// Convertir el array de pedidos a formato JSON y enviarlo al navegador
header('Content-type: application/json');
echo json_encode($pedidos);

// Cerrar la conexión
$conn->close();
?>
<?php
// Credenciales de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbpaper";

// Conectar a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Ruta para agregar un nuevo producto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del carrito del JavaScript
    $cartItems = json_decode($_POST['cartItems'], true); // Convertir de JSON a array

    // Verificar si se recibieron datos
    if (isset($cartItems) && is_array($cartItems)) {
        // Insertar cada producto del carrito en la base de datos
        foreach ($cartItems as $item) {
            // Validar datos del producto
            if (isset($item['name'], $item['variation'], $item['price'], $item['quantity'],
                    $item['group'], $item['shift'], $item['time'])) {

                $producto = $item['name'];
                $marca = $item['variation'];
                $total = floatval($item['price']); // Convertir a flotante
                $cantidad = intval($item['quantity']); // Convertir a entero
                $grupo = $item['group'];
                $turno = $item['shift'];
                $horario = $item['time'];

                // Sentencia preparada
                $stmt = $conn->prepare("INSERT INTO productos (producto, marca, total, cantidad, grupo, turno, horario) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssss", $producto, $marca, $total, $cantidad, $grupo, $turno, $horario);

                if ($stmt->execute()) {
                    // Éxito
                    http_response_code(201); // Código de estado HTTP 201 (Creado)
                    echo json_encode(["message" => "Nuevo producto agregado correctamente"]);
                } else {
                    // Error
                    http_response_code(500); // Código de estado HTTP 500 (Error interno del servidor)
                    echo json_encode(["message" => "Error al guardar el producto", "error" => $stmt->error]);
                }

                $stmt->close();

            } else {
                // Error si faltan datos
                http_response_code(400); // Código de estado HTTP 400 (Solicitud incorrecta)
                echo json_encode(["message" => "Faltan datos en la solicitud"]);
                break; // Detener el bucle si falta información en un producto
            }
        }
    } else {
        // Error si no se recibieron datos
        http_response_code(400); // Código de estado HTTP 400 (Solicitud incorrecta)
        echo json_encode(["message" => "No se recibieron datos"]);
    }
}

// Cerrar la conexión
$conn->close();
?>
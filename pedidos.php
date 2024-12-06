<!DOCTYPE html>
<html lang="es">
<head>
<style>
        .textocolor{
            color: white;
        }
    </style>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f0f0f0;
        }

        .button-container {
            display: flex;
        }

        .button-container button {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 5px;
        }

        .entregado {
            background-color: #4CAF50; /* Verde */
            color: white;
        }

        .no-entregado {
            background-color: #f44336; /* Rojo */
            color: white;
        }

        .disabled {
            background-color: #ddd; /* Gris */
            color: #666;
            cursor: default;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pages & Pixels - pedidos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
        <nav>
            <img src="logos/cecytem-logo-57EA94498B-seeklogo.com.png" alt="" width="80" height="100">
            <div class="container">
                <center><a href="#" class="logo">Pages & Pixels</a></center>
                <br>
                <ul>
                    <li><a href="index.html">Inicio</a></li>
                    <li><a href="papeleria.html">Papelería</a></li>
                    <li><a href="integrantes.html">Integrantes</a></li>
                    <li><a href="encargados.html">Encargados</a></li>
                    <li><a href="login-register/Sesion.php">Iniciar Sesión</a></li>
                    <li><a href="pedidos.php">Pedidos</a></li>
                </ul>
            </div>
            <img src="logos/logo.png" alt="" width="250" height="100">
        </nav>
    </header>

    <main>
    <section class="hero">
            <div class="container">
                <h1>¡Bienvenidos a Pages & Pixels!</h1>
                <p>Tu tienda online de papelería para el colegio.</p>
            </div>
        </section>

        <h2>Pedidos</h2>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Marca</th>
                <th>Total</th>
                <th>Cantidad</th>
                <th>Grupo</th>
                <th>Turno</th>
                <th>Horario</th>
                <th>Para</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <!-- Aquí se cargarán los datos de los pedidos -->
        </tbody>
    </table>

    <script>
        // Configuración de la conexión a la base de datos
        const servername = "localhost";
        const username = "root";
        const password = "";
        const dbname = "dbpaper";

        // Obtener el elemento tbody
        const tbody = document.querySelector('tbody');

        // Función para obtener los datos de la base de datos
        function obtenerPedidos() {
            // Crea una nueva instancia de XMLHttpRequest
            const xhr = new XMLHttpRequest();

            // Define la URL del archivo PHP que se encargará de la consulta a la base de datos
            xhr.open('GET', 'obtener_pedidos.php', true);

            // Define el tipo de contenido que se espera recibir
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            // Define la función que se ejecutará cuando la solicitud se completa
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Convierte la respuesta del servidor a un objeto JSON
                    const pedidos = JSON.parse(xhr.responseText);

                    // Itera sobre los pedidos y crea una fila para cada uno
                    pedidos.forEach((pedido, index) => {
                        const row = tbody.insertRow();
                        const productoCell = row.insertCell();
                        const marcaCell = row.insertCell();
                        const totalCell = row.insertCell();
                        const cantidadCell = row.insertCell();
                        const grupoCell = row.insertCell();
                        const turnoCell = row.insertCell();
                        const horarioCell = row.insertCell();
                        const paraCell = row.insertCell();
                        const estadoCell = row.insertCell();

                        // Agrega los datos del pedido a las celdas
                        productoCell.innerHTML = pedido.producto;
                        marcaCell.innerHTML = pedido.marca;
                        totalCell.innerHTML = pedido.total;
                        cantidadCell.innerHTML = pedido.cantidad;
                        grupoCell.innerHTML = pedido.grupo;
                        turnoCell.innerHTML = pedido.turno;
                        horarioCell.innerHTML = pedido.horario;
                        paraCell.innerHTML = pedido.para;

                        // Agrega los botones de estado
                        estadoCell.innerHTML = `
                            <div class="button-container">
                                <button class="entregado" id="entregado-${index + 1}">Entregado</button>
                                <button class="no-entregado" id="no-entregado-${index + 1}">No Entregado</button>
                            </div>
                        `;

                        // Agrega el manejador de eventos para los botones de estado
                        const entregadoButton = estadoCell.querySelector(`#entregado-${index + 1}`);
                        const noEntregadoButton = estadoCell.querySelector(`#no-entregado-${index + 1}`);

                        // Obtener el estado actual del pedido (desde localStorage o una base de datos)
                        let estadoActual = localStorage.getItem(`estadoPedido-${index + 1}`) || 'no-entregado'; // 'no-entregado' por defecto

                        // Aplicar el estado actual a los botones
                        if (estadoActual === 'entregado') {
                            entregadoButton.classList.add('disabled');
                            noEntregadoButton.classList.remove('disabled');
                        } else {
                            entregadoButton.classList.remove('disabled');
                            noEntregadoButton.classList.add('disabled');
                        }

                        // Manejar los eventos de clic en los botones
                        entregadoButton.addEventListener('click', () => {
                            if (!entregadoButton.classList.contains('disabled')) {
                                entregadoButton.classList.add('disabled');
                                noEntregadoButton.classList.remove('disabled');
                                localStorage.setItem(`estadoPedido-${index + 1}`, 'entregado'); // Guardar el estado en localStorage
                            }
                        });

                        noEntregadoButton.addEventListener('click', () => {
                            if (!noEntregadoButton.classList.contains('disabled')) {
                                entregadoButton.classList.remove('disabled');
                                noEntregadoButton.classList.add('disabled');
                                localStorage.setItem(`estadoPedido-${index + 1}`, 'no-entregado'); // Guardar el estado en localStorage
                            }
                        });
                    });
                } else {
                    console.error('Error al obtener los pedidos:', xhr.status);
                }
            };

            // Define la función que se ejecutará si la solicitud falla
            xhr.onerror = function() {
                console.error('Error al conectar con el servidor');
            };

            // Envía la solicitud
            xhr.send();
        }

        // Llama a la función para obtener los pedidos al cargar la página
        obtenerPedidos();
    </script>

    </main>
    
</body>
</html>
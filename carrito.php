<!DOCTYPE html>
<html lang="es">
<head>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pages & Pixels - Carrito</title>
    <link rel="stylesheet" href="papeleria.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="datos.php">
    <style>
        .acolor{
            color: white;
        }
        /* Estilos para el menú lateral */
        .cart-menu {
            position: fixed;
            top: 0;
            right: 0;
            width: 300px;
            height: 100%;
            background-color: #fff;
            box-shadow: -5px 0 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
            transform: translateX(300px); /* Inicialmente oculto */
        }

        .cart-menu.show {
            transform: translateX(0); /* Visible */
        }

        .cart-menu-header {
            padding: 20px;
            background-color: #f2f2f2;
            border-bottom: 1px solid #ddd;
        }

        .cart-menu-header h2 {
            margin: 0;
        }

        .cart-menu-items {
            padding: 20px;
            overflow-y: auto;
        }

        .cart-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .cart-item img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }

        .cart-item-info {
            flex: 1;
        }

        .cart-item-info h3 {
            margin: 0;
        }

        .cart-item-info p {
            margin: 0;
            font-size: 0.9rem;
            color: #666;
        }

        .cart-total {
            padding: 20px;
            background-color: #f2f2f2;
            border-top: 1px solid #ddd;
        }

        .cart-total h3 {
            margin: 0;
        }

        .cart-total p {
            margin: 0;
            font-size: 1.2rem;
            font-weight: bold;
        }

        .cart-button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            margin-top: 15px;
        }

        .cart-button:hover {
            background-color: #0056b3;
        }

        /* Estilos para la ventana emergente */
        .product-popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            display: none; /* Inicialmente oculto */
        }

        .product-popup h2 {
            margin-bottom: 10px;
        }

        .product-popup-details {
            margin-bottom: 15px;
        }

        .product-popup-details p {
            margin: 0;
            font-size: 0.9rem;
            color: #666;
        }

        .product-popup-total {
            background-color: #f2f2f2;
            padding: 10px;
            margin-bottom: 15px;
        }

        .product-popup-total h3 {
            margin: 0;
        }

        .product-popup-total p {
            margin: 0;
            font-size: 1.2rem;
            font-weight: bold;
        }

        .product-popup-button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }

        .product-popup-button:hover {
            background-color: #0056b3;
        }

        .cart-menu-items ul {
            list-style: none;
            padding: 0;
        }

        .cart-menu-items li {
            margin-bottom: 5px;
            position: relative; /* Para posicionar el botón de eliminación */
        }

        .cart-menu-items li button.remove-item {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            background-color: #dc3545; /* Color rojo para eliminar */
            color: #fff;
            border: none;
            border-radius: 50%; /* Botón redondo */
            padding: 5px;
            cursor: pointer;
        }

        /* Estilos para las opciones adicionales */
        .product-popup .options-section {
            margin-bottom: 15px;
        }

        .product-popup .options-section label {
            display: block;
            margin-bottom: 5px;
        }

        .product-popup .options-section select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
    </style>
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
                </ul>
            </div>
            <img src="logos/logo.png" alt="" width="250" height="100">
        </nav>
    </header>

    <div class="cart-menu">
        <div class="cart-menu-header">
            <h2>Carrito</h2>
        </div>
        <div class="cart-menu-items">
            <ul id="cart-items-list">
                <!-- Aquí se mostrarán los productos del carrito -->
            </ul>
        </div>
        <div class="cart-total">
            <h3>Total:</h3>
            <p id="cart-total-price">$0.00</p>
        </div>
        <button class="cart-button" onclick="proceedToCheckout()">Proceder al pago</button>
    </div>

    <main>
        <div id="error-message" class="error-message"></div>
        <section class="hero">
            <div class="container">
                <h1>Pages & Pixels - Productos</h1>
                <p>Tu tienda online de papelería para el colegio.</p>
            </div>
        </section>

        <section class="product-grid">
            <div class="product-card">
                <img src="Imagenes/goma.jpg" width="200" height="300" alt="Product 1">
                <h2>Goma</h2>
                <p>Goma de borrar</p>
                <p class="price">$5.00</p>
                <button class="show-variations">Marcas</button>
                <ul class="variations" style="display: none;">
                    <li data-variation="Faber-Castell" data-price="5.00">Faber-Castell</li>
                    <li data-variation="Pentell" data-price="4.50">Pentel</li>
                    <li data-variation="Pilot" data-price="5.50">Pilot</li>
                </ul>
                <div class="selected-variation"></div>
                <button onclick="openProductPopup(this)">Agregar al carrito</a></button>
            </div>
            <div class="product-card">
                <img src="Imagenes/hojascolor.jpg" alt="Product 2" width="200" height="300">
                <h2>Hojas de color</h2>
                <p>Hojas de colores</p>
                <p class="price">$1.50</p>
                <button class="show-variations">Colores</button>
                <ul class="variations" style="display: none;">
                    <li data-variation="Azul" data-price="1.50">Azul</li>
                    <li data-variation="Verde" data-price="1.75">Verde</li>
                    <li data-variation="Rojo" data-price="1.25">Rojo</li>
                    <li data-variation="Amarillo" data-price="1.50">Amarillo</li>
                </ul>
                <div class="selected-variation"></div>
                <button onclick="openProductPopup(this)">Agregar al carrito</a></button>
            </div>
            <div class="product-card">
                <img src="Imagenes/LAPIZ-OFIX-GRAFITO-CON-GOMA--2-HEXAG.jpg.webp" alt="Product 3" width="200" height="300">
                <h2>Lapices</h2>
                <p>Lapices de grafito</p>
                <p class="price">$7.00</p>
                <button class="show-variations">Marcas</button>
                <ul class="variations" style="display: none;">
                    <li data-variation="Faber-Castell" data-price="7.00">Faber-Castell</li>
                    <li data-variation="Steadtler" data-price="6.50">Steadtler</li>
                    <li data-variation="Winsor & Newtwon" data-price="7.50">Winsor & Newtwon</li>
                </ul>
                <div class="selected-variation"></div>
                <button onclick="openProductPopup(this)">Agregar al carrito</a></button>
            </div>
            <div class="product-card">
                <img src="Imagenes/pegamento.jpg" alt="Product 4" width="120" height="220">
                <h2>Pegamento de Cola</h2>
                <p>Pegamento de Cola escolar</p>
                <p class="price">$12.00</p>
                <button class="show-variations">Marcas</button>
                <ul class="variations" style="display: none;">
                    <li data-variation="Elmer's" data-price="12.00">Elmer's</li>
                    <li data-variation="UHU" data-price="11.50">UHU</li>
                    <li data-variation="Pritt" data-price="12.50">Pritt</li>
                </ul>
                <div class="selected-variation"></div>
                <button onclick="openProductPopup(this)">Agregar al carrito</a></button>
            </div>
            <!-- Agrega más productos aquí -->
        </section>

        <section class="product-grid">
            <div class="product-card">
                <img src="Imagenes/tijeras.jpeg" width="200" height="300" alt="Product 1">
                <h2>Tijeras</h2>
                <p>Tijeras escolares</p>
                <p class="price">$10.00</p>
                <button class="show-variations">Marcas</button>
                <ul class="variations" style="display: none;">
                    <li data-variation="Fiskars" data-price="10.00">Fiskars</li>
                    <li data-variation="Westcott" data-price="12.00">Westcott</li>
                    <li data-variation="Elmer's" data-price="15.00">Elmer's</li>
                </ul>
                <div class="selected-variation"></div>
                <button onclick="openProductPopup(this)">Agregar al carrito</a></button>
            </div>
            <div class="product-card">
                <img src="Imagenes/plumas.jpeg" alt="Product 2" width="200" height="300">
                <h2>Plumas</h2>
                <p>Plumas escolares</p>
                <p class="price">$7.00</p>
                <button class="show-variations">Colores</button>
                <ul class="variations" style="display: none;">
                    <li data-variation="Montblanc" data-price="7.00">Montblanc</li>
                    <li data-variation="Parker" data-price="8.00">Parker</li>
                    <li data-variation="Waterman" data-price="9.00">Waterman</li>
                    <li data-variation="Lamy" data-price="10.00">Lamy</li>
                </ul>
                <div class="selected-variation"></div>
                <button onclick="openProductPopup(this)">Agregar al carrito</a></button>
            </div>
            <div class="product-card">
                <img src="Imagenes/lapicera.jpeg" alt="Product 3" width="200" height="300">
                <h2>Lapiceras</h2>
                <p>Lapiceras escolares</p>
                <p class="price">$30.00</p>
                <button class="show-variations">Marcas</button>
                <ul class="variations" style="display: none;">
                    <li data-variation="Faber-Castell" data-price="30.00">Faber-Castell</li>
                    <li data-variation="Steadtler" data-price="35.00">Steadtler</li>
                    <li data-variation="Winsor & Newtwon" data-price="40.00">Winsor & Newtwon</li>
                </ul>
                <div class="selected-variation"></div>
                <button onclick="openProductPopup(this)">Agregar al carrito</a></button>
            </div>
            <div class="product-card">
                <img src="Imagenes/250060.jpg.webp" alt="Product 4" width="200" height="300">
                <h2>Pegamento de barra</h2>
                <p>Pegamento de barra escolar</p>
                <p class="price">$9.00</p>
                <button class="show-variations">Marcas</button>
                <ul class="variations" style="display: none;">
                    <li data-variation="Elmer's" data-price="9.00">Elmer's</li>
                    <li data-variation="UHU" data-price="11.50">UHU</li>
                    <li data-variation="Pritt" data-price="12.50">Pritt</li>
                </ul>
                <div class="selected-variation"></div>
                <button onclick="openProductPopup(this)">Agregar al carrito</a></button>
            </div>
            <!-- Agrega más productos aquí -->
        </section>

        <section class="product-grid">
            <div class="product-card">
                <img src="Imagenes/cartulina blanca.jpeg" width="200" height="300" alt="Product 1">
                <h2>Cartulina blanca</h2>
                <p>Cartulina blanca escolar</p>
                <p class="price">$5.00</p>
                <button class="show-variations">Tipo</button>
                <ul class="variations" style="display: none;">
                    <li data-variation="Lizo" data-price="5.00">Lizo</li>
                    <li data-variation="Texturizado" data-price="7.00">Texturizado</li>
                </ul>
                <div class="selected-variation"></div>
                <button onclick="openProductPopup(this)">Agregar al carrito</a></button>
            </div>
            <div class="product-card">
                <img src="Imagenes/cartulinas colores.jpg" alt="Product 2" width="200" height="300">
                <h2>Cartulinas de colores</h2>
                <p>Cartulinas de colores escolares</p>
                <p class="price">$7.00</p>
                <button class="show-variations">Colores</button>
                <ul class="variations" style="display: none;">
                    <li data-variation="Azul" data-price="7.00">Azul</li>
                    <li data-variation="Verde" data-price="7.00">Verde</li>
                    <li data-variation="Amarillo" data-price="7.00">Amarillo</li>
                    <li data-variation="Morado" data-price="7.00">Morado</li>
                </ul>
                <div class="selected-variation"></div>
                <button onclick="openProductPopup(this)">Agregar al carrito</a></button>
            </div>
            <div class="product-card">
                <img src="Imagenes/el-guardian-mexico-papeleria-articulos-de-oficina-material-escolar-lapices-de-colores-largos-bacoiris-c-12pz-A130.gif" alt="Product 3" width="200" height="300">
                <h2>Colores</h2>
                <p>Colores escolares</p>
                <p class="price">$50.00</p>
                <button class="show-variations">Marcas</button>
                <ul class="variations" style="display: none;">
                    <li data-variation="Crayola" data-price="50.00">Crayola</li>
                    <li data-variation="Prismacolor" data-price="56.50">Prismacolor</li>
                    <li data-variation="Winsor & Newtwon" data-price="65.50">Faber-Castell</li>
                </ul>
                <div class="selected-variation"></div>
                <button onclick="openProductPopup(this)">Agregar al carrito</a></button>
            </div>
            <div class="product-card">
                <img src="Imagenes/engrapadora escolar.jpeg" alt="Product 4" width="200" height="300">
                <h2>Engrapadora</h2>
                <p>Engrapadora escolar</p>
                <p class="price">$7.00</p>
                <button class="show-variations">Marcas</button>
                <ul class="variations" style="display: none;">
                    <li data-variation="Swingline" data-price="7.00">Swingline</li>
                    <li data-variation="Bostitch" data-price="8.50">Bostitch</li>
                    <li data-variation="Rapid" data-price="10.50">Rapid</li>
                </ul>
                <div class="selected-variation"></div>
                <button onclick="openProductPopup(this)">Agregar al carrito</a></button>
            </div>
            <!-- Agrega más productos aquí -->
        </section>

        <div class="product-popup">
            <h2></h2>
            <div class="product-popup-details">
                <p id="popup-product-variation"></p>
                <p id="popup-product-price"></p>
            </div>
            <div class="options-section">
                <label for="group-select">Grupo:</label>
                <select id="group-select">
                    <option value="101">101</option>
                    <option value="102">102</option>
                    <option value="201">201</option>
                    <option value="202">202</option>
                    <option value="301">301</option>
                    <option value="302">302</option>
                    <option value="401">401</option>
                    <option value="402">402</option>
                    <option value="501">501</option>
                    <option value="502">502</option>
                    <option value="601">601</option>
                    <option value="602">602</option>
                    <!-- Agrega más grupos aquí -->
                </select>
            </div>
            <div class="options-section">
                <label for="shift-select">Turno:</label>
                <select id="shift-select">
                    <option value="Matutino">Matutino</option>
                    <option value="Vespertino">Vespertino</option>
                </select>
            </div>
            <div class="options-section">
                <label for="time-select">Horario:</label>
                <select id="time-select">
                    <option value="7:00 AM">7:00 AM</option>
                    <option value="8:00 AM">8:00 AM</option>
                    <option value="9:00 AM">9:00 AM</option>
                    <option value="10:00 AM">10:00 AM</option>
                    <option value="11:00 AM">11:00 AM</option>
                    <option value="12:00 AM">12:00 AM</option>
                    <option value="1:00 AM">1:00 PM</option>
                    <option value="2:00 AM">2:00 PM</option>
                    <option value="3:00 AM">3:00 PM</option>
                    <option value="4:00 AM">4:00 PM</option>
                    <option value="5:00 AM">5:00 PM</option>
                    <option value="6:00 AM">6:00 PM</option>
                    <!-- Agrega más horarios aquí -->
                </select>
            </div>
            <div class="product-popup-total">
                <h3>Total:</h3>
                <p id="popup-total-price"></p>
            </div>
            <div class="quantity-selector">
                <label for="quantity-popup">Cantidad:</label>
                <input type="number" id="quantity-popup" min="1" value="1">
            </div>
            <button class="product-popup-button" onclick="addToCart()">Agregar al carrito</button>
        </div>

    </main>


    <footer>
        <div class="container">
            <p>&copy; 2024 DeepSleep. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script>
        const showVariationsButtons = document.querySelectorAll(".show-variations");
const variationsLists = document.querySelectorAll(".variations");
const selectedVariations = document.querySelectorAll(".selected-variation");
const cartMenu = document.querySelector(".cart-menu");
const cartTotal = document.getElementById("cart-total-price");
const productPopup = document.querySelector(".product-popup");
const popupProductName = document.querySelector(".product-popup h2");
const popupProductVariation = document.getElementById("popup-product-variation");
const popupProductPrice = document.getElementById("popup-product-price");
const popupTotalPrice = document.getElementById("popup-total-price");
const cartItemsList = document.getElementById("cart-items-list"); // Obtener la lista de elementos del carrito
const quantityInputPopup = document.getElementById("quantity-popup"); // Obtener el input de cantidad de la ventana emergente
const groupSelect = document.getElementById("group-select");
const shiftSelect = document.getElementById("shift-select");
const timeSelect = document.getElementById("time-select");
const errorMessage = document.getElementById("error-message"); // Obtener el elemento para el mensaje de error

let cartItems = []; // Arreglo para almacenar los productos del carrito

showVariationsButtons.forEach((button, index) => {
    button.addEventListener("click", () => {
        const variationsList = button.nextElementSibling;
        variationsList.style.display = variationsList.style.display === "none" ? "block" : "none";
    });

    variationsLists[index].addEventListener("click", (event) => {
        if (event.target.tagName === "LI") {
            const selectedVariation = event.target.dataset.variation;
            const selectedPrice = parseFloat(event.target.dataset.price); // Obtén el precio de la variación
            selectedVariations[index].textContent = `Variación seleccionada: ${selectedVariation}`;
            // Actualiza el precio del producto
            event.target.closest(".product-card").querySelector(".price").textContent = `$${selectedPrice.toFixed(2)}`;
        }
    });
});

function openProductPopup(button) {
    const productCard = button.closest(".product-card");
    const productName = productCard.querySelector("h2").textContent;
    const selectedVariation = productCard.querySelector(".selected-variation").textContent;
    const selectedPrice = parseFloat(productCard.querySelector(".price").textContent.replace("$", ""));

    popupProductName.textContent = productName;
    popupProductVariation.textContent = selectedVariation;
    popupProductPrice.textContent = `Precio: $${selectedPrice.toFixed(2)}`;
    
    // Inicializa el total en la ventana emergente
    popupTotalPrice.textContent = `$${selectedPrice.toFixed(2)}`; 

    // Reinicia el input de cantidad a 1
    quantityInputPopup.value = 1;

    // Reinicia las opciones adicionales
    groupSelect.selectedIndex = 0; // Selecciona el primer grupo
    shiftSelect.selectedIndex = 0; // Selecciona el primer turno
    timeSelect.selectedIndex = 0; // Selecciona el primer horario

    productPopup.style.display = "block";
}

function addToCart() {
    const productName = popupProductName.textContent;
    const productVariation = popupProductVariation.textContent;
    const productPrice = parseFloat(popupProductPrice.textContent.replace("Precio: $", "")).toString(); // Convertir a cadena
    const quantity = parseInt(quantityInputPopup.value); // Obtener la cantidad desde el input
    const selectedGroup = groupSelect.value;
    const selectedShift = shiftSelect.value;
    const selectedTime = timeSelect.value;

    // Agrega el producto al carrito con las opciones adicionales
    cartItems.push({
        name: productName,
        variation: productVariation,
        price: productPrice,
        quantity: quantity,
        group: selectedGroup,
        shift: selectedShift,
        time: selectedTime
    });

    // Actualiza el total del carrito
    updateCartTotal();

    // Cierra la ventana emergente
    productPopup.style.display = "none";

    // Actualiza la lista de productos en el menú lateral
    updateCartItemsList();
}

function updateCartTotal() {
    let totalPrice = 0;
    cartItems.forEach(item => {
        totalPrice += parseFloat(item.price) * item.quantity; // Calcula el precio total considerando la cantidad
    });
    cartTotal.textContent = `$${totalPrice.toFixed(2)}`;
}

function proceedToCheckout() {
    // Aquí puedes implementar la lógica para el proceso de pago
    // En este caso, se envía la información del carrito a la API
    guardarDatosEnBaseDeDatos();
    // Eliminar la línea siguiente:
    // alert("¡Proceder al pago!");
}

// Función para mostrar el menú lateral
function toggleCartMenu() {
    cartMenu.classList.toggle("show");
}

// Función para actualizar la lista de productos en el menú lateral
function updateCartItemsList() {
    cartItemsList.innerHTML = ""; // Limpia la lista
    cartItems.forEach((item, index) => {
        const cartItem = document.createElement("li");
        cartItem.innerHTML = `
            <h3>${item.name}</h3>
            <p>Variación: ${item.variation}</p>
            <p>Cantidad: ${item.quantity}</p>
            <p>Grupo: ${item.group}</p>
            <p>Turno: ${item.shift}</p>
            <p>Horario: ${item.time}</p>
            <p>Precio: $${(parseFloat(item.price) * item.quantity).toFixed(2)}</p>
            <button class="remove-item" onclick="removeItem(${index})">Eliminar</button>
        `;
        cartItemsList.appendChild(cartItem);
    });
}

// Función para eliminar un producto del carrito
function removeItem(index) {
    cartItems.splice(index, 1); // Elimina el elemento del arreglo
    updateCartTotal(); // Actualiza el total
    updateCartItemsList(); // Actualiza la lista
}

// Agregar un botón para mostrar/ocultar el menú lateral
const cartMenuButton = document.createElement("button");
cartMenuButton.textContent = "Carrito";
cartMenuButton.classList.add("cart-menu-button");
cartMenuButton.onclick = toggleCartMenu;

// Agregar el botón al encabezado
document.querySelector("header").appendChild(cartMenuButton);

// Actualizar el total en la ventana emergente cuando cambia la cantidad
quantityInputPopup.addEventListener('input', function() {
    const selectedPrice = parseFloat(popupProductPrice.textContent.replace("Precio: $", ""));
    const quantity = parseInt(this.value);
    popupTotalPrice.textContent = `$${(selectedPrice * quantity).toFixed(2)}`;
});

// Función para guardar los datos en la base de datos
function guardarDatosEnBaseDeDatos() {
    // Aquí debes implementar la lógica para guardar los datos en la base de datos
    // Puedes utilizar una librería como Axios para hacer una petición HTTP
    // Ejemplo con Axios:

    // Importar Axios si es necesario
    // const axios = require('axios'); // Si estás utilizando Node.js

    // Reemplazar con la URL de tu API
    const apiUrl = 'datos.php'; 

    axios.post(apiUrl, {
        cartItems: cartItems // Envía el arreglo de productos del carrito
    })
    .then(response => {
        // Manejar la respuesta de la petición
        console.log(response);

        // Mostrar un mensaje de éxito en el elemento HTML
        errorMessage.textContent = "¡El pedido se ha guardado correctamente!";
        errorMessage.classList.add("success"); // Agrega una clase para el estilo de éxito
    })
    .catch(error => {
        // Manejar el error de la petición
        console.error(error);

        // Mostrar un mensaje de error en el elemento HTML
        errorMessage.textContent = "¡Ocurrió un error al guardar el pedido. Por favor, inténtalo de nuevo más tarde.";
        errorMessage.classList.add("error"); // Agrega una clase para el estilo de error
    });
}

// Agregar un evento click al botón "Proceder al pago"
const cartButton = document.querySelector(".cart-button");
cartButton.addEventListener("click", function(event) {
    event.stopPropagation(); // Evita que el evento de clic se propague
    guardarDatosEnBaseDeDatos(); 
    // Redirecciona a la página de pago o a la página de realización del examen
    window.location.href = "pago.html"; 
});
    </script>
</body>
</html>